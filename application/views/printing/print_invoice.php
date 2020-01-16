<?php require "../pages/widgets/starting.php";
	if(isset($_GET['invoice'])){
		$invoice_id = filter_input(INPUT_GET,'invoice');
	}else{
		echo '<h1>Error: No invoice selected</h1>';
		exit();
	}
	
	require PRODUCT_PATH.'/core/ini_db.php';
	
	$query = $db->prepare("SELECT * FROM `invoice` WHERE `invoice_id` = ?");
	$query->execute(array($invoice_id));
	$invoice_info = $query->fetch(PDO::FETCH_ASSOC);
	
	$query = $db->prepare("SELECT * FROM `invoice_items` WHERE `invoice_id` = ?");
	$query->execute(array($invoice_id));
	$invoice_items = $query->fetchAll(PDO::FETCH_ASSOC);
	
	if($invoice_info['customer_id'] == 0){
		$customer = "<b>".$invoice_info['other_customer']."</b>";
	}else{
		$customer_info = customer_data($invoice_info['customer_id']);
		$customer = "";
		$customer .= "<b>".$customer_info['customer_name']."</b><br>";
		$customer .= ($customer_info['mobile_num'] !="")?"Mob: ".$customer_info['mobile_num']:"" ;
		$customer .= ($customer_info['tel_num'] !="" && substr($customer,-4,4) !="<br>")?" - ":"" ;
		$customer .= ($customer_info['tel_num'] !="")?"Tel: ".$customer_info['tel_num']:"" ;
		$customer .= ($customer_info['fax_num'] !="" && substr($customer,-4,4) !="<br>" && substr($customer,-3,3) !=" - ")?" - ":"" ;
		$customer .= ($customer_info['fax_num'] !="")?"Fax: ".$customer_info['fax_num']:"" ;
	}
	
	if($invoice_info['car_type'] == 0){
		$car = $invoice_info['other_type']." - ".$invoice_info['model'];
	}else{
		$car = car_type($invoice_info['car_type'])." - ".$invoice_info['model'];
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "../pages/widgets/top_include.php"; ?>
	<style>
		body{
			width:210mm;
			max-width: 210mm;
			height:297mm;
			margin: auto;
			background: #FFFFFF;
		}
		.header {
			width:100%;
			position: relative;
			padding:0px 5px;
			line-height: 1.2;
			margin-bottom: 10px;
		}
		.logo{
			width:100%;
		}
		.info{
			position: absolute;
			right: 0px;
			top:0px;
			font-size:22px;
			padding:5px;
			width:70%;
			line-height: 1.2;
		}
		.line{
			margin: 2px;
		}
		.gray-border{
			border:thin solid #cccccc;
		}
		.main-table{
			width:100%
		}
		.main-table thead tr th{
			text-align:center;
			padding:5px;
			border:1px solid #aaaaaa;
			border-bottom:2px solid #999999;
		}
		.main-table tbody tr td{
			padding:5px;
			border:1px solid #aaaaaa;
		}
		.fix-height{
			height:60px;
		}
	</style>	
</head>

<body onload="window.print()">
	<div class="header">
		<div class="pull-left" style="width:38%;padding-top: 5px">
			<p class="line" style="font-size: 22px">Ahmed Al Herz Garage</p>
			<p class="line" style="font-size: 14px">Painting, Denting,Spare Parts <br>& Car Mechanical</p>
		</div>
		<div class="pull-left" style="width:24%">
		<img src="../photos/al-herz-logo.png" alt="logo" class="logo">
		<p class="text-center" style="font-size: 8px; margin:5px 0px;">EST 2004</p>
		</div>
		<div class="text-right pull-right" style="width:38%;padding-top: 5px">
			<p class="line" style="font-size: 27px">كــــراج أحـــمـــد الـــحرز</p>
			<p class="line" style="font-size: 15px">صباغة، سمكرة، قطع غيار<br> و ميكانيكا سيارات</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="container-fluid">
		<h2 class="text-center" style="margin:10px 0 10px 0">Invoice</h2>

		<div class="row gray-border" style="margin-top:15px;">
			<div class="col-xs-6">
				<p class="line"><?php echo $customer; ?></p>
				<p class="line">Car No:&nbsp;<?php echo $invoice_info['reg_no']; ?></p>
				<p class="line">Claim No:&nbsp;<?php echo $invoice_info['claim_no']; ?></p>
			</div>
			<div class="col-xs-6">
				<p class="line">Serial No.<b>&nbsp;<?php echo "IN".str_pad($invoice_info['invoice_id'],5,'0',STR_PAD_LEFT); ?></b></p>
				<p class="line">Invoice Date:&nbsp;<?php echo date('d.m.Y',strtotime($invoice_info['date']))?></p>
				<p class="line">Car type:&nbsp;<?php echo $car; ?></p>
			</div>
		</div>

		<div class="row" style="margin-top:10px">
			<table class="main-table">
				<thead>
					<tr>
						<th style="width:5%">No.</th>
						<th style="width:60%">Description</th>
						<th style="width:35%">Amount(BD)</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$total = 0;
						foreach($invoice_items as $row):
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo $row['price']?></td>
						</tr>
					<?php  
						$i++;
						$total += $row['price'];
						endforeach;
					?>
					<tr>
						<td colspan="2">Total Amount (BD)</td>
						<td><?php echo number_format($total,3)?></td>
					</tr>

				</tbody>
			</table>
		</div>
		<div class="row gray-border" style="margin-top:15px;">
			<div class="col-xs-6 fix-height">
				<p>Prepared by: <?php echo get_user_data($invoice_info['created_by'],'name') ?></p>
			</div>
			<div class="col-xs-6 fix-height">
				<p>For <b>Ahmed Al Herz Garage:</b></p>
			</div>
		</div>
		
		<div class="row" style="position: fixed;bottom:-10px;border-top:solid #ccc 1px;width:210mm; padding-top:10px">
			<div class="col-sm-12 text-center">
				<p>Mob: 39339299 - 39978696, Fax: 77127745, CR:5568-1 Salmabad - Kingdom of Bahrain</p>
			</div>
			
		</div>
		
	</div>
		
	<?php require "../pages/widgets/bottom_include.php"; ?>
	
</body>	
		
</html>