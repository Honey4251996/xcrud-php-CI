<?php
	$order_data = get_order_info($order_id);
	if(empty($order_data)){
		echo "<h1>No data Available</h1>";
		exit();
	}
	$order = $order_data['order'];
	$order_lines = $order_data['order_lines'];
	$paid = $order_data['paid'];

	$remaining = $order['total']-$paid;
	$date = strtotime($order['created_at']);
	$user = get_user_data($order['created_by'], 'name');
	$customer = customer_data($order['customer']);
	$i = 1;
	$separator = "<div class='separator-line'>------------------------------------------------------------------------------------------------------------------------------</div>";
	$order_code = str_pad($order_id,8,"0",STR_PAD_LEFT);
	$receipt_name = "Order Receipt";
?>

<div id="receipt">
	<?php include "application/views/widgets/printing/receipt_header.php"; ?>
	<?php echo $separator ?>
	<div class="line"><b>Date/Time:</b>&nbsp<?php echo date("d-M-y / h:i:s A",$date); ?> </div>
	<div class="line"><b>Created By:</b>&nbsp<?php echo $user; ?> </div>
	<div class="line"><b>Customer:</b>&nbsp<?php echo $customer['name']." - ".$customer['mobile_num']; ?> </div>
	<?php if(isset($settings['address_on_receipt']) && $settings['address_on_receipt'] == "yes"): ?>
		<div class="line"><small><?php echo $customer['address']?></small></div>
	<?php endif; ?>
	<?php echo $separator ?>
	<div class="line">Order Details:<span class="pull-right">Ord No. <?php echo $order_code ?></span></div>
<?php foreach ($order_lines as $line): ?>
	<?php echo $separator ?>
	<div class="line">
		<div class="col-item">
			<?php echo $i." - ".$line['system_note'].' '.item_name($line['item_id'])." (".service_name($line['service_id']).")" ?>
		</div>
		<div class="col-qty text-right"><?php echo $line['quantity']." ".item_unit($line['item_id']); ?></div>
		<div class="col-price text-right"><?php echo "BD ".$line['price'] ?></div>
		<div class="clearfix"></div>
	</div>
	<div class="line">
		<?php if($line['discount'] > 0): ?>
		<div class="pull-left"><?php echo "Disc: ".number_format($line['discount'],2)."%" ?></div>
		<?php endif; ?>
		<div class="pull-right"><b><?php echo "SubTotal: BD ".number_format(calculate_price($line),3) ?></b></div>
		<div class="clearfix"></div>
	</div>

<?php $i = $i + 1; endforeach; ?>
<?php echo $separator ?>

<div class="line">
	<div class="pull-right"><b><?php echo "Total: BD ".number_format($order['total'],3) ?></b></div>
	<div class="clearfix"></div>
</div>
<div class="line">
	<div class="pull-right"><?php echo "Paid: BD ".number_format($paid,3) ?></div>
	<div class="clearfix"></div>
</div>
<div class="line">
	<div class="pull-right"><?php echo "Remaining: BD ".number_format($remaining,3) ?></div>
	<div class="clearfix"></div>
</div>
<br>
<img class="barcode" src="<?php echo base_url("assets/plugins/barcode/barcode.php?size=50&text=".$order_code)?>"/>
<br>
<?php include "application/views/widgets/printing/receipt_footer.php"; ?>
<div class="text-center"><?php echo date("d-M-y / h:i:s A"); ?> </div>



</div>
	