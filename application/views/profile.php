<?php require "widgets/starting.php"; 
	//require_once PRODUCT_PATH.'/core/classes/user.php';
	$this->load->library("user");
	$user_id = $_SESSION[PRODUCT_ID]['user_id'];
	
	$user = new user;
	$profile = $user->profile();

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
				<div class="row rel">
					<a class="btn btn-default top-button" href="dashboard">Back</a>
				</div>
				<div class="row">
					<?php echo $profile->render('edit',$user_id);  ?>
				</div>
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<script>
		$(document).on('xcrudafterrequest',function(event,container){
			if(Xcrud.current_task == 'save'){
				//location.reload();
			}
		});
	</script>
</body>	
		
</html>