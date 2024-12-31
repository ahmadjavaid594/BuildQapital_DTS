<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('status')?>"><i class="fas fa-list-ul"></i> District List</a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Edit District</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<input type="hidden" name="district_id" id="district_id" value="<?php echo $data->id; ?>">
					<div class="form-group mt-md">
						<label class="col-md-3 control-label">District Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name', $data->name)?>" />
							<span class="error"><?=form_error('name') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Province<span class="required">*</span></label>
						<div class="col-md-6">
                        <?php
                            $provinces = $this->app_lib->getSelectListName('provinces');
                            echo form_dropdown("province_name", $provinces, set_value('province', $data->province_name), "class='form-control' required='' id='province'
                            data-width='100%' data-plugin-selectTwo");
                        ?>
                        <span class="error"><?=form_error('province')?></span>
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