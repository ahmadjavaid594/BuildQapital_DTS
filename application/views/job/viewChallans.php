
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:10px; text-align:center; margin:auto;">
                    <h3 style="margin-top:5px; margin-bottom:5px; color:Red; padding:10px;">
                        To make payment, you can deposit the fee to the following bank accounts or use JazzCash.
                    </h3>

                    <!-- Bank Account Details -->
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">Faysal Bank</h3>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Title:</strong> Domestic Testing Services Pvt Ltd</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Number:</strong> PK61FAYS3459301000003492</p>
                    </div>
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">JazzCash</h3>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Title:</strong> Domestic Testing Services Pvt Ltd</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Number:</strong> 141331124</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">IBAN:</strong> PK21JCMA0000000141331124</p>
                    </div>

                    <!-- JazzCash Payment Button -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Challans List</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Application Id</th>
								<th>Organization</th>
								<th>Designation</th>
								<th>Qouta</th>
								<th>Job type</th>
								<th>Applied On</th>
								<th>Payment Date</th>
								<th>Paid Amount</th>
								<th>Bank</th>
								<th>Transaction Id</th>	
								<th>Status</th>	
								<th>Remarks</th>	
								<th>Payment Mode</th>
								<th>Pay Challan</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								//$qualifications = $this->db->get('qualification')->result();
								foreach($jobs as $job):
											
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $job['unique_id'];?></td>	
								<td><?php echo $job['organization'];?></td>	
								<td><?php echo $job['designation'];?></td>			
								<td><?php echo $job['qouta'];?></td>		
								<td><?php echo $job['job_type'];?>
							    </td><td><?php echo $job['application_date'];?></td>			
								<td><?php echo $job['payment_date'];?></td>
								<td><?php echo $job['amount'];?></td>
								<td><?php echo $job['bank_name'];?></td>
								<td><?php echo $job['transaction_id'];?></td>
								<td><?php echo $job['job_status'];?></td>
                                <td><?php echo $job['remarks'];?></td>
								<td><?php echo $job['payment_mode'];?></td>
														
								<td class="min-w-c">
									<!--update link-->
									<?php  
									   if($job['status_id'] == 9 || $job['status_id'] == 16 && ($job['payment_mode'] != 'Card Payment' && $job['payment_mode'] != 'JazzCash Wallet' && $job['payment_mode'] != 'Manual' && $job['payment_mode'] != 'JazzCash Wallet' && $job['status']=="Active" && $job['job_end_date'] >= date("Y-m-d") && $job['payment_mode']!=""  )  )
									   {

									?>  
									<a href="<?=base_url('job/paymentModeSelection/'.$job['unique_id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php  }
								?>
									<!-- delete link -->
									<!--<?php echo btn_delete('job/delete_data1/' . $job['id']);?>!-->
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
				       <label class="col-md-3 control-label">Organization<span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$organization = $this->app_lib->getSelectList('organization');
							echo form_dropdown("organization_id", $organization, set_value('id'), "class='form-control' required='' id='organization_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
				       <label class="col-md-3 control-label">Qouta<span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$qouta = $this->app_lib->getSelectList('qouta');
							echo form_dropdown("qouta_id", $qouta, set_value('id'), "class='form-control' required='' id='qouta_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
				       <label class="col-md-3 control-label">Job Type<span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$job_type = $this->app_lib->getSelectList('job_type');
							echo form_dropdown("job_type_id", $job_type, set_value('id'), "class='form-control' required='' id='job_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
						
					</div>
					<div class="form-group">
				       <label class="col-md-3 control-label">Designation<span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$designations = $this->app_lib->getSelectList('designation');
							echo form_dropdown("designation_id", $designations, set_value('id'), "class='form-control' required='' id='designation_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
						
					</div>
					<div class="form-group">
				       <label class="col-md-3 control-label">Location<span class="required">*</span></label>
					   <div class="col-md-6">
						
						<?php
							$locations = $this->app_lib->getSelectList('location');
							echo form_dropdown("location_id", $locations, set_value('id'), "class='form-control' required='' id='designation_id'
							data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
						</div>
						
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Qualifications <span class="required">*</span></label>
						<div class="col-md-6 mb-md">
						<?php
							$qualifications = $this->app_lib->getSelectList('qualification');
							$qualifications = array_filter($qualifications, function ($key) {
								return $key !== null && $key !== '';
							}, ARRAY_FILTER_USE_KEY);
							echo form_dropdown("qualifications[]", $qualifications, set_value('id'), "class='form-control' required='' id='qualification_id'
							data-width='100%' data-plugin-selectTwo multiple data-minimum-results-for-search='Infinity'");
						?>
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Job Description<span class="required">*</span></label>
						<div class="col-md-6">
						<textarea class="form-control" id="description" name="description" rows="5" required="" placeholder="Enter your text here"></textarea>
        				<span class="error"><?=form_error('description') ?></span>
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
					
					<div class="form-group">
						<label class="col-md-3 control-label">No of positions <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number"  class="form-control" name="no_of_positions" required='' value="<?=set_value('age_limit_start')?>" />
							<span class="error"><?=form_error('no_of_positions') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Age Limit<span class="required">*</span></label>
						<div class="col-md-3">
							<input type="number" placeholder="Min Age"  class="form-control" name="age_limit_start" required='' value="<?=set_value('age_limit_start')?>" />
							<span class="error"><?=form_error('age_limit_start') ?></span>
						</div>
						<div class="col-md-3">
							<input type="number"  placeholder="Max Age" class="form-control" name="age_limit_end" required='' value="<?=set_value('age_limit_end')?>" />
							<span class="error"><?=form_error('age_limit_end') ?></span>
						</div>
					</div>
				    <div class="form-group">
						<label class="col-md-3 control-label">Job Add<span class="required">*</span></label>
						<div class="col-md-6">
						<input type="file" class="form-control" name="add_file" required accept=".pdf" 
              			 onchange="validateFileSize(this)" />
        				<span class="error"><?=form_error('age_limit_end') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Is Active<span class="required">*</span></label>
						<div class="col-md-1">
						<input type="checkbox" checked="" class="form-control" name="is_active" required
              			 />
        				<span class="error"><?=form_error('is_active') ?></span>
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
    function validateFileSize(input) {
        const file = input.files[0];
        if (file && file.size > 1048576) { // 1 MB in bytes
            alert("File size must be less than 1 MB.");
            input.value = ""; // Clear the input
        }
    }
</script>