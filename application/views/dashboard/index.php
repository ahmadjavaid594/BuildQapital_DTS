
<div class="dashboard-page">

<?php if (is_superadmin_loggedin()) { ?>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
				
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-briefcase"></i>
									<h5 class="text-muted">Jobs</h5>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php
									echo $total_jobs;
									?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Total Jobs</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-user-tie"></i>
									<h5 class="text-muted">Users</h5> </div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?=$total_users?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
											<span class="text-muted text-uppercase">Total Users</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-building" ></i>
									<h5 class="text-muted">Organizations</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_organizations;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Organizations</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-tasks" ></i>
									<h5 class="text-muted">Qoutas</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_qoutas;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Qoutas</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				
				</div>
			</div>
		</div>
	</div>
	
	<?php } ?>
	<!-- student quantity chart -->
	<?php if (is_superadmin_loggedin()) { ?>

	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
			
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-id-badge" ></i>
									<h5 class="text-muted">Job Type</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_job_types;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Job Types</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-map-marker-alt" ></i>
									<h5 class="text-muted">Locations</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_locations;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Locations</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-check" ></i>
									<h5 class="text-muted">Active</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_active_jobs;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Active Jobs</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-users" ></i>
									<h5 class="text-muted">Applications</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_applictions;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Applications</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-lg-3 col-sm-3">
			<div class="panel">
				<div class="row widget-row-in">
			
					<div class="col-lg-12 col-sm-12 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-credit-card" ></i>
									<h5 class="text-muted">Challans</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_challans_paid;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Challans Paid</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<?php if (is_applicant_loggedin()) { ?>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
				
					
					<div class="col-lg-3 col-sm-6">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-map-marker-alt" ></i>
									<h5 class="text-muted">Applied</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_applied;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Applied</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-check" ></i>
									<h5 class="text-muted">Short Listed</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_short_listed;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Total Short Listed</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-users" ></i>
									<h5 class="text-muted">Rejected</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_rejected;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Rejected Applications</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 ">
						<div class="panel-body">
						<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-id-badge" ></i>
									<h5 class="text-muted">Pending</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $total_pending;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
									<span class="text-muted text-uppercase">Pending Challans</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:20px; text-align:center; margin:auto;">
                    <h3 style="margin-top:30px; margin-bottom:20px; color:Red; padding:20px;">
                        New Job Openings - <a href="<?=base_url('job/viewJobs')?>">APPLY NOW!</a>
                    </h3>
                    <p>
                        Current Job Openings, Please review complete job advertisement:
                        <br>
                        <ul style="list-style:none; padding:0;">
                            <li>Computer Operator BPS-16</li>
                            <li>Web Master BPS-16</li>
                            <li>Assistant Accounts Officer BPS-16</li>
                            <li>Junior Clerk BPS-11</li>
                        </ul>
                        <br>
                        <span style="color:red;">Last Date to apply December 15, 2024</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

	<?php } ?>