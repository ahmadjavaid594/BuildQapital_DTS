<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> My Certifications</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Add Certification</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Certification Name</th>	
								<th>Issued By</th>
								<th>Issue Date</th>
								<th>Expiration Id</th>
								<th>Credentials Id</th>
								
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								
								foreach($certifications as $certification):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $certification['certification_name'];?></td>			
								<td><?php echo $certification['issued_by'];?></td>
								<td><?php echo $certification['issue_date'];?></td>
								<td><?php echo $certification['expiration_date'];?></td>
								<td><?php echo $certification['credential_id'];?></td>
								
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('certification/edit/'.$certification['id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('certification/delete_data/' . $certification['id']);?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
				<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Certification Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="certification_name" value="<?=set_value('certification_name')?>" />
							<span class="error"><?=form_error('certification_name') ?></span>
						</div>
					</div>
					
					
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Issued By<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="issued_by" value="<?=set_value('issued_by')?>" />
							<span class="error"><?=form_error('issued_by') ?></span>
						</div>
					</div>
					    <div class="form-group">
						   <label class="col-md-3 control-label">Issue Date<span class="required">*</span></label>
						   <div class="col-md-6">
							<div class="input-group">
							
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" required="" name="issue_date" value="<?=set_value('issue_date', date('Y-m-d'))?>" data-plugin-datepicker
								data-plugin-options='{ "todayHighlight" : true }' />
								</div>
							</div>
							<span class="error"><?=form_error('start_date')?></span>
						</div>
						<div class="form-group">
						   <label class="col-md-3 control-label">Expiry Date<span class="required">*</span></label>
						   <div class="col-md-6">
							<div class="input-group">
							
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" name="expiration_date" required="" value="<?=set_value('expiration_date', date('Y-m-d'))?>" data-plugin-datepicker
								data-plugin-options='{ "todayHighlight" : true }' />
								</div>
							</div>
							<span class="error"><?=form_error('end_date')?></span>
						</div>
						
						
						<div class="form-group mt-md">
						<label class="col-md-3 control-label">Credential Id<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="credential_id" value="<?=set_value('credential_id')?>" />
							<span class="error"><?=form_error('credential_id') ?></span>
						</div>
					</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Certification Proof<span class="required">*</span></label>
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