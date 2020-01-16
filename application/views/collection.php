<?php 
	require "widgets/starting.php"; 
	
	if(!has_permission("Collect Order")){
		access_deny();
		exit();
	}
	//require PRODUCT_PATH."/core/classes/customer.php"; 
	//$this->load->library('customer');
	require "widgets/dialogs.php";
	$items = get_items();
	$services = get_services();
	//$customer = new customer();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<link href="<?php echo base_url("assets/css/dashboard.min.css")?>" rel="stylesheet">
	<?php echo Xcrud::load_css(); ?>
</head>

<body class="nav-sm">
    <div class="container body">
		<div class="main_container">

			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				<div class="pos">
					<div class="items-column">
						<div class="service-panel">
							<div class="go-right"><i class="fa fa-chevron-right"></i></div>
							<div class="service-container" style="left: 0;">
								<?php foreach($services as $service): ?>
									<div class="service" data-id="<?php echo $service['service_id']; ?>" data-name="<?php echo $service['service_name']; ?>">
										<?php if($service["image"] != ""): ?>
										<img class="service-image" src="<?php echo base_url("assets/photos/services/".$service["image"]) ?>">
										<h4 class="service-title text-center"><?php echo $service['service_name']; ?></h4>
										<?php else:?>
										<h4 class="service-title text-center title-only"><?php echo $service['service_name']; ?></h4>
										<?php endif;?>

									</div>
								<?php endforeach; ?>
								<div class="clearfix"></div>
							</div>
							<div class="go-left"><i class="fa fa-chevron-left"></i></div>
						</div>
						<div class="item-panel">
								<?php foreach($items as $item): 
									$item_services = get_item_services($item['item_id']);
									$class = "";
									$attr = '';
									foreach($item_services as $row){
										$class .= " service".$row['service_id'];
										$attr .= ' data-service'.$row['service_id'].'="'.$row['price'].'"';
									}
									//print_r($item_services);
								?>
									<div class="">
										<div class="item <?php echo $class ?>" data-id="<?php echo $item['item_id']; ?>" data-unit="<?php echo $item['unit_label']; ?>" data-name="<?php echo $item['item_name']; ?>" data-dialog="<?php echo $item['html_id']; ?>" data-showDialog="<?php echo $item['show_dialog_on_select']; ?>" <?php echo $attr; ?>>
											<?php if($item["image"] != ""): ?>
											<img class="item-image" src="<?php echo base_url("assets/photos/items/".$item["image"]) ?>">
											<h4 class="item-title text-center"><?php echo $item['item_name']; ?></h4>
											<?php else:?>
											<h4 class="item-title text-center title-only"><?php echo $item['item_name']; ?></h4>
											<?php endif;?>
										</div>
									</div>
								<?php endforeach; ?>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="order-column">
						<div class="order-panel">
							<div class="order-details">

							</div>
							<div class="customer-info">
								No Customer
							</div>
							<div class="order-total">
								<div class="col-xs-6">Total</div>
								<div class="col-xs-6 total text-right">BD 0.000</div>
							</div>
						</div>
						<div class="keys-panel">
							<?php //include 'widgets/keypad.php'; ?>
							<div class="keys-block x3-key">
							<div class="key x1-key y1_5-key" data-key="" data-fun="qty">Qty</div>
							<div class="key x1-key y1_5-key" data-key="" data-fun="plus">+</div>
							<div class="key x1-key y1_5-key" data-key="" data-fun="minus">-</div>
							<div class="key x1_5-key y1_5-key" data-key="" data-fun="disc">%</div>
							<div class="key x1_5-key y1_5-key" data-key="" data-fun="del">Del</div>
							</div>
							<div class="other-keys">
								<div class="key x2-key y1-key" data-key="" data-fun="checkout">Checkout</div>
								<div class="key x2-key y1-key" data-key="" data-fun="customer">Customer</div>
								<div class="key x2-key y1-key" data-key="" data-fun="reset">Reset</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="open-panel"><i class="fa fa-bars"></i></div>
					</div>
				</div>
			</div>
			
		</div>
		<?php echo dialogs::discount_dialog(); ?>
		<?php echo dialogs::quantity_dialog(); ?>
		<?php echo dialogs::customer_dialog(); ?>
		<?php echo dialogs::checkout_dialog(); ?>
		<?php echo dialogs::payment_dialog(); ?>
		<?php echo dialogs::area_rectangle_dialog(); ?>
		
		<div id="warning-dialog" style="display: none; max-width: 700px;">
			
		</div>
		<div class="overlay"></div>
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<script src="<?php echo base_url("assets/js/dashboard04.min.js")?>"></script>
	<?php echo Xcrud::load_js(); ?>
</body>	
		
</html>