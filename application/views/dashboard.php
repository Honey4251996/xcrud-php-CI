<?php 
	require "widgets/starting.php"; 
	if(has_permission("Collect Order")){
		header("location:collection.php");
		exit();
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
</head>

<body class="nav-sm">
    <div class="container body">
		<div class="main_container">
			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				
			</div>
			
		</div>
		
	</div>
	<?php require "widgets/bottom_include.php"; ?>
</body>	
		
</html>