<?php require "widgets/starting.php"; 
	if(!has_permission("Change Settings")){
		header("Location:../index.php");
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
				<div class="form">
					<div class="form-group">
						<label class="control-label">Receipts Printer</label>
						<div class="">
							<select class="receipt-printer printers-list form-control">
								
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Reports Printer</label>
						<div class="">
							<select class="report-printer printers-list form-control">
								
							</select>
						</div>
					</div>
					<div class="btn btn-default save">Save</div>
				</div>
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<script>
		if(terminal == true){
			const {ipcRenderer} = require('electron');
			ipcRenderer.on('asynchronous-reply', (event, arg) => {
				var task = arg.task;
				var msg = {};
				switch (task){
					case "printers-list":
						var printers = arg.data;
						var list = "";
						for(var i in printers){
							list += "<option value"+printers[i]['name']+">"+printers[i]['name']+"</option>";
						}
						$(".printers-list").html(list);
						msg = {task:"selected-printers"};
						ipcRenderer.send('asynchronous-message', msg);
					break;
					case "selected-printers":
						var printers = JSON.parse(arg.data);
						$(".receipt-printer").val(printers.receiptPrinter);
						$(".report-printer").val(printers.reportPrinter);
						//console.log(JSON.parse(arg.data));
					break;
				}
			})
			
			var request = {task:"printers-list"};
			ipcRenderer.send('asynchronous-message', request);
			
			$(document).ready(function(){
				$(".save").on("click",function(){
					request.task = "save-printers";
					request.data = '{"receiptPrinter": "'+$(".receipt-printer").val()+'","reportPrinter": "'+$(".report-printer").val()+'"}';
					ipcRenderer.send('asynchronous-message', request);
					window.location.reload();
				});
			});
		}
	</script>
</body>	
		
</html>