<section class="panel">
    <div class="tabs-custom">
	<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('experience')?>"><i class="fas fa-list-ul"></i> My Experiences</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Experience</a>
			</li>
		</ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane active">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="experience_id" value="<?= $data->id ?>" />
                    
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Company <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="company" value="<?= set_value('company', $data->company) ?>" />
                            <span class="error"><?= form_error('company') ?></span>
                        </div>
                    </div>

    

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Job Title <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="job_title" value="<?= set_value('job_title', $data->job_title) ?>" />
                            <span class="error"><?= form_error('job_title') ?></span>
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
                        <label class="col-md-3 control-label">Responsibilities<span class="required">*</span></label>
                        <div class="col-md-6">
                        <textarea class="form-control" id="responsibilities"  name="responsibilities" rows="5" required="" placeholder="Enter your text here"><?= set_value('responsibilities', $data->responsibilities) ?></textarea>
        					
                            <span class="error"><?= form_error('grade') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Experience Proof <span class="required">*</span></label>
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
