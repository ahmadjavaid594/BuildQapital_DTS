<section class="panel">
    <div class="tabs-custom">
	<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('certification')?>"><i class="fas fa-list-ul"></i> My Certifications</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Certification</a>
			</li>
		</ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane active">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="certification_id" value="<?= $data->id ?>" />
                    
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Certification Name <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="certification_name" value="<?= set_value('certification_name', $data->certification_name) ?>" />
                            <span class="error"><?= form_error('certification_name') ?></span>
                        </div>
                    </div>

    

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Issued By <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="issued_by" value="<?= set_value('issued_by', $data->issued_by) ?>" />
                            <span class="error"><?= form_error('issued_by') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Issue Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" required="" name="issue_date" value="<?= set_value('issue_date', $data->issue_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                            <span class="error"><?= form_error('issue_date') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Expiration Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" name="expiration_date" required="" value="<?= set_value('expiration_date', $data->expiration_date) ?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                            <span class="error"><?= form_error('expiration_date') ?></span>
                        </div>
                    </div>

                    

                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Credential ID <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="credential_id" value="<?= set_value('credential_id', $data->credential_id) ?>" />
                            <span class="error"><?= form_error('credential_id') ?></span>
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
