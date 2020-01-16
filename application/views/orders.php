<?php require "widgets/starting.php"; 
	if(!has_permission("View Orders")){
		access_deny();
		exit();
	}
	
	$this->load->library('order');
	
	//$this_file = basename(__FILE__);
	$table_name = 'orders';
	$single = "Order";
	$plural = 'Orders';
	$table =  new order();

	$task = "list";
	if(isset($_GET[$table_name]) && isset($_GET['view'])){
		$id = filter_input(INPUT_GET,$table_name);
//		if($id == "new"){
//			$task = "new";
//		}else{
			$task = "view";
//		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require "widgets/top_include.php"; ?>
	<?php echo Xcrud::load_css(); ?>
	<link href="<?php echo base_url("assets/css/receipt.min.css") ?>" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
		<div class="main_container">

			<?php require "widgets/navigation.php"; ?>
			
			<div class="right_col" role="main">
				
					<?php if($task == 'view'): ?>
						<div class="row rel">
							<span class="top-button">
								<!--<a href="<?php echo "{$this_file}?{$table_name}=new" ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo ucwords("new {$single}"); ?></a>-->
								<a href="<?php echo "{$this_file}" ?>" class="btn btn-default"><?php echo "Back to ". ucwords($plural) ?></a>
							</span>
						</div>
						<br>
						<div class="row"><?php echo $table->view($id); ?></div>
						<?php 
//							$this->load->library("bs_form");
//							$order_id = $id;
//							include "printing/order_receipt.php"; 
						?>
					<?php elseif($task == 'list'): ?>
						<div class="row"><?php echo $table->listing(); ?></div>
					<?php endif; ?>

			</div>
			
		</div>
		<div class="receipt-dialog" style="display: none;background: #eee;width:auto;"></div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<?php echo Xcrud::load_js(); ?>
	<script type="text/javascript">
		$(document).on("ready xcrudafterrequest",function(){
			$(".show-receipt").on("click",function(event){
				event.preventDefault();
				$.post('ajax_request',
				{
					task:"get_receipt",
					type:$(this).attr('data-type').toLowerCase(),
					id:$(this).attr('data-id')
				},function(data){
					//console.log(data);
					$(".receipt-dialog").html(data).modal();
				}
				);
			});
			
			$(".print-receipt").on("click",function(event){
				event.preventDefault();
				var id = $(this).attr('data-id');
				var receipt = $(this).attr('data-type').toLowerCase();
				var h = window.innerHeight;
				var w = window.innerWidth-20;
				var url = "<?php echo site_url(); ?>" + "/printing/print_"+receipt+"?action="+id;
				if(typeof Android == "object"){
					Android.openPrint(url);
				}else{
					window.open(url,"Printing","scrollbars,resizable,height="+h+",width="+w);
				}
			});
		});
	</script>
</body>	
		
</html>