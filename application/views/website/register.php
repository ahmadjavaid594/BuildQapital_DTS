<style>
	.registerform{
		display: flex;
    justify-content: center;
    align-items: center;
	margin-top : 80px;
	
           
	}
	.maindiv{
		background: url('uploads/app_image/dts1.jpg') no-repeat center center/cover;
	}
</style>
<div id="declarationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="declarationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="declarationModalLabel">Declaration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Declarations:</strong></p>
        <p> I <strong><span id="modalName"><u>N/A</u></span></strong> having CNIC: <strong><span id="modalCnic"><u>N/A</u></span></strong> And Phone No: <strong><span id="modalMobile"><u>N/A</u></span> </strong>, do hereby solemnly declare that 
		</p>
        <ol>
          <li>All the information provided by me is correct and true to the best of my knowledge.</li>
          <li>I have never been dismissed from any Government service.</li>
          <li>I have never been involved in any criminal activities.</li>
          <li>I agree with the examination policies (Biometric verification, lens matching, etc.).</li>
          <li>This declaration is for job recruitment purposes only.</li>
        </ol>
        <p><strong>Note:</strong> If any information is found false, I will be liable for legal action.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="agreeDeclaration" class="btn btn-primary">I Agree</button>
      </div>
    </div>
  </div>
</div>


<div class="row maindiv">
	<div class="col-md-12">
		<div class="registerform">
		<section class="panel">
				
				<?php echo form_open_multipart($this->uri->uri_string()); ?>
					<div class="panel-body">
						<p style="background-color: #3c763d;
	padding: 5px;
	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	color:white;
	text-align:center;">If you are already a registered user, please  <a style="color:red" href="<?php echo base_url('/authentication');?>">Login</a>.</p>
						<div class="headers-line mt-md">
							<i class="fas fa-user-check"></i> User Registration
						</div>
						<div class="row">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-user"></i></span>
										<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" oninput="validateName(this,100)" />
									</div>
									<span class="error"><?php echo form_error('name'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('cnic')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-user"></i></span>
										<input type="number" maxlength="13" class="form-control" placeholder="3710112347745" name="cnic" value="<?=set_value('cnic')?>"  oninput="validateLength(this,13)" />
									</div>
									<span class="error"><?php echo form_error('cnic'); ?></span>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('gender')?></label>
									<?php
										$array = array(
											"" => translate('select'),
											"male" => translate('male'),
											"female" => translate('female')
										);
										echo form_dropdown("sex", $array, set_value('sex'), "class='form-control' data-plugin-selectTwo data-width='100%'
										data-minimum-results-for-search='Infinity'");
									?>
								</div>
							</div>
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('mobile_no')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
										<input class="form-control" name="mobile_no" placeholder="08001234774" oninput="validateLength(this,11)" type="number" value="<?=set_value('mobile_no')?>" autocomplete="off" />
									</div>
									<span class="error"><?php echo form_error('mobile_no'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('blood_group')?></label>
									<?php
										$bloodArray = $this->app_lib->getBloodgroup();
										echo form_dropdown("blood_group", $bloodArray, set_value("blood_group"), "class='form-control populate' data-plugin-selectTwo
										data-width='100%' data-minimum-results-for-search='Infinity' ");
									?>
								</div>
							</div>
	
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('birthday')?> </label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
										<input class="form-control" name="birthday" autocomplete="off" value="<?=set_value('birthday')?>" data-plugin-datepicker
										data-plugin-options='{ "startView": 2 }' type="text">
									</div>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label">Last Completed Degree</label>
									<input type="text" class="form-control" name="degree" value="<?=set_value('religion')?>">
								</div>
							</div>
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('religion')?></label>
									<input type="text" class="form-control" name="religion" value="<?=set_value('religion')?>">
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label">Father Name<span class="required">*</span></label>
									<input type="name" class="form-control" name="father_name" value="<?=set_value('religion')?>" oninput="validateName(this,100)">
								</div>
							</div>
							<div class="col-md-6 mb-sm">
								<div class="form-group">
								<label class="control-label">City<span class="required">*</span></label>
											
										<?php
											$cities = $this->app_lib->getSelectListName('cities');
											echo form_dropdown("city", $cities, set_value('id'), "class='form-control' required='' 
											data-width='100%' data-plugin-selectTwo");
										?>
									
									
								</div>
							</div>		
						</div>
						<div class="row">
						<div class="col-md-6 mb-sm">
								<div class="form-group">
									
								<label class="control-label">Province<span class="required">*</span></label>
										<?php
											$provinces = $this->app_lib->getSelectListName('provinces');
											echo form_dropdown("province", $provinces, set_value('nid'), "class='form-control' required=''
											data-width='100%' data-plugin-selectTwo");
										?>
									
								</div>
							</div>		
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label">District<span class="required">*</span></label>
											
										<?php
											$districts = $this->app_lib->getSelectListName('districts');
											echo form_dropdown("district", $districts, set_value('id'), "class='form-control' required='' id='designation_id'
											data-width='100%' data-plugin-selectTwo");
										?>
									
								</div>
							</div>		
						</div>
						
						
						<div class="row">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('present_address')?> <span class="required">*</span></label>
									<textarea class="form-control" rows="2" name="present_address" placeholder="<?=translate('present_address')?>" ><?=set_value('present_address')?></textarea>
								</div>
								<span class="error"><?php echo form_error('present_address'); ?></span>
							</div>
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('permanent_address')?></label>
									<textarea class="form-control" rows="2" name="permanent_address" placeholder="<?=translate('permanent_address')?>" ><?=set_value('permanent_address')?></textarea>
								</div>
							</div>
						</div>
	
						<!--custom fields details-->
					
						
						<div class="row mb-md">
							<div class="col-md-12">
								<div class="form-group">
									<label><?=translate('profile_picture')?></label>
									<input type="file" name="user_photo" class="dropify" />
									<span class="error"><?php echo form_error('user_photo'); ?></span>
								</div>
							</div>
						</div>
	
						<!-- login details -->
						<div class="headers-line">
							<i class="fas fa-user-lock"></i> <?=translate('login_details')?>
						</div>
	
						<div class="row mb-lg">
							<div class="col-md-6 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('email')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-envelope-open"></i></span>
										<input type="text" class="form-control" name="email" id="email" value="<?=set_value('email')?>" autocomplete="off" />
									</div>
									<span class="error"><?php echo form_error('email'); ?></span>
								</div>
							</div>
							<div class="col-md-3 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('password')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
										<input type="password" class="form-control" name="password" value="<?=set_value('password')?>" />
									</div>
									<span class="error"><?php echo form_error('password'); ?></span>
								</div>
							</div>
							<div class="col-md-3 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('retype_password')?> <span class="required">*</span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
										<input type="password" class="form-control" name="retype_password" value="<?=set_value('retype_password')?>" />
									</div>
									<span class="error"><?php echo form_error('retype_password'); ?></span>
								</div>
							</div>
						</div>
	
						<!-- social links -->
						
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-10 col-md-2">
								<button type="button" id="submitButton" class="btn btn-default btn-block">Register</button>

								<!--<button type="submit" name="submit" value="save" class="btn btn btn-default btn-block">  Register</button>!-->
							</div>
						</div>
					</footer>
				<?php echo form_close();?>
			</section>
		</div>
		
	</div>
</div>
<script>
  function validateLength(input, len) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > len) {
      input.value = input.value.slice(0, len);
    }
  }

function validateName(input, maxLength) {
    // Allow only alphabets, spaces, and hyphens
    input.value = input.value.replace(/[^a-zA-Z\s]/g, '');

    // Limit the input length to the specified maxLength
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}
  // Add event listener to the submit button
  document.getElementById("submitButton").addEventListener("click", function (event) {
    // Prevent default form submission
    event.preventDefault();

    // Fetch the values from the form
    const cnic = document.querySelector("input[name='cnic']").value;
    const name = document.querySelector("input[name='name']").value;
    const mobile_no = document.querySelector("input[name='mobile_no']").value;

    // Populate the modal with dynamic data
    document.getElementById("modalCnic").textContent = cnic || "N/A";
    document.getElementById("modalName").textContent = name || "N/A";
    document.getElementById("modalMobile").textContent = mobile_no || "N/A";

    // Show the declaration modal
    $("#declarationModal").modal("show");
  });

  // Add event listener to the Agree button in the modal
  document.getElementById("agreeDeclaration").addEventListener("click", function () {
    // Close the modal
    $("#declarationModal").modal("hide");

    // Submit the form programmatically
    document.querySelector("form").submit();
  });
</script>

