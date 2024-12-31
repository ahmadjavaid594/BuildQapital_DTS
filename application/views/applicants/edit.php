<?php $widget = (is_superadmin_loggedin() ? '4' : '6'); ?>
<di





v class="row appear-animation" data-appear-animation="<?=$global_config['animations'] ?>">
	<div class="col-md-12 mb-lg">
		<div class="profile-head social">
			<div class="col-md-12 col-lg-4 col-xl-3">
				<div class="image-content-center user-pro">
					<div class="preview">
						
						<img src="<?= base_url($applicant['photo']); ?>">
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-5 col-xl-5">
				<h5><?php echo $applicant['name']; ?></h5>
				<ul>
					<li><div class="icon-holder" data-toggle="tooltip" data-original-title="<?=translate('department')?>"><i class="fas fa-user-tie"></i></div> <?=(!empty($applicant['department_name']) ? $staff['department_name'] : 'N/A'); ?></li>
					<li><div class="icon-holder" data-toggle="tooltip" data-original-title="<?=translate('birthday')?>"><i class="fas fa-birthday-cake"></i></div> <?=_d($applicant['birthday'])?></li>

					<li><div class="icon-holder" data-toggle="tooltip" data-original-title="<?=translate('mobile_no')?>"><i class="fas fa-phone"></i></div> <?=(!empty($applicant['mobileno']) ? $applicant['mobileno'] : 'N/A'); ?></li>
					<li><div class="icon-holder" data-toggle="tooltip" data-original-title="<?=translate('email')?>"><i class="far fa-envelope"></i></div> <?=$applicant['email']?></li>
					<li><div class="icon-holder" data-toggle="tooltip" data-original-title="<?=translate('present_address')?>"><i class="fas fa-home"></i></div> <?=(!empty($applicant['present_address']) ? $applicant['present_address'] : 'N/A'); ?></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel-group" id="accordion">
			<div class="panel panel-accordion">
				<div class="panel-heading">
					<h4 class="panel-title">
                      
						<a class="accordion-toggle" >
							<i class="fas fa-user-edit"></i> <?=translate('basic_details')?>
						</a>
					</h4>
				</div>
				<div id="profile" class="accordion-body collapse in">
					<?php echo form_open_multipart($this->uri->uri_string()); ?>
						<div class="panel-body">
							<fieldset>
								<input type="hidden" name="staff_id" id="staff_id" value="<?php echo $applicant['id']; ?>">
								
								
								

								<!-- employee details -->
								<div class="headers-line mt-md">
									<i class="fas fa-user-check"></i> Personal Details
								</div>
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
											<div class="input-group">
												<span class="input-group-addon"><i class="far fa-user"></i></span>
												<input class="form-control" name="name" type="text" value="<?=set_value('name', $applicant['name'])?>" />
											</div>
											<span class="error"><?php echo form_error('name'); ?></span>
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('gender')?></label>
											<?php
												$array = array(
													"" => translate('select'),
													"male" => translate('male'),
													"female" => translate('female')
												);
												echo form_dropdown("sex", $array, set_value('sex', $applicant['sex']), "class='form-control' data-plugin-selectTwo
												data-width='100%' data-minimum-results-for-search='Infinity'");
											?>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('religion')?></label>
											<input type="text" class="form-control" name="religion" value="<?=set_value('religion', $applicant['religion'])?>">
										</div>
									</div>
									<div class="col-md-4 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('blood_group')?></label>
											<?php
												$bloodArray = $this->app_lib->getBloodgroup();
												echo form_dropdown("blood_group", $bloodArray, set_value('blood_group', $applicant['blood_group']), "class='form-control populate' data-plugin-selectTwo
												data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
										</div>
									</div>

									<div class="col-md-4 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('birthday')?> </label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
												<input class="form-control" name="birthday" value="<?=set_value('birthday', $applicant['birthday'])?>" data-plugin-datepicker data-plugin-options='{ "startView": 2 }' autocomplete="off" type="text">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('cnic')?></label>
											<input type="text" class="form-control" name="cnic" value="<?=set_value('cnic', $applicant['cnic'])?>">
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label">New Password </label>
											<input type="password" class="form-control" name="password" placeholder="Only add password if you want to update it">
										</div>
									</div>
									
								</div>				
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('mobile_no')?> <span class="required">*</span></label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
												<input class="form-control" Required name="mobile_no" type="text" value="<?=set_value('mobile_no', $applicant['mobileno'])?>" />
											</div>
											<span class="error"><?php echo form_error('mobile_no'); ?></span>
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('email')?> <span class="required">*</span></label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
												<input class="form-control" Required name="email" type="text" value="<?=set_value('email', $applicant['email'])?>" />
											</div>
											<span class="error"><?php echo form_error('mobile_no'); ?></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label">Father Name <span class="required">*</span></label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
												<input class="form-control" Required name="father_name" type="text" value="<?=set_value('father_name', $applicant['father_name'])?>" />
											</div>
											<span class="error"><?php echo form_error('father_name'); ?></span>
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
										<label class="control-label">City</label>
											<?php
												$cities = $this->app_lib->getSelectListName('cities');
												echo form_dropdown("city", $cities, set_value('cities', $applicant['city']), "class='form-control populate' data-plugin-selectTwo
												data-width='100%' ");
											?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
										<label class="control-label">District</label>
											<?php
												$districts = $this->app_lib->getSelectListName('districts');
												echo form_dropdown("district", $districts, set_value('districts', $applicant['district']), "class='form-control populate' data-plugin-selectTwo
												data-width='100%'  ");
											?>
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
										<label class="control-label">Province</label>
											<?php
												$provinces = $this->app_lib->getSelectListName('provinces');
												echo form_dropdown("province", $provinces, set_value('provinces', $applicant['province']), "class='form-control populate' data-plugin-selectTwo
												data-width='100%' ");
											?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('present_address')?> <span class="required">*</span></label>
											<textarea class="form-control"  Required rows="2" name="present_address" placeholder="<?=translate('present_address')?>" ><?=set_value('present_address', $applicant['present_address'])?></textarea>
											<span class="error"><?php echo form_error('present_address'); ?></span>
										</div>
									</div>
									<div class="col-md-6 mb-sm">
										<div class="form-group">
											<label class="control-label"><?=translate('permanent_address')?></label>
											<textarea class="form-control"   Requiredrows="2" name="permanent_address" placeholder="<?=translate('permanent_address')?>" ><?=set_value('permanent_address', $applicant['permanent_address'])?></textarea>
										</div>
									</div>
								</div>

								
								<div class="row mb-md">
									<div class="col-md-12">
										<div class="form-group">
											<label for="input-file-now"><?=translate('profile_picture')?></label>
											<input type="file" name="user_photo" class="dropify" data-default-file="<?= base_url($applicant['photo']); ?>"/>
											<span class="error"><?php echo form_error('user_photo'); ?></span>
										</div>
									</div>
									<input type="hidden" name="old_user_photo" value="<?=$applicant['photo']?>">
								</div>

								<!-- login details -->
								
						
							</fieldset>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-offset-9 col-md-3">
									<button type="submit" name="submit" value="update" class="btn btn-default btn-block"><?=translate('update')?></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
											</div>		
			
</div>

<script type="text/javascript">
	var authenStatus = "<?=$applicant['active']?>";
</script>
