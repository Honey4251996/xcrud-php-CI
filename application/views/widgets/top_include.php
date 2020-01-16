<?php 
	if(!isset($widgets)){
		header("Location:login");
		exit();
	}
	$this->load->helper("url");
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laundry Drive</title>
	<link rel="icon" href="<?php echo base_url("assets/photos/favicon.png") ?>" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/plugins/metismenu/metisMenu.min.css") ?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <!--link href="css/timeline.css" rel="stylesheet"-->
	

    <!-- Custom CSS -->
    <!--link //href="assets/plugins/sb-admin/css/sb-admin-2.css" rel="stylesheet"-->

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/plugins/morris/morris.css") ?>" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/plugins/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
	
	<!-- Select2 css -->
	<link href="<?php echo base_url("assets/plugins/select2/css/select2.css") ?>" rel="stylesheet">
	
	
	<link href="<?php echo base_url("assets/plugins/gentelella-master/css/custom.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/css/jquery.modal.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/css/scrum.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/css/theme.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/plugins/jquery-ui/jquery-ui.min.css") ?>" rel="stylesheet">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117563868-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-117563868-1');
	</script>-->

	<script>
		var terminal = false;
		var siteURL = "<?php echo site_url(); ?>";
		if (typeof module === "object" && typeof module.exports === "object") {
			window.temp = module;
			module = undefined;
			terminal = true;
		}
	</script>
	<script src="<?php echo base_url("assets/js/jquery.min.js") ?>" ></script>
	<script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js") ?>" ></script>
	<script src="<?php echo base_url("assets/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
	
	