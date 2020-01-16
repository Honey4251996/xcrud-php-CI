<?php 
	require "widgets/starting.php"; 
	
	if(!has_permission("Submit Order")){
		access_deny();
		exit();
	}
	require "widgets/dialogs.php";
	ini_db();$db = $GLOBALS['db'];
	$sql = "SELECT * FROM `orders` INNER JOIN `customers` ON `orders`.`customer` = `customers`.`customer_id` WHERE `orders`.`status` IN (1)";
	$orders = array();
	$parameters = array();
	$customers = get_customers();
	$barcode = (isset($_GET['barcode'])?filter_input(INPUT_GET, "barcode"):"" );
	$customer = (isset($_GET['customer'])?filter_input(INPUT_GET, "customer"):0 );
	$date = (isset($_GET['date'])?  filter_input(INPUT_GET, "date"):"" );
	if($barcode != ""){
		$sql .= " AND `orders`.`order_id` = ?";
		$parameters[] = $barcode;
		
	}else{
		if($date != ""){
			$sql .= " AND DATE(`orders`.`created_at`) = ?";
			$parameters[] = date("Y-m-d",strtotime($date));
		}
		
		if($customer != 0){
			$sql .= " AND `orders`.`customer` = ?";
			$parameters[] = $customer;
		}	
	}
	$sql .= "ORDER BY `orders`.`order_id`";
	$query1 = $db->prepare($sql);
	$query1->execute($parameters);
	$orders = $query1->fetchAll(PDO::FETCH_ASSOC);
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<link href="<?php echo base_url("assets/css/submission.min.css")?>" rel="stylesheet">
	<?php //echo Xcrud::load_css(); ?>
</head>

<body class="nav-sm">
    <div class="container body">
		<div class="main_container">

			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				<div class="pos">
					<div class="row tabs-row">
						<div class="col-xs-12">
							<ul class="nav nav-pills">
								<li class="active"><a class="open-tab" data-tab="col-1">Orders list</a></li>
								<li><a class="open-tab" data-tab="col-2">Order Details</a></li>
								<li><a class="open-tab" data-tab="col-3">Check out</a></li>
							</ul>
						</div>
					</div>
					<div class="row info-panel">
						<div class="col-sm-4 info-col col-1 active">
							<div class="row">
								<div class="col-xs-8">
								<form class="form-horizontal" action="submission" method="get">
									<div class="form-group">
										<input name='barcode' class="form-control" type="text" placeholder="barcode / order no." autofocus="" value=''>
									</div>
								</form>
								</div>
								<div class="col-xs-4">
									<div class="btn btn-default pull-right open-filter"> <i class="fa fa-filter"></i>  Find Order  </div>
								</div>
							</div>
							<div class="panel panel-default orders-list">
								<div class="row">
								<?php foreach($orders as $row): ?>
									<div class="col-xs-12">
										<div class="orders-list-item">
											<input class="order-id" type="hidden" value="<?php echo $row['order_id'] ?>">
											<?php echo str_pad($row['order_id'],8,"0",STR_PAD_LEFT)." - ".$row['name']." - ".date("d-M-y / h:i:s A",strtotime($row['created_at'])); ?>
										</div>
									</div>
								<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 info-col col-2">
							<div class="panel panel-default order-panel">
								
							</div>
						</div>
						<div class="col-sm-4 info-col col-3">
							<div class="panel panel-default payment-panel">
								<div class="col-sm-12 payment-info">
									<div class="text-center customer"></div>
								</div>
								<div class="col-sm-6 payment-info">
									<div class="text-center">Total</div>
									<div class="payment-label text-center total"></div>
								</div>
								<div class="col-sm-6 payment-info">
									<div class="text-center">Paid</div>
									<div class="payment-label text-center payment"></div>
								</div>
								<div class="col-sm-12 payment-info">
									<div class="text-center">Remaining</div>
									<div class="payment-label text-center remaining"></div>
								</div>
								
								<div class="col-sm-12 payment-info changes-block">
									<div class="text-center">Changes</div>
									<div class="payment-label text-center changes"></div>
								</div>
								
								<div class="col-sm-12 payments">
									<h4 class="text-center">Payments</h4>
									<div class="payments-list">

									</div>
								</div>
								
								<div class="keys-panel">
									<?php //include "widgets/keypad.php"; ?>
									<div id="go" class="key x3-key y1-key pull-left" data-fun="goToPayment">Add Payment</div>
									<div id="pay" class="key x2-key y1-key pull-right">Checkout</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="filter-dialog" style="display: none;max-width: 1000px">
					<h1>Filter</h1>
					<div class="panel panel-default">
							<div class="panel-body">
								<form id="order-filter" class="form" action="submission" method="get">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Barcode / Order No.</label>
												<input name='barcode' class="form-control" type="text" placeholder="barcode / order no." autofocus="" value='<?php //echo $barcode; ?>'>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Customer</label>
												<select class="form-control searchable" name='customer'>
													<option value="0">All Customers</option>
													<?php foreach($customers as $row): 
														$selected = ($customer == $row['customer_id'])?"selected":"";
													?>
													<option value="<?php echo $row['customer_id'] ?>" <?php echo $selected ?>><?php echo $row['name']." - mob: ".$row['mobile_num'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Date of order</label>
												<input name='date' class="form-control datepicker" type="text" placeholder="date" value='<?php echo $date; ?>'>
											</div>
										</div>
									</div>
									<input  class='btn btn-default pull-right' type="submit" value="Search">
									<a href="submission" class="btn btn-default pull-right">Reset</a>
								</form>
							</div>
						</div>
				</div>
				
				<?php echo dialogs::payment_dialog(); ?>
				<?php echo dialogs::soft_keypad(); ?>
				
			</div>
			
		</div>
		<div class="overlay"></div>
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<script src="<?php echo base_url("assets/js/submission01.min.js")?>"></script>
	<?php //echo Xcrud::load_js(); ?>
</body>	
		
</html>