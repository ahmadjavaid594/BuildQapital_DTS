<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('job')?>"><i class="fas fa-list-ul"></i> Jobs List</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Job</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
				<input type="hidden" name="job_id" id="job_id" value="<?php echo $job->id; ?>">
				
				<div class="form-group">
					<label class="col-md-3 control-label">Organization<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$organization = $this->app_lib->getSelectList('organization');
							echo form_dropdown("organization_id", $organization, set_value('organization_id', $job->organization_id), "class='form-control' required id='organization_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Qouta<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$qouta = $this->app_lib->getSelectList('qouta');
							echo form_dropdown("qouta_id", $qouta, set_value('qouta_id', $job->qouta_id), "class='form-control' required id='qouta_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Job Type<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$job_type = $this->app_lib->getSelectList('job_type');
							echo form_dropdown("job_type_id", $job_type, set_value('job_type_id', $job->job_type_id), "class='form-control' required id='job_type_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Designation<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$designations = $this->app_lib->getSelectList('designation');
							echo form_dropdown("designation_id", $designations, set_value('designation_id', $job->designation_id), "class='form-control' required id='designation_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Location<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$locations = $this->app_lib->getSelectList('location');
							echo form_dropdown("location_id", $locations, set_value('location_id', $job->location_id), "class='form-control' required id='location_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Qualifications<span class="required">*</span></label>
					<div class="col-md-6 mb-md">
						<?php

							$qualifications = $this->app_lib->getSelectList('qualification');
							$qualifications = array_filter($qualifications, function ($key) {
								return $key !== null && $key !== '';
							}, ARRAY_FILTER_USE_KEY);
							echo form_dropdown("qualifications[]", $qualifications, set_value('qualifications', ''), "class='form-control' required id='qualification_id' data-width='100%' data-plugin-selectTwo multiple data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Job Description<span class="required">*</span></label>
					<div class="col-md-6">
						<textarea class="form-control" id="description" name="description" rows="5" required><?= set_value('description', $job->description) ?></textarea>
						<span class="error"><?= form_error('description') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Start Date<span class="required">*</span></label>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
							<input type="text" class="form-control" name="start_date" required value="<?= set_value('start_date', $job->job_start_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
						</div>
						<span class="error"><?= form_error('start_date') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">End Date<span class="required">*</span></label>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
							<input type="text" class="form-control" name="end_date" required value="<?= set_value('end_date', $job->job_end_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
						</div>
						<span class="error"><?= form_error('end_date') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No of positions<span class="required">*</span></label>
					<div class="col-md-6">
						<input type="number" class="form-control" name="no_of_positions" required value="<?= set_value('no_of_positions', $job->no_of_positions) ?>" />
						<span class="error"><?= form_error('no_of_positions') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Age Limit<span class="required">*</span></label>
					<div class="col-md-3">
						<input type="number" placeholder="Min Age" class="form-control" name="age_limit_start" required value="<?= set_value('age_limit_start', $job->age_limit_start) ?>" />
						<span class="error"><?= form_error('age_limit_start') ?></span>
					</div>
					<div class="col-md-3">
						<input type="number" placeholder="Max Age" class="form-control" name="age_limit_end" required value="<?= set_value('age_limit_end', $job->age_limit_end) ?>" />
						<span class="error"><?= form_error('age_limit_end') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Job Add </label>
					<div class="col-md-6">
						<input type="file" class="form-control" name="add_file" required accept=".pdf" onchange="validateFileSize(this)" />
						<span class="error"><?= form_error('add_file') ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Syllabus File </label>
					<div class="col-md-6">
						<input type="file" class="form-control" name="syllabus_file" required  onchange="validateFile1(this)" />
						<span class="error"><?= form_error('syllabus_file') ?></span>
					</div>
				</div>
				<div class="form-group">
						<label class="col-md-3 control-label">Challan Amount <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number"  class="form-control" name="challan_amount" required='' value="<?=set_value('challan_amount', $job->challan_amount)?>" />
							<span class="error"><?=form_error('challan_amount') ?></span>
						</div>
					</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Is Active<span class="required">*</span></label>
					<div class="col-md-1">
						<input type="checkbox" class="form-control" name="is_active" <?= $job->is_active ? 'checked' : '' ?> />
						<span class="error"><?= form_error('is_active') ?></span>
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
	function validateFileSize(input) {
		const file = input.files[0];
		if (file && file.size > 1048576) { // 1 MB in bytes
			alert("File size must be less than 1 MB.");
			input.value = ""; // Clear the input
		}
	}
	function validateFile1(input) {
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
