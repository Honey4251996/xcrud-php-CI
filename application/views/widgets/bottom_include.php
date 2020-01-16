<?php 
	if(!isset($widgets)){
		header("Location:login");
		exit();
	}
?>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url("assets/plugins/metismenu/metisMenu.min.js") ?>"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url("assets/plugins/raphael/raphael-min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/morris/morris.min.js")?>"></script>

<!-- Custom Theme JavaScript -->
<!--script src="assets/plugins/sb-admin/js/sb-admin-2.js"></script-->

<!-- Select2 js -->
<script src="<?php echo base_url("assets/plugins/select2/js/select2.js")?>"></script>

<script src="<?php echo base_url("assets/plugins/gentelella-master/js/custom.js")?>"></script>
<script src="<?php echo base_url("assets/js/jquery.modal.min.js")?>"></script>
<script>
	if (window.temp) {
		module = window.temp;
		window.temp = undefined;
	}
	if(terminal == true){
		$(".shown-in-terminal").show();
	}
</script>
<script src="<?php echo base_url("assets/js/scrum.min.js")?>"></script>
	