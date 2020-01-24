<?php require "widgets/starting.php"; 
	if(!has_permission('See Reports')){
		header("Location:../index.php");
		exit();
	}
	
	$this->load->library("report");
	//require_once PRODUCT_PATH.'/core/classes/report.php';
	require_once 'widgets/filter_widgets.php';
	
	global $serial_st,$serial_end,$start_d,$end_d,$customer_id, $address;
	$serial_st = '';
	$serial_end = '';
	$start_d = 0;
	$end_d = 0;
	$customer_id = 0;
	$address = 0;
	$query = array("report"=>"order");
	
	filter_widgets::prepare_inputs();
	
	$report = new report();
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<?php echo Xcrud::load_css(); ?>
</head>

<body class="nav-md">
    <div class="container body">
		<div class="main_container">
			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				<div class="row">
					<div class="panel panel-default">
						<form class="form panel-body filter-form">
							<div class="row">
								<?php echo filter_widgets::serial_start($serial_st); ?>
								<?php echo filter_widgets::serial_end($serial_end); ?>
								<?php echo filter_widgets::customer($customer_id); ?>
								<?php echo filter_widgets::start_date($start_d); ?>
								<?php echo filter_widgets::end_date($end_d); ?>
								
								<div class="col-sm-12">
									<input type="submit" class="btn btn-default submit-report pull-right" style="margin-bottom: 0" value="Run Report">
									<a href="order_report" class="btn btn-default submit-report pull-right" style="margin-bottom: 0">Reset</a>
								</div>
								<div class="clearfix"></div>
							</div>
							
						</form>
					</div>
				</div>
				<div class="row rel"><a href="printing/print_report?<?php echo http_build_query($query); ?>" class="btn btn-primary top-button new-window full-screen"><i class="fa fa-print"></i> Print</a></div>
				<div class="row">
					<?php echo $report->order_report($serial_st, $serial_end, $start_d, $end_d, $customer_id, $address)->render(); ?>
				</div>
				
			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<?php echo Xcrud::load_js(); ?>
	<script>
		$(document).ready(function(){
			$(".date-input").datepicker({
				autoSize:true,
				dateFormat: "dd.mm.yy"
			});
			
			$("[name='start_d']").on("change",function(){
				$("[name='end_d']").datepicker('option','minDate',$(this).datepicker('getDate'));
			});
			$("[name='end_d']").on("change",function(){
				$("[name='start_d']").datepicker('option','maxDate',$(this).datepicker('getDate'));
			});
		});
	</script>
</body>	
		
</html>