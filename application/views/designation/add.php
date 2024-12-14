<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Designations List</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Designation</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Designation Name</th>	
								<th>Description</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$designations = $this->db->get('designation')->result();
								foreach($designations as $designation):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $designation->name;?></td>			
								<td><?php echo $designation->description;?></td>
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('designation/edit/'.$designation->id)?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('designation/delete_data/' . $designation->id);?>
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
						<label class="col-md-3 control-label">Designation Name <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"><?=form_error('name') ?></span>
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