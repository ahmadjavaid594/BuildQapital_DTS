<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('status')?>"><i class="fas fa-list-ul"></i> Status List</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit Status</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<input type="hidden" name="status_id" id="status_id" value="<?php echo $data->id; ?>">
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">Status Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name', $data->name)?>" />
							<span class="error"><?=form_error('name') ?></span>
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