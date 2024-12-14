<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> My Documents</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Add Document</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Document Name</th>
								<th></th>	
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								
								foreach($documents as $document):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $document['name'];?></td>			
							
							
								<td class="min-w-c">
									<!--update link-->
									<a  href="<?= base_url($document['image_path']); ?>" target="_blank" class="btn btn-default btn-circle icon">
										<i class="fas fa-eye"></i>
									</a>
									<!--<a href="<?=base_url('document/edit/'.$document['id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>!-->
									<!-- delete link -->
									<?php echo btn_delete('document/delete_data/' . $document['id']);?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
				<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<div class="form-group">
				       <label class="col-md-3 control-label">Document Type</label><span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$docTypes = $this->app_lib->getSelectList('doc_type');
							
							
							echo form_dropdown("name", $docTypes, set_value('name'), "class='form-control' required='' id='designation_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
						
					</div>
					
					
						<div class="form-group">
							<label class="col-md-3 control-label">Document Image<span class="required">*</span></label>
							<div class="col-md-6">
							<input type="file" class="form-control" name="image_path" required  
							onchange="validateFile(this)" />
							<span class="error"><?=form_error('image_path') ?></span>
							</div>
					</div>
					<footer class="panel-footer mt-lg">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" name="submit" value="save">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close();?>
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