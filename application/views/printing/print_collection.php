<?php
	require "application/views/widgets/starting.php";
	//require PRODUCT_PATH."/core/ini_db.php";

	if(isset($_GET['action'])){
		$action_id = filter_input(INPUT_GET, "action");
	}else{
		echo "<h1>Action is Not selected</h1>";
		exit();
	}
			
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "application/views/widgets/top_include.php"; ?>
	<link href="<?php echo base_url("assets/css/receipt.min.css") ?>" rel="stylesheet">
	<style>
		body{
			max-width:280px;
			margin:auto;
			background: #eee;
		}
	</style>
</head>


<body>
	<?php require "collection_receipt.php"; ?>
	<script>
		$(window).on("load",function(){
			if(typeof Android == "object"){
				Android.ready();	
			}else if(terminal == true){
				const {ipcRenderer} = require('electron');
				var request = {task:"print-receipt"};
				ipcRenderer.send('asynchronous-message', request);
			} else {
				window.print();
				window.close();
			}
			//setTimeout(function(){ window.close(); }, 500);
		})
	</script>

</body>