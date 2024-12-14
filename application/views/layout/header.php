<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="DTS">
	<meta name="author" content="dts">

     <title>Domestic Testing Service - Pakistan</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
	<!-- include stylesheet -->
	<?php include 'stylesheet.php';?>

	<?php
	if(isset($headerelements)) {
		foreach ($headerelements as $type => $element) {
			if($type == 'css') {
				if(count($element)) {
					foreach ($element as $keycss => $css) {
						echo '<link rel="stylesheet" href="'. base_url('assets/' . $css) . '">' . "\n";
					}
				}
			} elseif($type == 'js') {
				if(count($element)) {
					foreach ($element as $keyjs => $js) {
						echo '<script type="text/javascript" src="' . base_url('assets/' . $js). '"></script>' . "\n";
					}
				}
			}
		}
	}
	?>
	<!-- ramom css -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/ramom.css');?>">
	<?php if ($theme_config["border_mode"] == 'false'): ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/skins/square-borders.css');?>">
	<?php endif; ?>

	<!-- If user have enabled CSRF proctection this function will take care of the ajax requests and append custom header for CSRF -->
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		var csrfData = <?php echo json_encode(csrf_jquery_token()); ?>;
		$(function($) {
			$.ajaxSetup({
				data: csrfData
			});
		});
	</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://wa.me/923333434187" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
</head>