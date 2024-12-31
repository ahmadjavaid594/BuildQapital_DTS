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
