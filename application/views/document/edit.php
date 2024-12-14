<section class="panel">
    <div class="tabs-custom">
	<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('document')?>"><i class="fas fa-list-ul"></i> My Documents</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Document</a>
			</li>
		</ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane active">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="document_id" value="<?= $data->id ?>" />
                    
                    <div class="form-group">
					<label class="col-md-3 control-label">Document Type<span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$docTypes = $this->app_lib->getSelectList('doc_type');
							echo form_dropdown("name", $docTypes, set_value('id', $data->name), "class='form-control' required id='organization_id' data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>

                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Document Image <span class="required">*</span></label>
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
