<?php 
	require "widgets/starting.php"; 
	if(!has_permission('Change Settings')){
		header("Location:../index.php");
		exit();
	}
	$this->load->library('bs_form');
	bs_config::$theme = "theme1";
	$form = new form(form::HORIZONTAL,"company_info","ajax_form");
	$form->addField("logo", new ImageInput('company_logo',(isset($settings['company_logo'])?$settings['company_logo']:"")),'Comapny Logo');
	$form->addField("name", new textInput('company_name',(isset($settings['company_name'])?$settings['company_name']:"")),"Company Name");
	$form->addField("Tel", new textInput('company_tel',(isset($settings['company_tel'])?$settings['company_tel']:"")),"Telephone");
	$form->addField("receipt_header", new textarea('receipt_header',(isset($settings['receipt_header'])?$settings['receipt_header']:"")),"Receipt custom header");
	$form->addField("receipt_footer", new textarea('receipt_footer',(isset($settings['receipt_footer'])?$settings['receipt_footer']:"")),"Receipt footer");
	$form->title("Company Information");
	$form->fieldClass("form-control");
	$form->fieldClass("bs-editor",false,"receipt_header","receipt_footer");

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
	<script src="<?php echo base_url("assets/plugins/editors/ckeditor/ckeditor.js")?>"></script>
	<script src="<?php echo base_url("assets/plugins/bs-form/js/bs-form.js")?>"></script>
</body>	
		
</html>