<?php
	
	$action_data = get_submission_info($action_id);
			
	if(empty($action_data)){
		echo "<h1>No data Available</h1>";
		exit();
	}
	
	$action = $action_data['action'];
	$action_lines = $action_data['action_lines'];
	$payment = $action_data['payment'];
	$paid = $action_data['paid'];
	
	$remaining = $action['total']-$paid;
	$date = strtotime($action['created_time']);
	$user = get_user_data($action['user'], 'name');
	$customer = customer_data($action['customer']);
	$i = 1;
	$separator = "<div class='separator-line'>------------------------------------------------------------------------------------------------------------------------------</div>";
	$order_code = str_pad($action['order_id'],8,"0",STR_PAD_LEFT);
	$barcode = $order_code."-".$action_id;
	$receipt_name = $action['action_title']." Receipt";
?>

<div id="receipt">
	<?php include "application/views/widgets/printing/receipt_header.php"; ?>
	<?php echo $separator ?>
	<div class="line"><b>Date/Time:</b>&nbsp<?php echo date("d-M-y / h:i:s A",$date); ?></b> </div>
	<div class="line"><b>Created By:&nbsp<?php echo $user; ?></b> </div>
	<div class="line"><b>Customer:&nbsp<?php echo $customer['name']." - ".$customer['mobile_num']; ?> </b></div>
	<?php if(isset($settings['address_on_receipt']) && $settings['address_on_receipt'] == "yes"): ?>
		<div class="line"><small><?php echo $customer['address']?></small></div>
	<?php endif; ?>
	<div class="line"><b>Ord No.&nbsp<?php echo $order_code ?></b> </div>
	<?php echo $separator ?>
	<div class="line text-center"><b>Submitted items</b> </div>
	<?php echo $separator ?>
<?php foreach ($action_lines as $line): ?>

	<div class="line" style="font-size:14px;">
		<div class="col-item">
			<b><?php echo $i." - ".$line['system_note'].' '.item_name($line['item_id'])." (".service_name($line['service_id']).")" ?></b>
		</div>
		<div class="col-qty text-right"><b><?php echo abs($line['action_quantity'])." ".item_unit($line['item_id']); ?></b></div>
		<div class="clearfix"></div>
	</div>
	<?php echo $separator ?>
<?php $i = $i + 1; endforeach; ?>


<div class="line">
	<div class="pull-right"><b><?php echo "Total: BD ".number_format($action['total'],3) ?></b></div>
	<div class="clearfix"></div>
</div>
<div class="line">
	<div class="pull-right"><b><?php echo "Remaining: BD ".number_format($remaining,3) ?></b></div>
	<div class="clearfix"></div>
</div>
<br>	
<?php 
	if(!empty($payment)):
?>
	<div class="line text-center">Payments</div>
	<?php echo $separator ?>
<?php
		foreach($payment as $payment_line):
			$label = ($payment_line['payment_type'] == "cash")?"Given: BD ":"BD ";
?>
			<div class="line">
				<div class="pull-left"><b><?php echo ucwords($payment_line['payment_type']).":" ?></b></div>
				<div class="pull-right"><b><?php echo $label.number_format($payment_line['given'],3) ?></b></div>
				<div class="clearfix"></div>
			</div>
			<?php if($payment_line['given'] > $payment_line['paid']): ?>
				<div class="line">
					<div class="pull-right"><b><?php echo "Changes: BD ".number_format($payment_line['given']-$payment_line['paid'],3) ?></b></div>
					<div class="clearfix"></div>
				</div>
			<?php endif; ?>
			<?php echo $separator ?>
<?php 
		endforeach;
	endif; 
?>
<br>
<img class="barcode" src="<?php echo base_url("assets/plugins/barcode/barcode.php?size=50&text=".$barcode)?>"/>
<br>
<?php include "application/views/widgets/printing/receipt_footer.php"; ?>
<div class="text-center"><b><?php echo date("d-M-y / h:i:s A"); ?></b> </div>



</div>
