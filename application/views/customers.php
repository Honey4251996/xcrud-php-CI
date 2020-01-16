<?php 
	require "widgets/starting.php"; 
	if(!has_permission("View Customers")){
		access_deny();
		exit();
	}
	
	$this->load->library('customer');
	
	//$this_file = basename(__FILE__);
	$table_name = 'customers';
	$single = "customer";
	$plural = 'customers';
	$table =  new customer();

	$task = "list";
	if(isset($_GET[$table_name])){
		$id = filter_input(INPUT_GET,$table_name);
		if($id == "new"){
			$task = "new";
		}else{
			$task = "edit";
		}
	}
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
				
					<?php 
					if($task == 'new'): ?>
						<div class="row rel">
							<span class="top-button">
								<a href="<?php echo "{$this_file}?{$table_name}=new" ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo ucwords("new {$single}"); ?></a>
								<a href="<?php echo "{$this_file}" ?>" class="btn btn-default"><?php echo "Back to ". ucwords($plural) ?></a>
							</span>
						</div>
						<br>
						<div class="row"><?php echo $table->add(); ?></div>
					<?php elseif($task == 'edit' && has_permission("Edit Customers")): ?>
						<div class="row rel">
							<span class="top-button">
								<a href="<?php echo "{$this_file}?{$table_name}=new" ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo ucwords("new {$single}"); ?></a>
								<a href="<?php echo "{$this_file}" ?>" class="btn btn-default"><?php echo "Back to ". ucwords($plural) ?></a>
							</span>
						</div>
						<br>
						<div class="row"><?php echo $table->edit($id); ?></div>
					<?php elseif($task == 'list'): ?>
						<div class="row rel">
							<span class="top-button">
								<a href="<?php echo "{$this_file}?{$table_name}=new" ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo ucwords("new {$single}"); ?></a>
							</span>
						</div>
						<br>
						<div class="row"><?php echo $table->listing(); ?></div>
					<?php endif; ?>

			</div>
			
		</div>
	
	</div>
	<?php require "widgets/bottom_include.php"; ?>
	<?php echo Xcrud::load_js(); ?>
	<?php if($task == "new"): ?>
	<script type="text/javascript">
//		jQuery(document).on("xcrudafterrequest",function(event,container,data,status){
//			if(data.task == 'save' && status == 'success'){
//				var url = window.location.href;
//				var str = url.indexOf('?');
//				var new_url = '<?php echo "{$this_file}?{$table_name}=" ?>'+$('.xcrud-data[name="primary"]').val();
//				var task = $('.xcrud-data[name="task"]').val();
//				if(task == 'edit'){
//					setTimeout(function(){window.location.href = new_url},1500);
//				}
//			}
//		});
		jQuery(document).on("xcrudafterrequest",function(event,container,data,status){
			if(data.task == 'save' && status == 'success'){
				var id = $('.xcrud-data[name="primary"]').val();
				window.location.href = '<?php echo "{$this_file}?{$table_name}=" ?>'+id;
			}
		});
	</script>
	<?php endif; ?>
</body>	
		
</html>