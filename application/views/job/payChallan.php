<?php
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

// Populate Parameters
$parameters = [
    "pp_Amount" => $jobApplication['challan_amount'] * 100, // Amount in paisas
    "pp_BillReference" => $jobApplication['unique_id'],
    "pp_CNIC" => $jobApplication['cnic'],
    "pp_Description" => "Challan Payment for " . $jobApplication['designation'],
    "pp_Language" => "EN",
    "pp_MerchantID" => "MC143130",
    "pp_MobileNumber" => $jobApplication['mobile_number'],
    "pp_Password" => "wy249ytev5",
    "pp_TxnCurrency" => "PKR",
    "pp_TxnDateTime" => date("YmdHis"),
    "pp_TxnExpiryDateTime" => date("YmdHis", strtotime("+1 day")),
    "pp_TxnRefNo" => uniqid("T"),
    "ppmpf_1" => $jobApplication['bank_name'],
    "ppmpf_2" => $jobApplication['transaction_id']
];

$integritySalt = "zywe42e2su"; // Replace with actual integrity salt
$parameters["pp_SecureHash"] = generateSecureHash($parameters, $integritySalt);
?>
<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Update Challan</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="edit">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                <input type="hidden" name="job_application_id" id="job_application_id" value="<?php echo  $jobApplication['unique_id']; ?>">
				<input type="hidden" name="job_id" id="job_id" value="<?php echo $jobApplication['id']; ?>">
				<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $jobApplication['applicant_id']; ?>">
				<input type="hidden" name="pp_Amount" id="job_application_id" value="<?php echo $jobApplication['challan_amount'] * 100; ?>">
				<input type="hidden" name="pp_BillReference" value="<?php echo $jobApplication['unique_id']; ?>">
				<input type="hidden" name="pp_Description" value="<?php echo  "Challan Payment for " .$jobApplication['unique_id']; ?>">
				
				<input type="hidden" name="company_name" id="organization" value="<?php echo $jobApplication['organization']; ?>">
				<input type="hidden" name="job_position" id="designation" value="<?php echo $jobApplication['designation']; ?>">
				
                <!-- Hidden Fields for JazzCash Parameters -->
                <!--<?php foreach ($parameters as $key => $value): ?>
                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
                <?php endforeach; ?>!-->

                <!-- Mobile Number -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Mobile Number<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="pp_MobileNumber" required 
                               pattern="\d{11}" maxlength="11" minlength="11" title="Enter 11 digits mobile number (e.g., 03123456789)" 
                               placeholder="Enter Mobile Number" />
                        <span class="error"><?= form_error('mobile_number') ?></span>
                    </div>
                </div>

                <!-- Last 5 Digits of CNIC -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Last 5 Digits of CNIC<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="pp_CNIC" required 
                               pattern="\d{5}" maxlength="6" minlength="6" title="Enter the last 6 digits of CNIC" 
                               placeholder="Enter Last 6 Digits of CNIC" />
                        <span class="error"><?= form_error('pp_CNIC') ?></span>
                    </div>
                </div>

                <!-- Amount (Read-only) -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Amount<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="amount" readonly required 
                               value="<?= set_value('amount', $jobApplication['challan_amount']) ?>" />
                        <span class="error"><?= form_error('amount') ?></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <footer class="panel-footer mt-lg">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-3">
                            <button type="submit" class="btn btn-default btn-block" name="submit" value="update">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </footer>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
