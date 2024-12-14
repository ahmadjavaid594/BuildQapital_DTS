<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('organization')?>"><i class="fas fa-list-ul"></i> Organizations List</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i>Create Organizationn</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $data->id; ?>">
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Organization Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name', $data->name)?>" />
							<span class="error"><?=form_error('name') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Industry <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="industry" value="<?=set_value('industry', $data->industry)?>" />
							<span class="error"><?=form_error('industry') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Website Link <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="website" value="<?=set_value('website', $data->website)?>"  />
							<span class="error"><?=form_error('website') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('email')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="email" value="<?=set_value('email', $data->email)?>" />
							<span class="error"><?=form_error('email') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Company Size<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="company_size" value="<?=set_value('company_size', $data->company_size)?>" />
							<span class="error"><?=form_error('company_size') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Location<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="location" value="<?=set_value('location', $data->location)?>" />
							<span class="error"><?=form_error('location') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="description" value="<?=set_value('description', $data->description)?>" />
							<span class="error"><?=form_error('description') ?></span>
						</div>
					</div>
					<footer class="panel-footer mt-lg">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" name="submit" value="save">
									<i class="fas fa-plus-circle"></i> <?=translate('update')?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</section>