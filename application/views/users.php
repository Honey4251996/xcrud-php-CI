<?php require "widgets/starting.php"; 
	if(!has_permission("Change Settings")){
		access_deny();
		exit();
	}
	//require_once PRODUCT_PATH.'/core/classes/user.php';
	$this->load->library("user");
	$user = new user;
	$table = $user->manage_users();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	
</head>

<body class="nav-md">
    <div class="container body">
		<div class="main_container">

			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				<div class="row">
					<?php echo $table->render(); ?>
				</div>
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	
</body>	
		
</html>