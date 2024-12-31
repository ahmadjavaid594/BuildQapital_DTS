<?php 
class CronController extends CI_Controller
{
     function generateSecureHash($parameters, $integritySalt) {
        ksort($parameters); // Sort by key in ascending order
        $sortedString = $integritySalt; // Start with the integrity salt
        foreach ($parameters as $key => $value) {
            if ($value !== "") {
                $sortedString .= '&' . $value; // Concatenate each value
            }
        }
        return strtoupper(hash_hmac('sha256', $sortedString, $integritySalt));
    }
    public function processTasks()
    {
        $tasks = $this->db->get_where('async_tasks', ['status' => 'pending'])->result_array();


        foreach ($tasks as $task) {
            $parameters = [
                "pp_Amount" => $task['pp_Amount'],
                "pp_BillReference" => $task['pp_BillReference'],
                "pp_CNIC" => $task['pp_CNIC'],
                "pp_Description" => $task['pp_Description'],
                "pp_MobileNumber" => $task['pp_MobileNumber'],
                "pp_Language" => "EN",
                "pp_MerchantID" => $task['merchant_id'],  // Merchant ID
                "pp_Password" => $task['merchant_pwd'],  // Merchant Password
                "pp_TxnCurrency" => "PKR",
                "pp_TxnDateTime" => date("YmdHis"),
                "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
                "pp_TxnRefNo" => uniqid("T"),
                "ppmpf_1" => $task['job_id'],
                "ppmpf_2" => $task['applicant_id']
            ];

            // Generate Secure Hash
            $integritySalt = $task['merchant_is'];  // Integrity Salt
            $parameters["pp_SecureHash"] = $this->generateSecureHash($parameters, $integritySalt);

            // API URL
            $apiUrl = $task['api_url'];

            // Curl request to JazzCash API
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $this->db->update('async_tasks', ['status' => 'failed'], ['id' => $task['id']]);
            } else {
                $decodedResponse = json_decode($response, true);
                if ($decodedResponse && $decodedResponse['pp_ResponseCode'] === "000") {
                    // Successful payment
                    $this->db->update('async_tasks', ['status' => 'completed'], ['id' => $task['id']]);

                    // Store payment info to the database (optional)
                    $data = [
                        'payment_date' => date("Y-m-d H:i:s"),
                        'amount' => $decodedResponse['pp_Amount'] / 100,
                        'transaction_id' => $decodedResponse['pp_TxnRefNo'],
                        'bank_name' => 'JazzCash Wallet',
                        'job_application_id' => $decodedResponse['pp_BillReference'],
                        'payment_mode' => "JazzCash Wallet",
                        'status_id' => 16,
                        'payment_response_code' => $decodedResponse['pp_ResponseCode'],
                        'payment_response' => json_encode($decodedResponse)
                    ];

                    // Save payment info (if applicable)
                    $this->applicants_model->updatePayment($data);
                } else {
                    $this->db->db_connect();
                    $this->db->update('async_tasks', ['status' => 'failed'], ['id' => $task['id']]);
                }
            }

            curl_close($ch);
        }
    }
}

?>