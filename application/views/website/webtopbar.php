<header class="header">
<style>
		.header-menu li a {
	color: white !important;
	font-size: 16px;
	padding: 10px 15px;
	text-decoration: none;
}
.header-menu li a.active {
	background-color: #007bff; /* Change background color for active item */
	color: #ffffff !important; /* Ensure active item text is white */
	border-radius: 5px;
}
.header-menu li a:hover {
	color: #ddd;
}
	</style>

	<div class="logo-env">
	    <a href="<?php echo base_url('home');?>" class="logo">
			<img src="<?php echo base_url('uploads/app_image/logo-small.png');?>" height="40">
		</a>


		<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="header-left hidden-xs">
		<ul class="header-menu">
			<!-- Sidebar Toggle Button -->
			<li><a href="<?php echo base_url('home'); ?>">Home</a></li>
			<li><a href="<?php echo base_url('services'); ?>">Services</a></li>
			<li><a href="<?php echo base_url('about'); ?>">About</a></li>
			<li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
			<li><a href="<?php echo base_url('jobs'); ?>">Jobs</a></li>
			<li><a href="<?php echo base_url('login'); ?>">Login</a></li>
			<li><a href="<?php echo base_url('register'); ?>">Register</a></li>
			
		</ul>
	</div>


</header>
