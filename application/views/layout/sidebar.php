<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">
			<h4>Menu</h4>
		</div>
	</div>

	<div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <!-- dashboard -->
                    <li class="<?php if ($main_menu == 'dashboard') echo 'nav-active';?>">
                        <a href="<?=base_url('dashboard')?>">
                            <i class="fas fa-user"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <?php if (is_executive_loggedin()) : ?>
                    <li class="<?php if ($main_menu == 'job') echo 'nav-active';?>">
                        <a href="<?=base_url('job')?>">
                            <i class="fas fa-briefcase"></i><span>Jobs</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'organization') echo 'nav-active';?>">
                        <a href="<?=base_url('organization')?>">
                            <i class="fas fa-building"></i><span>Organizations</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'testSchedule') echo 'nav-active';?>">
                        <a href="<?=base_url('testSchedule')?>">
                            <i class="fas fa-briefcase"></i><span>Test Schedule</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'testCenters') echo 'nav-active';?>">
                        <a href="<?=base_url('testCenters')?>">
                            <i class="fas fa-briefcase"></i><span>Test Centers</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (is_superadmin_loggedin()) : ?>
                    <!-- branch -->
                    <li class="<?php if ($main_menu == 'organization') echo 'nav-active';?>">
                        <a href="<?=base_url('organization')?>">
                            <i class="fas fa-building"></i><span>Organizations</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'designation') echo 'nav-active';?>">
                        <a href="<?=base_url('designation')?>">
                            <i class="icons icon-directions"></i><span>Designations</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'qouta') echo 'nav-active';?>">
                        <a href="<?=base_url('qouta')?>">
                            <i class="fas fa-tasks"></i><span>Qouta</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'location') echo 'nav-active';?>">
                        <a href="<?=base_url('location')?>">
                            <i class="fas fa-map-marker-alt"></i><span>Location</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'city') echo 'nav-active';?>">
                        <a href="<?=base_url('city')?>">
                            <i class="fas fa-map-marker-alt"></i><span>City</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'province') echo 'nav-active';?>">
                        <a href="<?=base_url('province')?>">
                            <i class="fas fa-map-marker-alt"></i><span>Provice</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'district') echo 'nav-active';?>">
                        <a href="<?=base_url('district')?>">
                            <i class="fas fa-map-marker-alt"></i><span>District</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'job_type') echo 'nav-active';?>">
                        <a href="<?=base_url('job_type')?>">
                            <i class="fas fa-id-badge"></i><span>Job types</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'qualification') echo 'nav-active';?>">
                        <a href="<?=base_url('qualification')?>">
                            <i class="icons icon-loop"></i><span>Qualifications</span>
                        </a>
                    </li>

                    <li class="<?php if ($main_menu == 'job') echo 'nav-active';?>">
                        <a href="<?=base_url('job')?>">
                            <i class="fas fa-briefcase"></i><span>Jobs</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'docType') echo 'nav-active';?>">
                        <a href="<?=base_url('docType')?>">
                            <i class="fas fa-file"></i><span>Document Types</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'testCenters') echo 'nav-active';?>">
                        <a href="<?=base_url('testCenters')?>">
                            <i class="fas fa-briefcase"></i><span>Test Centers</span>
                        </a>
                    </li>
                   
                    <li class="<?php if ($main_menu == 'testSchedule') echo 'nav-active';?>">
                        <a href="<?=base_url('testSchedule')?>">
                            <i class="fas fa-briefcase"></i><span>Test Schedule</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'job/applications') echo 'nav-active';?>">
                        <a href="<?=base_url('job/applications')?>">
                            <i class="fas fa-briefcase"></i><span>Job Applications</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'users') echo 'nav-active';?>">
                        <a href="<?=base_url('applicants')?>">
                            <i class="fas fa-briefcase"></i><span>Users</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'contactUs') echo 'nav-active';?>">
                        <a href="<?=base_url('contactUs')?>">
                            <i class="fas fa-briefcase"></i><span>Applicant Queries</span>
                        </a>
                    </li>
                    <!--<li class="<?php if ($main_menu == 'status') echo 'nav-active';?>">
                        <a href="<?=base_url('status')?>">
                            <i class="fas fa-briefcase"></i><span>Status</span>
                        </a>
                    </li>!-->
                   
                    <?php endif; ?>
                    
                    <?php if (is_applicant_loggedin()) : ?>
                   
                    <li class="<?php if ($main_menu == 'profile') echo 'nav-active';?>">
                        <a href="<?=base_url('applicants/edit/')?>">
                            <i class="fas fa-user"></i><span>Profile</span>
                        </a>
                    </li>
                    <!-- branch -->
                    <li class="<?php if ($main_menu == 'education') echo 'nav-active';?>">
                        <a href="<?=base_url('education')?>">
                            <i class="fas fa-pen"></i><span>Education</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'experience') echo 'nav-active';?>">
                        <a href="<?=base_url('experience')?>">
                            <i class="fas fa-briefcase"></i><span>Experiences</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'certification') echo 'nav-active';?>">
                        <a href="<?=base_url('certification')?>">
                            <i class="fas fa-certificate"></i><span>Certifications</span>
                        </a>
                    </li>
                  
                    <li class="<?php if ($main_menu == 'job/viewJobs') echo 'nav-active';?>">
                        <a href="<?=base_url('job/viewJobs')?>">
                            <i class="fas fa-briefcase"></i><span>Jobs</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'syllabus') echo 'nav-active';?>">
                        <a href="<?=base_url('syllabus')?>">
                            <i class="fas fa-file"></i><span>Test Syllabus</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'job/challans') echo 'nav-active';?>">
                        <a href="<?=base_url('job/challans')?>">
                            <i class="fas fa-briefcase"></i><span>Challans</span>
                        </a>
                    </li>
                    <li class="<?php if ($main_menu == 'document') echo 'nav-active';?>">
                        <a href="<?=base_url('document')?>">
                            <i class="fas fa-file"></i><span>My Documents</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'job/rollNoSlips') echo 'nav-active';?>">
                        <a href="<?=base_url('job/rollNoSlips')?>">
                            <i class="fas fa-briefcase"></i><span>Roll No Slips</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'declaration') echo 'nav-active';?>">
                        <a href="<?=base_url('declaration')?>">
                            <i class="fas fa-file"></i><span>Declaration</span>
                        </a>
                    </li>
                     <li class="<?php if ($main_menu == 'contactUs') echo 'nav-active';?>">
                        <a href="<?=base_url('contactUs')?>">
                            <i class="fas fa-briefcase"></i><span>Ask Queries?</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                   
                    <?php

                    $schoolSettings = false;
                    if (get_permission('school_settings', 'is_view') ||
                    get_permission('live_class_config', 'is_view') ||
                    get_permission('payment_settings', 'is_view') ||
                    get_permission('sms_settings', 'is_view') ||
                    get_permission('email_settings', 'is_view') ||
                    get_permission('accounting_links', 'is_view')) {
                        $schoolSettings = true;
                    }
                    if (get_permission('global_settings', 'is_view') ||
                    ($schoolSettings == true) ||
                    get_permission('translations', 'is_view') ||
                    get_permission('cron_job', 'is_view') ||
                    get_permission('custom_field', 'is_view') ||
                    get_permission('backup', 'is_view')) {
                    ?>
                    <!-- setting -->
                    <li class="nav-parent <?php if ($main_menu == 'settings' || $main_menu == 'school_m') echo 'nav-expanded nav-active';?>">
                        <a>
                            <i class="icons icon-briefcase"></i><span><?=translate('settings')?></span>
                        </a>
                        <ul class="nav nav-children">
                            
                            <?php   if (is_superadmin_only()) { ?>
                           <!-- <li class="<?php if ($sub_page == 'role/index' || $sub_page == 'role/permission') echo 'nav-active';?>">
                                <a href="<?=base_url('role')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('role_permission')?></span>
                                </a>
                            </li>!-->
                            <?php }  ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
		<script>
			// maintain scroll position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>
	</div>
</aside>
<!-- end sidebar -->