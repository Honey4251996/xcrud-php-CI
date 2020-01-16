<?php require "widgets/starting.php"; 
	if(!has_permission() && false){
		header("Location:../index.php");
		exit();
	}
	
	//require_once PRODUCT_PATH.'/core/classes/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<?php //echo Xcrud::load_css(); ?>
</head>

<body class="nav-md">
    <div class="container body">
		<div class="main_container">
			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<?php //echo Xcrud::load_js(); ?>
</body>	
		
</html>