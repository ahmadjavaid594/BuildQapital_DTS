<!doctype html>
<html class="fixed sidebar-left-sm <?php echo ($theme_config['dark_skin'] == 'true' ? 'dark' : 'sidebar-light');?>">
    
    <style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
</style>   
<!-- html header -->
<?php $this->load->view('layout/header.php');?>
<!--
<body class="loading-overlay-showing" data-loading-overlay>
	<!-- page preloader -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://wa.me/923333434187" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
	
	<div class="loading-overlay dark">
		<div class="ring-loader">
			Loading <span></span>
		</div>
	</div>
	<section class="body">
		<!-- top navbar-->
		<?php $this->load->view('website/webtopbar.php');?>
        <?php $this->load->view($sub_page); ?>
		
		
	</section>
	<?php $this->load->view('layout/footer.php');?>
	<!-- JS Script -->
	<?php $this->load->view('layout/script.php');?>
	
	<?php
	$alertclass = "";
	if($this->session->flashdata('alert-message-success')){
		$alertclass = "success";
	} else if ($this->session->flashdata('alert-message-error')){
		$alertclass = "error";
	} else if ($this->session->flashdata('alert-message-info')){
		$alertclass = "info";
	}
	if($alertclass != ''):
		$alert_message = $this->session->flashdata('alert-message-'. $alertclass);
	?>
		<script type="text/javascript">
			swal({
				toast: true,
				position: 'top-end',
				type: '<?php echo $alertclass?>',
				title: '<?php echo $alert_message?>',
				confirmButtonClass: 'btn btn-default',
				buttonsStyling: false,
				timer: 8000
			})
		</script>
	<?php endif; ?>

	<!-- sweetalert box -->
	<script type="text/javascript">
		function confirm_modal(delete_url) {
			swal({
				title: "<?php echo translate('are_you_sure')?>",
				text: "<?php echo translate('delete_this_information')?>",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn btn-default swal2-btn-default",
				cancelButtonClass: "btn btn-default swal2-btn-default",
				confirmButtonText: "<?php echo translate('yes_continue')?>",
				cancelButtonText: "<?php echo translate('cancel')?>",
				buttonsStyling: false,
				footer: "<?php echo translate('deleted_note')?>"
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: delete_url,
						type: "POST",
						success:function(data) {
							swal({
							title: "<?php echo translate('deleted')?>",
							text: "<?php echo translate('information_deleted')?>",
							buttonsStyling: false,
							showCloseButton: true,
							focusConfirm: false,
							confirmButtonClass: "btn btn-default swal2-btn-default",
							type: "success"
							}).then((result) => {
								if (result.value) {
									location.reload();
								}
							});
						}
					});
				}
			});
		}
	</script>
	
	
</body>

</html>