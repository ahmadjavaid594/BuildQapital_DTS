<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> My Experiences</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Add Experience</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Company</th>	
								<th>Job Title</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Responsibilities</th>
								
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								
								foreach($experiences as $experience):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $experience['company'];?></td>			
								<td><?php echo $experience['job_title'];?></td>
								<td><?php echo $experience['start_date'];?></td>
								<td><?php echo $experience['end_date'];?></td>
								<td><?php echo $experience['responsibilities'];?></td>
								
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('experience/edit/'.$experience['id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('experience/delete_data/' . $experience['id']);?>
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
						<label class="col-md-3 control-label">Company<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="company" value="<?=set_value('company')?>" />
							<span class="error"><?=form_error('company') ?></span>
						</div>
					</div>
					
					
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Job Title<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="job_title" value="<?=set_value('job_title')?>" />
							<span class="error"><?=form_error('job_title') ?></span>
						</div>
					</div>
					    <div class="form-group">
						   <label class="col-md-3 control-label">Start Date<span class="required">*</span></label>
						   <div class="col-md-6">
							<div class="input-group">
							
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" required="" name="start_date" value="<?=set_value('start_date', date('Y-m-d'))?>" data-plugin-datepicker
								data-plugin-options='{ "todayHighlight" : true }' />
								</div>
							</div>
							<span class="error"><?=form_error('start_date')?></span>
						</div>
						<div class="form-group">
						   <label class="col-md-3 control-label">End Date<span class="required">*</span></label>
						   <div class="col-md-6">
							<div class="input-group">
							
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" name="end_date" required="" value="<?=set_value('end_date', date('Y-m-d'))?>" data-plugin-datepicker
								data-plugin-options='{ "todayHighlight" : true }' />
								</div>
							</div>
							<span class="error"><?=form_error('end_date')?></span>
						</div>
						
						
						<div class="form-group mt-md">
							<label class="col-md-3 control-label">Responsibilities<span class="required">*</span></label>
							<div class="col-md-6">
							<textarea class="form-control" id="responsibilities" name="responsibilities" rows="5" required="" placeholder="Enter your text here"></textarea>
        					
							<span class="error"><?=form_error('grade') ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Experience Proof<span class="required">*</span></label>
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