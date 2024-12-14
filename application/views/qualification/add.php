<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Qualification List</a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Qualification</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Qualification Name</th>	
								<th>Qualification Description</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$qualifications = $this->db->get('qualification')->result();
								foreach($qualifications as $qualification):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $qualification->name;?></td>			
								<td><?php echo $qualification->description;?></td>
								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('qualification/edit/'.$qualification->id)?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('qualification/delete_data/' . $qualification->id);?>
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
						<label class="col-md-3 control-label">Qualification Name <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"><?=form_error('name') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Qualification Descrition <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text"  class="form-control" name="description" value="<?=set_value('qualification')?>" />
							<span class="error"><?=form_error('qualification') ?></span>
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