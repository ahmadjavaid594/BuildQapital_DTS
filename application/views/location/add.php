<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i>Job Locations List</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Location</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Location</th>	
								<th>City</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$locations = $this->db->get('location')->result();
								foreach($locations as $location):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $location->name;?></td>			
								<td><?php echo $location->city;?></td>
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('location/edit/'.$location->id)?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('location/delete_data/' . $location->id);?>
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
						<label class="col-md-3 control-label">Location<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"><?=form_error('name') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label"> City<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="city" value="<?=set_value('city')?>" />
							<span class="error"><?=form_error('city') ?></span>
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