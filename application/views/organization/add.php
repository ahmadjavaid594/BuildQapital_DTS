<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Organizations List</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Organization</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Organization Name</th>
								<th>Industry</th>
								<th>Website Link</th>
								<th>Email</th>
								<th>Company Size</th>
								<th>Description</th>
								<th>Location</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$organization = $this->db->get('organization')->result();
								foreach($organization as $organization):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $organization->name;?></td>
								<td><?php echo $organization->industry;?></td>
								<td><?php echo $organization->website;?></td>
								<td><?php echo $organization->email;?></td>	
								<td><?php echo $organization->company_size;?></td>					
								<td><?php echo $organization->description;?></td>
								<td><?php echo $organization->location;?></td>
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('organization/edit/'.$organization->id)?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('organization/delete_data/' . $organization->id);?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Organization Name <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"><?=form_error('name') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Industry <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="industry" value="<?=set_value('industry')?>" />
							<span class="error"><?=form_error('industry') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Website Link <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="website" value="<?=set_value('website')?>" />
							<span class="error"><?=form_error('website') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('email')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="<?=set_value('email')?>" />
							<span class="error"><?=form_error('email') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Company Size <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="company_size" value="<?=set_value('company_size')?>" />
							<span class="error"><?=form_error('company_size') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Location <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="location" value="<?=set_value('location')?>" />
							<span class="error"><?=form_error('location') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="description" value="<?=set_value('description')?>" />
							<span class="error"><?=form_error('description') ?></span>
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