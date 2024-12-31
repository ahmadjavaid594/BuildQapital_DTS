<section class="panel">
    <div class="tabs-custom">
	<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('education')?>"><i class="fas fa-list-ul"></i> My Education</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Education</a>
			</li>
		</ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane active">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="education_id" value="<?= $data->id ?>" />
                    
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Institution <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="institution" value="<?= set_value('institution', $data->institution) ?>" />
                            <span class="error"><?= form_error('institution') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Degree <span class="required">*</span></label>
                        <div class="col-md-6 mb-md">
                            <?php
                                $qualifications = $this->app_lib->getSelectListName('qualification');
                                echo form_dropdown("degree", $qualifications, set_value('degree', $data->degree), "class='form-control' required='' id='qualification_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
                            ?>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Field of Study <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="field_of_study" value="<?= set_value('field_of_study', $data->field_of_study) ?>" />
                            <span class="error"><?= form_error('field_of_study') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Start Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" required="" name="start_date" value="<?= set_value('start_date', $data->start_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                            <span class="error"><?= form_error('start_date') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">End Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" name="end_date" required="" value="<?= set_value('end_date', $data->end_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                            <span class="error"><?= form_error('end_date') ?></span>
                        </div>
                    </div>

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Total Marks/GPA <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="total_marks" value="<?= set_value('total_marks', $data->total_marks) ?>" />
                            <span class="error"><?= form_error('total_marks') ?></span>
                        </div>
                    </div>

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Obtained Marks/GPA <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="obtained_marks" value="<?= set_value('obtained_marks', $data->obtained_marks) ?>" />
                            <span class="error"><?= form_error('obtained_marks') ?></span>
                        </div>
                    </div>

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Grade/Division <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="grade" value="<?= set_value('grade', $data->grade) ?>" />
                            <span class="error"><?= form_error('grade') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Degree Image <span class="required">*</span></label>
                        <div class="col-md-6">
                            
                            <input type="file" class="form-control" name="image_path" onchange="validateFile(this)" />
                            <span class="error"><?= form_error('image_path') ?></span>
                        </div>
                    </div>

                    <footer class="panel-footer mt-lg">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-default btn-block" name="submit" value="update">
                                    <i class="fas fa-save"></i> <?= translate('update') ?>
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
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if (file) {
        if (file.size > 1048576) {
            alert("File size must be less than 1 MB.");
            input.value = "";
            return;
        }
        
        if (!allowedTypes.includes(file.type)) {
            alert("Only image files (JPEG, PNG, GIF, WebP) are allowed.");
            input.value = "";
            return;
        }
    }
}
</script>
