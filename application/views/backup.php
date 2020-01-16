<?php require "widgets/starting.php"; 
	if(!has_permission("Change Settings")){
		access_deny();
		exit();
	}
	
	//require_once PRODUCT_PATH.'/core/classes/';
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
				<div class="panel panel-info">
					<div class="panel-heading">Create Backup</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<h2>Back up the database</h2>
							</div>
							<div class="col-sm-6">
								<a target="_blank" href="../backup/create_backup.php" class="btn btn-primary">Back up</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	
</body>	
		
</html>