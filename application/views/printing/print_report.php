<?php 
	require "application/views/widgets/starting.php";
	if(isset($_GET['report'])){
		$report_type = filter_input(INPUT_GET,'report');
	}else{
		echo '<h1>Error: No report selected</h1>';
		exit();
	}

	$this->load->library('report');
	$report = new report();
	
	if(isset($_GET["serial_st"])){
		$serial_st = filter_input(INPUT_GET,'serial_st');
	}else{
		$serial_st = '';
	}
	if(isset($_GET["serial_end"])){
		$serial_end = filter_input(INPUT_GET,'serial_end');
	}else{
		$serial_end = '';
	}
	
	if(isset($_GET["start_d"])){
		$start_d = filter_input(INPUT_GET,'start_d');
	}else{
		$start_d = 0;
	}
	
	if(isset($_GET["end_d"])){
		$end_d = filter_input(INPUT_GET,'end_d');
	}else{
		$end_d = 0;
	}
	
	if(isset($_GET["customer"])){
		$customer_id = filter_input(INPUT_GET,'customer');
	}else{
		$customer_id = 0;
	}
	
	if(isset($_GET["service"])){
		$service_id = filter_input(INPUT_GET,'service');
	}else{
		$service_id = 0;
	}
	
	if(isset($_GET["item"])){
		$item_id = filter_input(INPUT_GET,'item');
	}else{
		$item_id = 0;
	}
	
	$title='';
	switch($report_type){
		case "order":
			$table = $report->order_report($serial_st, $serial_end, $start_d, $end_d, $customer_id);
		break;
		case "payment":
			$table = $report->payment_report($start_d, $end_d, $customer_id);
		break;
		case "service":
			$table = $report->service_report($start_d, $end_d, $customer_id,$service_id,$item_id);
		break;
		default:
			echo '<h1>Error: Wrong Report selected</h1>';
			exit();
		break;
	}
	$table->unset_csv();
	$table->unset_title();
	if($customer_id == 0){
		$customer = "<b>All Customers</b>";
	}else{
		$customer_info = customer_data($customer_id);
		$customer = "";
		$customer .= "<b>".$customer_info['name']."</b><br>";
		$customer .= ($customer_info['mobile_num'] !="")?"Mob: ".$customer_info['mobile_num']."<br>":"" ;
		$customer .= ($customer_info['tel_num'] !="")?"Tel: ".$customer_info['tel_num']."<br>":"" ;
	}
	
	if($serial_st != 0 && $serial_end != 0){
		$range ="From ".str_pad($serial_st, 8,'0',STR_PAD_LEFT)." to ".str_pad($serial_end, 8,'0',STR_PAD_LEFT);
	}
//	
	if($start_d != 0 && $end_d != 0){
		$dates ="From ".date("d/m/Y",$start_d)." to ".date("d/m/Y",$end_d);
	}
//	$signature = get_user_data($_SESSION[PRODUCT_ID]['user_id'],'signature');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "application/views/widgets/top_include.php"; ?>
	<link href="<?php echo base_url("assets/css/printing01.min.css") ?>" rel="stylesheet">
	<style>
		.xcrud-list-container {
			max-height: none !important;
		}
		table { page-break-inside:auto }
		tr{ page-break-inside:avoid; page-break-after:auto }
		@page{
			margin: 0;
		}
	</style>
</head>

<body onload="printReport()">
	<?php require "application/views/widgets/printing/header.php"; ?>
	<div class="container-fluid content">
		<h2 class="text-center" style="margin:10px 0 10px 0"><?php echo $title; ?></h2>
		<div class="row">
			<div class="col-xs-12">
				<p class="line pull-right"><?php echo "Issue date: ".date("d/m/Y") ?></p>
			</div>
		</div>
		<div class="row gray-border" style="/*margin-top:15px;*/">
			<div class="col-xs-6">
				<p class="line"><?php echo $customer; ?></p>
			</div>
			<div class="col-xs-6">
				<p class="line"><?php echo isset($range)?"Serials: ".$range:"" ; ?></p>
				<p class="line"><?php echo isset($dates)?"Dates: ".$dates:"" ; ?></p>
				<p class="line"></p>
			</div>
		</div>
		
		<div class="row" style="margin-top:10px;">
			<?php echo $table->render(); ?>
			<div class="clearfix"></div>
		</div>
		
		<div class="finalize row gray-border" style="margin-top:15px;">
			<div class="col-xs-6 fix-height">
				<p>Prepared by: <?php echo user_name() ?></p>
				
			</div>
			<div class="col-xs-6 fix-height">
				<p>For <b>Company Name</b></p>
			</div>
		</div>
		
	</div>
	
	<?php require "application/views/widgets/printing/footer.php"; ?>
	<?php require "application/views/widgets/bottom_include.php"; ?>
	<script>
		var content = $(".content:last");
		var res = content.width()/210;
		var table_top = content.find(".xcrud-container").position().top;
		var limit = res*280-table_top;
		$(document).ready(function(){
			var i = 0;
			while(($(".content:last").find('tr:last').position().top) > limit){
				split_table();
			}
//			console.log(content.find('tr:last').position().top);
//			split_table();
//			console.log($(".content:last").find('tr:last').position().top);
			
			
		});
		
		function split_table(){
			content = $(".content:last");
			var extra_rows = content.find("tr").filter(function(){
				return $(this).position().top > (limit);
			});
			//console.log(extra_rows);
			if(extra_rows.size() > 0){
				content.after($(content).clone())
				content.find(".finalize").remove();
				$(".content:last .xcrud-list tbody").html("");				
				$(".content:last .xcrud-list tfoot").html("");				
				$(".content:last .xcrud-list tbody").html(extra_rows.clone());				
			}
			extra_rows.remove();
		}
		
		function printReport(){
			if(typeof Android == "object"){
				
			}else if(terminal == true){
				const {ipcRenderer} = require('electron');
				var request = {task:"print-report"};
				ipcRenderer.send('asynchronous-message', request);
			} else {
				window.print();
				window.close();
			}
		}
	</script>
</body>	
		
</html>