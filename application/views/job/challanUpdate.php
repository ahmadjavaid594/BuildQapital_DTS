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
				<input type="hidden" name="job_application_id" id="job_application_id" value="<?php echo $jobApplication['unique_id']; ?>">
				<input type="hidden" name="job_id" id="job_id" value="<?php echo $jobApplication['id']; ?>">
				<input type="hidden" name="company_name" id="organization" value="<?php echo $jobApplication['organization']; ?>">
				<input type="hidden" name="job_position" id="designation" value="<?php echo $jobApplication['designation']; ?>">
				<input type="hidden" name="payment_mode" id="designation" value="Manual"/>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Job Application Id<span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" readonly class="form-control" name="job_application_id" required value="<?= set_value('unique_id', $jobApplication['unique_id']) ?>" />
						<span class="error"><?= form_error('job_application_id') ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Payment Date<span class="required">*</span></label>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
							<input type="text" class="form-control" name="payment_date" required value="<?= set_value('payment_date', $jobApplication['payment_date']) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
						</div>
						<span class="error"><?= form_error('payment_date') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Amount<span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text"  class="form-control" name="amount" readonly required value="<?= set_value('amount', $jobApplication['challan_amount']) ?>" />
						<span class="error"><?= form_error('amount') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Transaction Id<span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text"  class="form-control" name="transaction_id" required value="<?= set_value('transaction_id', $jobApplication['transaction_id']) ?>" />
						<span class="error"><?= form_error('transaction_id') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Bank Name<span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text"  class="form-control" name="bank_name" required value="<?= set_value('bank_name', $jobApplication['bank_name']) ?>" />
						<span class="error"><?= form_error('bank_name') ?></span>
					</div>
				</div>
				<div class="form-group">
							<label class="col-md-3 control-label">Challan Proof<span class="required">*</span></label>
							<div class="col-md-6">
							<input type="file" class="form-control" name="image_path" required  
							onchange="validateFile(this)" />
							<span class="error"><?=form_error('image_path') ?></span>
			    </div>
</div>	
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
<script>
   function validateFile(input) {
    const file = input.files[0];
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"]; // Allowed image types

    if (file) {
        // Check file size (1 MB = 1048576 bytes)
        if (file.size > 1048576) {
            alert("File size must be less than 1 MB.");
            input.value = ""; // Clear the input
            return;
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            alert("Only image files (JPEG, PNG, GIF, WebP) are allowed.");
            input.value = ""; // Clear the input
            return;
        }
    }
}

</script>
