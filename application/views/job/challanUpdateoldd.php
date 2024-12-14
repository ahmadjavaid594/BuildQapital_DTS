<?php
// JazzCash Configuration
$merchantID = "MC143717";
$password = "1gazgxz385";
$integeritySalt = "zd26z0h3f3";
$apiUrl = "https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/";


date_default_timezone_set('Asia/Karachi'); // Set timezone to Karachi
$txnDateTime = date('YmdHis');
$expiryTime = date('YmdHis', strtotime('+1 hours'));
$orderRef = 'T' . time();
$transactionAmount = 100; // Amount in Paisa (e.g., 100 PKR = 10000)

$fields = [
    "pp_Version" => "1.1",
    "pp_TxnType" => "MWALLET",
    "pp_Language" => "EN",
    "pp_MerchantID" => $merchantID,
    "pp_Password" => $password,
    "pp_TxnRefNo" => $orderRef,
    "pp_Amount" => $transactionAmount,
    "pp_TxnCurrency" => "PKR",
    "pp_TxnDateTime" => $txnDateTime,
    "pp_BillReference" => "billRef",
    "pp_Description" => "Test Transaction",
    "pp_TxnExpiryDateTime" => $expiryTime,
    "pp_ReturnURL" => "https://buildqapital.com/DTS/PaymentGateway/test",
    "pp_SecureHash" => "",
    "ppmpf_1" => "1",
    "ppmpf_2" => "2",
    "ppmpf_3" => "3",
    "ppmpf_4" => "4",
    "ppmpf_5" => "5"
];

// Generate Secure Hash
$secureHashData = '';
foreach ($fields as $key => $value) {
    if (!empty($value)) {
        $secureHashData .= $value . '&';
    }
}
$secureHashData = rtrim($secureHashData, '&');
$fields['pp_SecureHash'] = hash_hmac('sha256', $secureHashData, $integeritySalt);

// Build Form for Redirect
?>
<!DOCTYPE html>
<html>
<head>
    <title>JazzCash Payment</title>
</head>
<body>
    <form action="<?php echo $apiUrl; ?>" method="POST" id="jazzcash_payment_form">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
    value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <?php foreach ($fields as $key => $value): ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
        <?php endforeach; ?>
        <button type="submit">Pay with JazzCash</button>
    </form>
</body>
</html>
