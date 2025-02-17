<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;



class Job extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('job_model');
        $this->load->model('applicants_model');
        $this->load->model('education_model');
        $this->load->model('document_model');
        $this->load->model('experience_model');
        $this->load->model('certification_model');
    }
    public function checkPaymentStatus($transactionNo)
    {
        $global_config = $this->db->get_where('global_settings', ['id' => 1])->row_array();
        $merchantID = $global_config['jc_merchant_id'];
        $password = $global_config['jc_merchant_pwd'];
        $txnRefNo = $transactionNo; // Replace with your transaction reference number
        $integritySalt = $global_config['jc_merchant_is']; // Replace with your secret integrity key
        $job_application = $this->job_model->validateTransaction1($transactionNo);
        // Generate the Secure Hash using HMAC-SHA256
        $dataArray = [
            "pp_MerchantID" => $merchantID,
            "pp_Password" => $password,
            "pp_TxnRefNo" => $txnRefNo,
        ];
        ksort($dataArray); // Sort fields in ascending alphabetical order
        $dataString = implode('&', $dataArray);
        $hashString = $integritySalt . '&' . $dataString;
        $secureHash = hash_hmac('sha256', $hashString, $integritySalt);

        // API request payload
        $requestData = [
            "pp_MerchantID" => $merchantID,
            "pp_Password" => $password,
            "pp_TxnRefNo" => $txnRefNo,
            "pp_SecureHash" => $secureHash,
        ];

        // API endpoint (use sandbox or production)
        $apiUrl = $global_config['jc_status_url']; // For sandbox testing
        // $apiUrl = "https://payments.jazzcash.com.pk/ApplicationAPI/API/PaymentInquiry/Inquire"; // For production

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);

        // Execute API call
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
                                     
            set_alert('error', "Curl Error: " . curl_error($ch));
            
        } else {
            $decodedResponse = json_decode($response, true);
          
            if ($decodedResponse && $decodedResponse['pp_ResponseCode'] === "000") {
      
                if ($decodedResponse['pp_PaymentResponseCode'] === '121') {
                
                
                $txnDateTime = $decodedResponse['pp_TxnDateTime'];

                $date = substr($txnDateTime, 0, 4) . '-' . substr($txnDateTime, 4, 2) . '-' . substr($txnDateTime, 6, 2);
                $time = substr($txnDateTime, 8, 2) . ':' . substr($txnDateTime, 10, 2) . ':' . substr($txnDateTime, 12, 2);
                $formattedDateTime = $date . ' ' . $time;
                
                $data = [
                    'ipn_payment_date' => $formattedDateTime,
                    'ipn_pp_TxnType' => $job_application['payment_mode'],
                    'ipn_pp_responseCode' => $decodedResponse['pp_ResponseCode'],
                    'ipn_pp_responseMessage' => $decodedResponse['pp_PaymentResponseMessage'],
                    'ipn_pp_response' =>  json_encode($decodedResponse),
                    'pp_TxnRefNo' => $transactionNo,
                    'status_id' => 16
                ];
                $response = $this->job_model->updatePaymentIPN($data); 
               
                if ($response) {
                    
                    set_alert('success', $decodedResponse['pp_ResponseMessage']);
                    redirect(base_url('job/viewApplicationDetail/'.$job_application['unique_id']));
                   
                }
                else{
                    set_alert('error', $decodedResponse['pp_ResponseMessage']);
                }

               }
               else{
                $data = [
                    'ipn_payment_date' => $formattedDateTime,
                    'ipn_pp_TxnType' => $job_application['payment_mode'],
                    'ipn_pp_responseCode' => $decodedResponse['pp_ResponseCode'],
                    'ipn_pp_responseMessage' => $decodedResponse['pp_PaymentResponseMessage'],
                    'ipn_pp_response' =>  json_encode($decodedResponse),
                    'pp_TxnRefNo' => $transactionNo,
                    'status_id' => 17
                ];
                $response = $this->job_model->updatePaymentIPN($data); 
                set_alert('error', $decodedResponse['pp_ResponseMessage']);
               }
              
            } else {
        
                set_alert('error', $decodedResponse['pp_ResponseMessage']);
            }
        }
       
       
    }
    public function checkPaymentStatusUser($transactionNo)
    {
      
        $global_config = $this->db->get_where('global_settings', ['id' => 1])->row_array();
        $merchantID = $global_config['jc_merchant_id'];
        $password = $global_config['jc_merchant_pwd'];
        $txnRefNo = $transactionNo; // Replace with your transaction reference number
        $integritySalt = $global_config['jc_merchant_is']; // Replace with your secret integrity key
        $job_application = $this->job_model->validateTransaction1($transactionNo);
        // Generate the Secure Hash using HMAC-SHA256
        $dataArray = [
            "pp_MerchantID" => $merchantID,
            "pp_Password" => $password,
            "pp_TxnRefNo" => $txnRefNo,
        ];
        ksort($dataArray); // Sort fields in ascending alphabetical order
        $dataString = implode('&', $dataArray);
        $hashString = $integritySalt . '&' . $dataString;
        $secureHash = hash_hmac('sha256', $hashString, $integritySalt);

        // API request payload
        $requestData = [
            "pp_MerchantID" => $merchantID,
            "pp_Password" => $password,
            "pp_TxnRefNo" => $txnRefNo,
            "pp_SecureHash" => $secureHash,
        ];

        // API endpoint (use sandbox or production)
        $apiUrl = $global_config['jc_status_url']; // For sandbox testing
        // $apiUrl = "https://payments.jazzcash.com.pk/ApplicationAPI/API/PaymentInquiry/Inquire"; // For production

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);

        // Execute API call
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
                            
            set_alert('error', "Curl Error: " . curl_error($ch));
            
        } else {
            
            $decodedResponse = json_decode($response, true);
          
            if ($decodedResponse && $decodedResponse['pp_ResponseCode'] === "000") {
             
                if ($decodedResponse['pp_PaymentResponseCode'] === '121') {
                
                
                $txnDateTime = $decodedResponse['pp_TxnDateTime'];

                $date = substr($txnDateTime, 0, 4) . '-' . substr($txnDateTime, 4, 2) . '-' . substr($txnDateTime, 6, 2);
                $time = substr($txnDateTime, 8, 2) . ':' . substr($txnDateTime, 10, 2) . ':' . substr($txnDateTime, 12, 2);
                $formattedDateTime = $date . ' ' . $time;
                
                $data = [
                    'ipn_payment_date' => $formattedDateTime,
                    'ipn_pp_TxnType' => $job_application['payment_mode'],
                    'ipn_pp_responseCode' => $decodedResponse['pp_ResponseCode'],
                    'ipn_pp_responseMessage' => $decodedResponse['pp_PaymentResponseMessage'],
                    'ipn_pp_response' =>  json_encode($decodedResponse),
                    'pp_TxnRefNo' => $transactionNo,
                    'status_id' => 16
                ];
                $response = $this->job_model->updatePaymentIPN($data); 
               
                if ($response) {
                    
                    set_alert('success', $decodedResponse['pp_ResponseMessage']);
                    redirect(base_url('/job/challans'));
                   
                }
                else{
                    set_alert('error', $decodedResponse['pp_ResponseMessage']);
                    redirect(base_url('/job/challans'));
                }

               }
               else{
                /*$data = [
                    'ipn_payment_date' => $formattedDateTime,
                    'ipn_pp_TxnType' => $job_application['payment_mode'],
                    'ipn_pp_responseCode' => $decodedResponse['pp_ResponseCode'],
                    'ipn_pp_responseMessage' => $decodedResponse['pp_PaymentResponseMessage'],
                    'ipn_pp_response' =>  json_encode($decodedResponse),
                    'pp_TxnRefNo' => $transactionNo,
                    'status_id' => 17
                ];
                $response = $this->job_model->updatePaymentIPN($data);*/
                set_alert('success', $decodedResponse['pp_ResponseMessage']);
                redirect(base_url('/job/challans'));
               }
              
            } else {
        
                set_alert('error', $decodedResponse['pp_ResponseMessage']);
                redirect(base_url('/job/challans'));
            }
        }
       
       
    }
     public function viewReceipt($applicationId)
    {
      
        $global_config = $this->db->get_where('global_settings',array('id'=>1))->row_array();
      
       
            
            $post = $this->input->post();
                
            $jobApplication = $this->job_model->getReceiptDetail($applicationId);
           
            if (!$jobApplication) {
                show_404(); // Show 404 if job is not found
            }
            else{
               
                    $userID = get_loggedin_user_id();
                  
                       if($this->applicants_model->isAlreadyApplied($userID,$jobApplication['id']))
                            {
                                
                                $challanDetails = json_decode($jobApplication['payment_response'],true);
                                
                                $this->data['applicant'] = $this->applicants_model->getSingleApplicant($userID);
                                $this->data['jobApplication'] = $jobApplication;
                                $this->data['challanDetails'] = $challanDetails;
                                $this->data['title'] = 'View Receipt';
                                $this->data['sub_page'] = 'job/viewReceipt';
                                $this->data['main_menu'] = 'jobs';
                                $this->load->view('layout/index', $this->data);
                               
                            }
                            else{
                          
                                set_alert('error', 'You need to apply first');
                              
                            }
                  
              
            }
        
        
        
     

    }
        public function payViaOTC($applicationId)
{
    $global_config = $this->db->get_where('global_settings', ['id' => 1])->row_array();

    if ($this->input->post('submit') === 'update') {
        $post = $this->input->post();
        $jobApplication = $this->job_model->getChallanDetail($post['job_application_id']);

        if (!$jobApplication) {
            show_404(); // Show 404 if job is not found
        } else {
            if ($jobApplication['status'] === 'Active') {
                $userID = get_loggedin_user_id();
                if ($jobApplication['job_end_date'] > date("Y-m-d")) {
                    if ($this->applicants_model->isAlreadyApplied($userID, $post['job_id'])) {

                        $this->form_validation->set_rules('pp_MobileNumber', translate('pp_MobileNumber'), 'required');
                        $this->form_validation->set_rules('pp_BillReference', translate('pp_BillReference'), 'required');
                        $this->form_validation->set_rules('pp_Description', translate('pp_Description'), 'required');

                        if ($this->form_validation->run() === true) {
                            $parameters = [
                                "pp_Version" => "1.1",
                                "pp_TxnType" => "OTC",
                                "pp_Amount" => $post['pp_Amount'], // Amount in paisas
                                "pp_BillReference" => $post['pp_BillReference'],
                                "pp_Description" => $post['pp_Description'],
                                "pp_Language" => "EN",
                                "pp_ReturnURL" => $global_config['jc_return_url'],
                                "pp_MerchantID" => $global_config['jc_merchant_id'],
                                "pp_MobileNumber" => $post['pp_MobileNumber'],
                                "pp_Password" => $global_config['jc_merchant_pwd'],
                                "pp_TxnCurrency" => "PKR",
                                "pp_TxnDateTime" => date("YmdHis"),
                                "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
                                "pp_TxnRefNo" => uniqid("T"),
                                "ppmpf_1" => $post['pp_MobileNumber'],
                                "ppmpf_2" => $post['applicant_id']
                            ];

                            $integritySalt = $global_config['jc_merchant_is'];
                            $parameters["pp_SecureHash"] = $this->generateSecureHash($parameters, $integritySalt);

                            $apiUrl = $global_config['jc_otc_url'];
                            $ch = curl_init($apiUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Content-Type: application/json',
                            ]);

                            $response = curl_exec($ch);
                            if (curl_errno($ch)) {
                                set_alert('error', "Curl Error: " . curl_error($ch));
                            } else {
                                $decodedResponse = json_decode($response, true);

                                if ($decodedResponse && $decodedResponse['pp_ResponseCode'] === "124") {
                                    $txnDateTime = $decodedResponse['pp_TxnDateTime'];

                                    $date = substr($txnDateTime, 0, 4) . '-' . substr($txnDateTime, 4, 2) . '-' . substr($txnDateTime, 6, 2);
                                    $time = substr($txnDateTime, 8, 2) . ':' . substr($txnDateTime, 10, 2) . ':' . substr($txnDateTime, 12, 2);
                                    $formattedDateTime = $date . ' ' . $time;

                                    $data = [
                                        'payment_date' => $formattedDateTime,
                                        'amount' => $decodedResponse['pp_Amount'] / 100,
                                        'transaction_id' => $decodedResponse['pp_TxnRefNo'],
                                        'bank_name' => 'OTC',
                                        'job_application_id' => $decodedResponse['pp_BillReference'],
                                        'company_name' => $post['company_name'],
                                        'job_position' => $post['job_position'],
                                        'payment_mode' => "OTC",
                                        'status_id' => 9,
                                        'payment_response_code' => $decodedResponse['pp_ResponseCode'],
                                        'payment_response' => json_encode($decodedResponse)
                                    ];

                                    $response = $this->applicants_model->updatePayment($data);

                                    if ($response) {
                                        set_alert('success', $decodedResponse['pp_ResponseMessage']." Kindly visit nearest JazzCash along with your transaction id for payment of challan fee");
                                        
                                        redirect(base_url('job/viewReceipt/'.$applicationId));
                                    } else {
                                        set_alert('error', $decodedResponse['pp_ResponseMessage']);
                                        return;
                                    }
                                } else {
                                    set_alert('error', $decodedResponse['pp_ResponseMessage'] ?? 'Error processing payment.');
                                }
                            }
                        } else {
                            set_alert('error', 'Required data is missing or invalid.');
                        }
                    } else {
                        set_alert('error', 'You need to apply first.');
                    }
                } else {
                    set_alert('error', 'Job is not active.');
                }
            } else {
                set_alert('error', 'Job is not active.');
            }
        }
    }

    $jobApplication = $this->job_model->getChallanDetail($applicationId);

    if (!$jobApplication) {
        show_404(); // Show 404 if job is not found
    }

    $this->data['jobApplication'] = $jobApplication;
    $this->data['title'] = 'Pay Via OTC';
    $this->data['sub_page'] = 'job/payViaOTC';
    $this->data['main_menu'] = 'jobs';

    $this->load->view('layout/index', $this->data);
}
    public function paymentModeSelection($applicationId)
    {
      
        $global_config = $this->db->get_where('global_settings', ['id' => 1])->row_array();
    
       
            $post = $this->input->post();
            $jobApplication = $this->job_model->getChallanDetail($applicationId);
          
            if (!$jobApplication) {
              
                show_404();
            } else {
               /// print_r($jobApplication);
               
                if ($jobApplication['status'] == 'Active' && $jobApplication['job_end_date'] >= date("Y-m-d")) {
                    //print_r($jobApplication);
                    
                    $userID = get_loggedin_user_id();
                    if ($this->applicants_model->isAlreadyApplied($userID, $jobApplication['id'])) {
                        //print_r($jobApplication);
                        
                            $parameters = [
                                "pp_Version" => "1.1",
                                "pp_TxnType" => "MPAY",
                                "pp_Language" => "EN",
                                "pp_MerchantID" => $global_config['jc_merchant_id'],
                                "pp_Password" => $global_config['jc_merchant_pwd'],
                                "pp_Amount" => $jobApplication['challan_amount'] * 100,
                                "pp_BillReference" => $jobApplication['unique_id'],
                                "pp_Description" => "Challan Payment for " .$jobApplication['unique_id'],
                                "pp_TxnCurrency" => "PKR",
                                "pp_TxnDateTime" => date("YmdHis"),
                                "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
                                "pp_TxnRefNo" => uniqid("T"),
                                "pp_ReturnURL" => $global_config['jc_return_url'], // Adjust this to your return URL
                                "ppmpf_1" => $jobApplication['id'],
                                "ppmpf_2" => $userID,
                                "ppmpf_3" => $jobApplication['organization'],
                                "ppmpf_4" => $jobApplication['designation']
                            ];
    
                            $payment_session = [
                                'transaction_id' => $jobApplication['unique_id'],
                                'user_id' => $userID ,
                                'session_data' => serialize($this->session->userdata()),
                            ];
                            $this->db->insert('payment_sessions', $payment_session);
                            // Generate secure hash
                            $integritySalt = $global_config['jc_merchant_is'];
                            $parameters["pp_SecureHash"] = $this->generateSecureHash($parameters, $integritySalt);
                            //echo json_encode($parameters);
                            //print_r($global_config['jc_card_url']);
                            //die;
                            
                        
                    } else {
                        set_alert('error', 'You need to apply first');
                      ;
                    }
                } else {
                    set_alert('error', 'Job Is Not Active');
                   
                }
            }
       
      
      
        $this->data['jobApplication'] = $jobApplication;
        $this->data['parameters'] = $parameters;
        $this->data['url'] = $global_config['jc_card_url'];
        $this->data['title'] = 'Payment Mode Selection';
        $this->data['sub_page'] = 'job/paymentModeSelection';
        $this->data['main_menu'] = 'jobs';
      
        $this->load->view('layout/index', $this->data);

    }
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
    public function payChallanViaCard($applicationId=0)
    {
        $global_config = $this->db->get_where('global_settings', ['id' => 1])->row_array();
     
        if (!$this->input->post()) {
            $post = $this->input->post();
            $jobApplication = $this->job_model->getChallanDetail($applicationId);
    
            if (!$jobApplication) {
              
                show_404();
            } else {
               /// print_r($jobApplication);
               
                if ($jobApplication['status'] == 'Active' && $jobApplication['job_end_date'] > date("Y-m-d")) {
                    //print_r($jobApplication);
                    
                    $userID = get_loggedin_user_id();
                    if ($this->applicants_model->isAlreadyApplied($userID, $jobApplication['id'])) {
                        //print_r($jobApplication);
                        
                            $parameters = [
                                "pp_Version" => "1.1",
                                "pp_TxnType" => "MPAY",
                                "pp_Language" => "EN",
                                "pp_MerchantID" => $global_config['jc_merchant_id'],
                                "pp_Password" => $global_config['jc_merchant_pwd'],
                                "pp_Amount" => $jobApplication['challan_amount'] * 100,
                                "pp_BillReference" => $jobApplication['unique_id'],
                                "pp_Description" => "Challan Payment for " .$jobApplication['unique_id'],
                                "pp_TxnCurrency" => "PKR",
                                "pp_TxnDateTime" => date("YmdHis"),
                                "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
                                "pp_TxnRefNo" => uniqid("T"),
                                "pp_ReturnURL" => $global_config['jc_return_url'], // Adjust this to your return URL
                                "ppmpf_1" => $jobApplication['job_id'],
                                "ppmpf_2" => $jobApplication['applicant_id'],
                                "ppmpf_3" => $jobApplication['organization'],
                                "ppmpf_4" => $jobApplication['designation']
                            ];
    
                            // Generate secure hash
                            $integritySalt = $global_config['jc_merchant_is'];
                            $parameters["pp_SecureHash"] = $this->generateSecureHash($parameters, $integritySalt);
                            print_r($parameters);
                            print_r($global_config['jc_card_url']);
                             die;
                            
                            // Directly output the form and submit it automatically
                            echo '<html><body>';
                            echo '<form id="autoSubmitForm" method="post" action="' . $global_config['jc_card_url'] . '">';
                            foreach ($parameters as $key => $value) {
                                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                            }
                            echo '</form>';
                            
                            // Add session keep-alive script
                            echo '<script>
                                setInterval(function() {
                                    fetch("' . base_url('keep-alive') . '", { method: "GET" });
                                }, 300000); // Keep session alive every 5 minutes
                            
                                document.getElementById("autoSubmitForm").submit();
                            </script>';
                            echo '</body></html>';
                            exit();
                        
                    } else {
                        set_alert('error', 'You need to apply first');
                        redirect('job/apply/'.$applicationId);
                    }
                } else {
                    set_alert('error', 'Job Is Not Active');
                    redirect('job/apply/'.$applicationId);
                }
            }
        } else {
            redirect('job/apply/'.$applicationId); // Redirect if no submission
        }
    }
/* public function payChallan($applicationId)
{
    $global_config = $this->db->get_where('global_settings', array('id' => 1))->row_array();

    if ($this->input->post('submit') == 'update') {
        $post = $this->input->post();
        $jobApplication = $this->job_model->getChallanDetail($post['job_application_id']);

        if (!$jobApplication) {
            show_404(); // Show 404 if job is not found
        } else {
            if ($jobApplication['status'] == 'Active') {
                $userID = get_loggedin_user_id();
                if ($jobApplication['job_end_date'] > date("Y-m-d")) {
                    if ($this->applicants_model->isAlreadyApplied($userID, $post['job_id'])) {
                        $this->form_validation->set_rules('pp_MobileNumber', translate('pp_MobileNumber'), 'required');
                        $this->form_validation->set_rules('pp_BillReference', translate('pp_BillReference'), 'required');
                        $this->form_validation->set_rules('pp_CNIC', translate('pp_CNIC'), 'required');
                        $this->form_validation->set_rules('pp_Description', translate('pp_Description'), 'required');

                        if ($this->form_validation->run() == true) {
                            // Prepare task data for asynchronous processing
                            $taskData = [
                                'pp_Amount' => $post['pp_Amount'],
                                'pp_BillReference' => $post['pp_BillReference'],
                                'pp_CNIC' => $post['pp_CNIC'],
                                'pp_Description' => $post['pp_Description'],
                                'pp_MobileNumber' => $post['pp_MobileNumber'],
                                'job_id' => $post['job_id'],
                                'applicant_id' => $post['applicant_id'],
                                'merchant_id' => $global_config['jc_merchant_id'],   // Merchant ID
                                'merchant_pwd' => $global_config['jc_merchant_pwd'],   // Merchant Password
                                'merchant_is' => $global_config['jc_merchant_is'],     // Integrity Salt
                                'merchant_secret' => $global_config['jc_merchant_is'],  // Secret
                                'api_url' => $global_config['jc_testing_url'],          // API URL
                                'status' => 'pending',
                                'created_at' => date("Y-m-d H:i:s")
                            ];

                            // Save the task in the async_tasks table
                            $this->db->insert('async_tasks', $taskData);

                            // Notify the user
                            set_alert('success', 'Your payment request has been submitted and will be processed shortly.');
                            redirect(base_url('job/challans'));
                        } else {
                            set_alert('error', 'Required Data Is Missing');
                        }
                    } else {
                        set_alert('error', 'You need to apply first');
                    }
                } else {
                    set_alert('error', 'Job Is Not Active');
                }
            } else {
                set_alert('error', 'Job Is Not Active');
            }
        }
    }

    $jobApplication = $this->job_model->getChallanDetail($applicationId);

    if (!$jobApplication) {
        show_404(); // Show 404 if job is not found
    }

    $this->data['jobApplication'] = $jobApplication;
    $this->data['title'] = 'Pay Challan';
    $this->data['sub_page'] = 'job/payChallan';
    $this->data['main_menu'] = 'jobs';

    $this->load->view('layout/index', $this->data);
}
*/

   public function payChallan($applicationId)
{
    $global_config = $this->db->get_where('global_settings', array('id' => 1))->row_array();

    if ($this->input->post('submit') == 'update') {
        $this->data['is_processing'] = true;
        $post = $this->input->post();

        $jobApplication = $this->job_model->getChallanDetail($post['job_application_id']);

        if (!$jobApplication) {
            show_404(); // Show 404 if job is not found
        } else {
            if ($jobApplication['status'] == 'Active') {
                $userID = get_loggedin_user_id();
                if ($jobApplication['job_end_date'] > date("Y-m-d")) {
                    if ($this->applicants_model->isAlreadyApplied($userID, $post['job_id'])) {
                        $this->form_validation->set_rules('pp_MobileNumber', translate('pp_MobileNumber'), 'required');
                        $this->form_validation->set_rules('pp_BillReference', translate('pp_BillReference'), 'required');
                        $this->form_validation->set_rules('pp_CNIC', translate('pp_CNIC'), 'required');
                        $this->form_validation->set_rules('pp_Description', translate('pp_Description'), 'required');

                        if ($this->form_validation->run() == true) {
                            $parameters = [
                                "pp_Amount" => $post['pp_Amount'], // Amount in paisas
                                "pp_BillReference" => $post['pp_BillReference'],
                                "pp_CNIC" => $post['pp_CNIC'],
                                "pp_Description" => $post['pp_Description'],
                                "pp_Language" => "EN",
                                "pp_MerchantID" => $global_config['jc_merchant_id'],
                                "pp_MobileNumber" => $post['pp_MobileNumber'],
                                "pp_Password" => $global_config['jc_merchant_pwd'],
                                "pp_TxnCurrency" => "PKR",
                                "pp_TxnDateTime" => date("YmdHis"),
                                "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
                                "pp_TxnRefNo" => uniqid("T"),
                                "ppmpf_1" => $post['job_id'],
                                "ppmpf_2" => $post['applicant_id']
                            ];

                            $integritySalt = $global_config['jc_merchant_is']; // Replace with actual integrity salt
                            $parameters["pp_SecureHash"] = $this->generateSecureHash($parameters, $integritySalt);

                            $apiUrl = $global_config['jc_testing_url'];
                            $ch = curl_init($apiUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Content-Type: application/json',
                            ]);

                            $response = curl_exec($ch);
                            $this->db->reconnect(); // Reconnect after long external API call

                            if (curl_errno($ch)) {
                                log_message('error', "Curl Error: " . curl_error($ch));
                                set_alert('error', "Curl Error: " . curl_error($ch));
                            } else {
                                $decodedResponse = json_decode($response, true);

                                if ($decodedResponse && $decodedResponse['pp_ResponseCode'] === "000") {
                                    $txnDateTime = $decodedResponse['pp_TxnDateTime'];
                                    $date = substr($txnDateTime, 0, 4) . '-' . substr($txnDateTime, 4, 2) . '-' . substr($txnDateTime, 6, 2);
                                    $time = substr($txnDateTime, 8, 2) . ':' . substr($txnDateTime, 10, 2) . ':' . substr($txnDateTime, 12, 2);
                                    $formattedDateTime = $date . ' ' . $time;

                                    $data = [
                                        'payment_date' => $formattedDateTime,
                                        'amount' => $decodedResponse['pp_Amount'] / 100,
                                        'transaction_id' => $decodedResponse['pp_TxnRefNo'],
                                        'bank_name' => 'JazzCash Wallet',
                                        'job_application_id' => $decodedResponse['pp_BillReference'],
                                        'company_name' => $post['company_name'],
                                        'job_position' => $post['job_position'],
                                        'payment_mode' => "JazzCash Wallet",
                                        'status_id' => 16,
                                        'payment_response_code' => $decodedResponse['pp_ResponseCode'],
                                        'payment_response' => json_encode($decodedResponse)
                                    ];

                                    $this->db->reconnect(); // Ensure reconnection before database update
                                    $response = $this->applicants_model->updatePayment($data);

                                    if ($response) {
                                        set_alert('success', $decodedResponse['pp_ResponseMessage']);
                                        redirect(base_url('job/challans'));
                                    } else {
                                        log_message('error', 'Payment update failed: ' . json_encode($data));
                                        set_alert('error', $decodedResponse['pp_ResponseMessage']);
                                    }
                                } else {
                                    set_alert('error', $decodedResponse['pp_ResponseMessage']);
                                }
                            }
                        } else {
                            set_alert('error', 'Required Data Is Missing');
                        }
                    } else {
                        set_alert('error', 'You need to apply first');
                    }
                } else {
                    set_alert('error', 'Job Is Not Active');
                }
            } else {
                set_alert('error', 'Job Is Not Active');
            }
        }
    }

    $this->db->reconnect(); // Ensure reconnection before fetching data
    $jobApplication = $this->job_model->getChallanDetail($applicationId);

    if (!$jobApplication) {
        show_404(); // Show 404 if job is not found
    }

    $this->data['jobApplication'] = $jobApplication;
    $this->data['title'] = 'Pay Challan';
    $this->data['sub_page'] = 'job/payChallan';
    $this->data['main_menu'] = 'jobs';

    $this->load->view('layout/index', $this->data);
}

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        
        if (!is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save' && is_superadmin_loggedin()) {
               
                $this->job_validation();
               
                
                if ($this->form_validation->run() == true) {
                    
                    $post = $this->input->post();
                    $response = $this->job_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('job'));
                } else {
                    $error = $this->form_validation->error_array();
    
                    $this->data['validation_error'] = true;
                }
            }

            $this->data['organizations'] = $this->job_model->getOrganizations();
            $this->data['qouta'] = $this->job_model->getQoutas();
            $this->data['designation'] = $this->job_model->getDesignations();
            $this->data['job_type'] = $this->job_model->getJobTypes();
            $this->data['jobs'] = $this->job_model->getJobsList();
        
            
            // Pass the data to the view
            $this->data['sub_page'] = 'website/jobs';
            
            $this->data['title'] = 'Jobs';
            $this->data['sub_page'] = 'job/add';
            $this->data['main_menu'] = 'jobs';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }
 
    

    public function viewDetail($job_id)
    {
      

        if ($this->input->post('submit') == 'Apply') {
            
            $post = $this->input->post();
                

            $job = $this->job_model->getJobDetails($post['job_id']);
        
            if (!$job) {
                show_404(); // Show 404 if job is not found
            }
            else{
               
                if($job['status']=='Active')
                {
                 
                    if($job['job_end_date'] >= date("Y-m-d"))
                    {
                        $userID = get_loggedin_user_id();
                       // if($this->applicants_model->getApplicantEducation($userID))
                       // {
                            
                            if(!$this->applicants_model->isAlreadyApplied($userID,$post['job_id']))
                            {
                                  
                                $response = $this->applicants_model->applyNow($post);
                                
                                if ($response) {
                                    set_alert('success', translate('information_has_been_saved_successfully'));
                                }
                                redirect(base_url('job/challans'));
                            }
                            else{
                          
                                set_alert('error', 'You have Already Applied');
                              
                            }
                           
                      //  }
                      //  else{
                           
                        //    set_alert('error', 'No Educational Information Is Added Please Add To Apply..');
                       // }

                    }
                    else{
                        set_alert('error', 'Job Is Not Active');
                    }
                  
                }
                else{
                    set_alert('error', 'Job Is Not Active');
                }
            }
        
        }

        $job = $this->job_model->getJobDetailsUser($job_id);
    
        if (!$job) {
            show_404(); // Show 404 if job is not found
        }
    
        $this->data['job'] = $job;
        //$this->load->view('job_view', $data);
        $this->data['sub_page'] = 'job/viewJobDetail';
        $this->load->view('layout/index', $this->data);
    }
    public function challans()
    {
        
        $jobs = $this->job_model->getChallans();
       
        
        $this->data['jobs'] = $jobs;
        
        $this->data['title'] = 'Challans';
        $this->data['sub_page'] = 'job/viewChallans';
        $this->data['main_menu'] = 'jobs';
       
        $this->load->view('layout/index', $this->data);

    }
    public function results()
    {
        
        $jobs = $this->job_model->getResults();
        
        $this->data['jobs'] = $jobs;
        
        $this->data['title'] = 'Results';
        $this->data['sub_page'] = 'job/viewResults';
        $this->data['main_menu'] = 'results';
       
        $this->load->view('layout/index', $this->data);

    }
    public function rollNoSlips()
    {
        
        $jobs = $this->job_model->getRollnoSlips();
        $this->data['jobs'] = $jobs;        
        $this->data['title'] = 'Roll No Slips';
        $this->data['sub_page'] = 'job/viewRollnoSlip';
        $this->data['main_menu'] = 'jobs';
       
        $this->load->view('layout/index', $this->data);

    }
    public function viewApplicationDetail($applicationId)
    {
        if(is_superadmin_loggedin()){
                if ($this->input->post('submit') == 'update') {
                    
                    $post = $this->input->post();
                           
                            $response = $this->applicants_model->updateJobApplication($post);
                          
                            if ($response) {
                                set_alert('success', translate('information_has_been_saved_successfully'));
                            }
                            redirect(base_url('job/viewApplicationDetail/'.$applicationId));
                                    
                }
                
                
                $application_details = $this->job_model->getApplicationDetail($applicationId);
                //print_r($application_details);
               
                $education = $this->education_model->getEducationByApplicant($application_details['id']);
                $document = $this->document_model->getDocumentByApplicant($application_details['id']);
             
                $experience = $this->experience_model->getExperienceByApplicant($application_details['id']);
               
                $certification = $this->certification_model->getCertificationsByApplicant($application_details['id']);
               
               // die;
             
                if (!$application_details) {
                    show_404(); // Show 404 if job is not found
                }
               
             
                $this->data['application'] = $application_details;
                $this->data['certifications'] = $certification;
                $this->data['experience'] = $experience;
                $this->data['education'] = $education;
                $this->data['document'] = $document;
                $this->data['title'] = 'Application Detail';
                $this->data['sub_page'] = 'job/viewApplicationDetail';
                $this->data['main_menu'] = 'jobs';
               
                $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }
    public function applications()
    {
        
        if ($this->input->post('submit') == 'updateShort') {
                
           
            $post = $this->input->post();
           
                    $response = $this->applicants_model->updateJobApplication($post);
                
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('/job/applications/'));
                            
        }
        $jobs = $this->job_model->getApplications(); 
        $this->data['jobs'] = $jobs;
        
        $this->data['title'] = 'Applications';
        $this->data['sub_page'] = 'job/viewApplications';
        $this->data['main_menu'] = 'jobs';
       
        $this->load->view('layout/index', $this->data);

    }

    public function create_qrcode($id)
    {
        $config['cachedir'] = FCPATH . 'uploads/qrcode_cache/';
        $this->load->library('ciqrcode', $config);
        header("Content-Type: image/png");
        $params['data'] = $id;
        $this->ciqrcode->generate($params);
    }

    public function downloadRollNoSlip($applicationId)
    {
        

        $application_details = $this->job_model->getApplicationDetail($applicationId);
        //print_r($application_details);
       
        $education = $this->education_model->getEducationByApplicant($application_details['id']);
        $document = $this->document_model->getDocumentByApplicant($application_details['id']);
     
        $experience = $this->experience_model->getExperienceByApplicant($application_details['id']);
       
        $certification = $this->certification_model->getCertificationsByApplicant($application_details['id']);
       
       // die;
     
        if (!$application_details) {
            show_404(); // Show 404 if job is not found
        }
       
     
        $this->data['applicant'] = $application_details;
        $this->data['certifications'] = $certification;
        $this->data['experience'] = $experience;
        $this->data['education'] = $education;
        $this->data['document'] = $document;
        $this->data['title'] = 'Application Detail';
        $this->data['sub_page'] = 'job/downloadRollNoSlip';
        $this->data['main_menu'] = 'jobs';
       
        $this->load->view('layout/index', $this->data);

    }
    public function challanUpdate($applicationId)
    {
      
       
        if ($this->input->post('submit') == 'update') {
            
            $post = $this->input->post();
                
            $jobApplication = $this->job_model->getChallanDetail($post['job_application_id']);
           
        
            if (!$jobApplication) {
                show_404(); // Show 404 if job is not found
            }
            else{
               
                //if($jobApplication['status']=='Active')
                //{
                    $userID = get_loggedin_user_id();
                    //if($jobApplication['job_end_date'] >= date("Y-m-d"))
                //    {
                       if($this->applicants_model->isAlreadyApplied($userID,$post['job_id']))
                            {
                                $this->form_validation->set_rules('payment_date', translate('payment_date'),'required');
                                $this->form_validation->set_rules('amount', translate('amount'), 'required');
                                $this->form_validation->set_rules('transaction_id', translate('transaction_id'), 'required');
                                $this->form_validation->set_rules('bank_name', translate('bank_name'), 'required');
                                if ($this->form_validation->run() == true) {
                                    $response = $this->applicants_model->updateChallan($post);
                                
                                    if ($response) {
                                        set_alert('success', translate('information_has_been_saved_successfully'));
                                    }
                                    redirect(base_url('job/viewJobs'));
                                }
                                else{
                                    set_alert('error', 'Required Data Is Missing');
                                } 
                               
                            }
                            else{
                          
                                set_alert('error', 'You need to apply first');
                              
                            }
                  //  }
            //        else{
                        set_alert('error', 'Job Is Not Active');
              //      }
                  
            //    }
              //  else{
                //    set_alert('error', 'Job Is Not Active');
            //    }
            }
        
        }
        $jobApplication = $this->job_model->getChallanDetail($applicationId);
        
        if (!$jobApplication) {
            show_404(); // Show 404 if job is not found
        }
        
        $this->data['jobApplication'] = $jobApplication;
        $this->data['title'] = 'Update Challans';
        $this->data['sub_page'] = 'job/challanUpdate';
        $this->data['main_menu'] = 'jobs';
       
        $this->load->view('layout/index', $this->data);

    }
    
    public function viewJobs()
    {

        if ($this->input->post('submit') == 'Apply') {
            
            $post = $this->input->post();
                

            $job = $this->job_model->getJobDetails($post['job_id']);
        
            if (!$job) {
                show_404(); // Show 404 if job is not found
            }
            else{
               
                if($job['status']=='Active')
                {
                 
                    if($job['job_end_date'] >= date("Y-m-d"))
                    {
                        $userID = get_loggedin_user_id();
                       // if($this->applicants_model->getApplicantEducation($userID))
                        //{
                            
                            if(!$this->applicants_model->isAlreadyApplied($userID,$post['job_id']))
                            {
                                  
                                $response = $this->applicants_model->applyNow($post);
                                
                                if ($response) {
                                    set_alert('success', translate('information_has_been_saved_successfully'));
                                }
                                redirect(base_url('job/challans'));
                            }
                            else{
                          
                                set_alert('error', 'You have Already Applied');
                              
                            }
                           
                      //  }
                      //  else{
                           
                        //    set_alert('error', 'No Educational Information Is Added Please Add To Apply..');
                       // }

                    }
                    else{
                        set_alert('error', 'Job Is Not Active');
                    }
                  
                }
                else{
                    set_alert('error', 'Job Is Not Active');
                }
            }
        
        }

            // Get filter parameters from GET request
            $organization_id = $this->input->get('organization');
            $qouta_id = $this->input->get('qouta');
            $designation_id = $this->input->get('designation');
            $job_type_id = $this->input->get('job_type');
            $location = $this->input->get('location');
            $qualification = $this->input->get('qualification');
            $status = $this->input->get('status');

            // Prepare the filter array
            $filter = [];
            if (isset($status)) {
                $filter['status'] = $status;
            }
            // Only add the filters to the array if they are set and not empty
            if (!empty($organization_id)) {
                $filter['organization'] = $organization_id;
            }
        
            if (!empty($qouta_id)) {
                $filter['qouta'] = $qouta_id;
            }
        
            if (!empty($designation_id)) {
                $filter['designation'] = $designation_id;
            }
        
            if (!empty($job_type_id)) {
                $filter['job_type'] = $job_type_id;
            }
        
            if (!empty($location)) {
                $filter['location'] = $location;
            }
            $page = $this->input->get('page') ?? 1;
            $limit = 10; // Number of jobs per page
            $offset = ($page - 1) * $limit;

            // Get filtered jobs for the current page
            $filter = $this->input->get();  // Assuming filters are passed as GET parameters
            $this->data['jobs'] = $this->job_model->getJobsListUser($filter, $limit, $offset);
            
            // Get total job count for pagination
            $this->data['total_jobs'] = $this->job_model->getTotalJobsCount($filter);
            
            // Calculate total pages
            $this->data['total_pages'] = ceil($this->data['total_jobs'] / $limit);
           
            // Fetch filter data for dropdowns
            $this->data['organizations'] = $this->job_model->getOrganizations();
            $this->data['qoutas'] = $this->job_model->getQoutas();
            $this->data['designation'] = $this->job_model->getDesignations();
            $this->data['job_type'] = $this->job_model->getJobTypes();
            $this->data['qualifications'] = $this->job_model->getQualifications();
            $this->data['organization_id'] = $organization_id;
            $this->data['qouta_id'] = $qouta_id;
            $this->data['designation_id'] = $designation_id;
            $this->data['job_type_id'] = $job_type_id;
            $this->data['location'] = $location;
            $this->data['page'] = $page;
            // Load the page view
            
            $this->data['title'] = 'View Jobs';
            $this->data['sub_page'] = 'job/viewJobs';
            $this->load->view('layout/index', $this->data);
        
        
    
    }
    /* branch information update here */
    public function edit($id = '')
    {
       
        if (is_superadmin_loggedin()) {
           
            $post = $this->input->post();
               
            if ($this->input->post('submit') == 'update') {
               
                $this->job_validation();
               
              
                if ($this->form_validation->run() == true) {
                    
                    $post = $this->input->post();
                    $response = $this->job_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('job'));
                } else {
                    $error = $this->form_validation->error_array();
    
                    $this->data['validation_error'] = true;
                }
            }

            $this->data['job'] = $this->job_model->getSingle('job', $id, true);

            $this->data['title'] = 'Jobs';
            $this->data['sub_page'] = 'job/edit';
       
            $this->data['main_menu'] = 'jobs';
           
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* delete information */
   public function delete_data1($id = '')
    {
        if (is_superadmin_loggedin()) {
            $this->db->where('job_id', $id);
            $this->db->delete('job_qualification');
        } 

        if (is_superadmin_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('job');
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $job_type_id = $this->input->post('job_type_id');
        if (!empty($job_type_id)) {
            $this->db->where_not_in('id', $job_type_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('job_type')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }


protected function job_validation()
{
    
    $this->form_validation->set_rules('organization_id', translate('organization_id'), 'trim|required');
    $this->form_validation->set_rules('qouta_id', translate('qouta_id'), 'trim|required');
    $this->form_validation->set_rules('job_type_id', translate('job_type_id'), 'trim|required');
    $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
    $this->form_validation->set_rules('qualifications[]', translate('qualifications'), 'trim|required');
    $this->form_validation->set_rules('description', translate('description'), 'trim|required');
    $this->form_validation->set_rules('start_date', translate('start_date'), 'trim|required');
    $this->form_validation->set_rules('end_date', translate('end_date'), 'trim|required');
    $this->form_validation->set_rules('no_of_positions', translate('no_of_positions'), 'trim|required');
    $this->form_validation->set_rules('age_limit_start', translate('age_limit_start'), 'trim|required');
    $this->form_validation->set_rules('age_limit_end', translate('age_limit_end'), 'trim|required');
    $this->form_validation->set_rules('job_add_file', 'job_add',array(array('handle_upload', array($this->application_model, 'jobAddUpload'))));
    $this->form_validation->set_rules('challan_amount', translate('challan_amount'), 'trim|required');
    //$this->form_validation->set_rules('is_active', translate('is_active'), 'trim|required');
    $this->form_validation->set_rules('location_id', translate('location_id'), 'trim|required');

}
}