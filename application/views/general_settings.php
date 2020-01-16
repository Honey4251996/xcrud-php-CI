<?php 
	require "widgets/starting.php"; 
	if(!has_permission("General Settings")){
		header("Location:../index.php");
		exit();
	}
	$this->load->library('bs_form');
	bs_config::$theme = "theme1";
	$form = new form(form::HORIZONTAL,"general_settings","ajax_form");
	$form->addField("login_type", new selectList('login_type',(isset($settings['login_type'])?$settings['login_type']:""),array('list_users'=>"List Users",'username'=>'Ask for username')),'Login Type');
	$form->addField("address_on_receipt", new selectList('address_on_receipt',(isset($settings['address_on_receipt'])?$settings['address_on_receipt']:""),array('no'=>"No",'yes'=>'Yes')),'Customer address on receipt');
	$form->fieldClass("form-control");
	$form->title("General Settings");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<link href="<?php echo base_url("assets/plugins/bs-form/css/bs-form.css") ?>" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
		<div class="main_container">
			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				<div class="row">
					<?php 
						echo $form->render();
					?>
				</div>
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<!--<script src="<?php //echo base_url("assets/plugins/editors/ckeditor/ckeditor.js")?>"></script>-->
	<script src="<?php echo base_url("assets/plugins/bs-form/js/bs-form.js")?>"></script>
</body>	
		
</html>