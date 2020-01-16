<?php 
	if(!isset($widgets)){
		header("Location:login");
		exit();
	}
?>

<!-- Navigation -->
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
	  <div class="navbar nav_title" style="border: 0;">
		  <a href="" class="site_title"><img src="<?php echo base_url("assets/photos/favicon.png") ?>" class="small-logo"><img src="<?php echo base_url("assets/photos/logo_s.png")?>" class="logo"></a>
	  </div>

	  <div class="clearfix"></div>

	  <!-- menu profile quick info -->
	  <div class="profile">
		<div class="profile_pic">
		  <img src="get_image?task=user_image" alt="..." class="img-circle profile_img">
		</div>
		<div class="profile_info">
		  <span>Welcome,</span>
		  <h2><?php echo ucwords(user_name()); ?></h2>
		</div>
		  <div class="clearfix"></div>
	  </div>
	  <!-- /menu profile quick info -->
	  <!-- sidebar menu -->
	  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<div class="menu_section">

			<ul class="nav side-menu">
				<?php if(has_permission('Collect Order')): ?>
				<li><a href="collection"><i class="fa fa-sign-in"></i> Collection</a></li>
				<?php endif; ?>
				<?php if(has_permission('Submit Order')): ?>
				<li><a href="submission"><i class="fa fa-sign-out"></i> Submission</a></li>
				<?php endif; ?>
				<?php if(has_permission('View Customers')): ?>
				<li><a href="customers"><i class="fa fa-address-book-o"></i> Customers</a></li>
				<?php endif; ?>
				<?php if(has_permission('View Orders')): ?>
				<li><a href="orders"><i class="fa fa-shopping-cart"></i> Orders</a></li>
				<?php endif; ?>
				
				<?php if(has_permission('Manage Services')): ?>
				<li><a><i class="fa fa-sitemap"></i> Services <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="services"> Services</a></li>
						<li><a href="items"> Items</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(has_permission('See Reports')): ?>
				<li><a><i class="fa fa-file-text-o"></i> Reports <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="order_report"> Order Report</a></li>
						<li><a href="payment_report"> Payment Report</a></li>
						<li><a href="service_report"> Service Report</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(has_permission('Change Settings')): ?>
				<li><a><i class="fa fa-gear"></i> Setting <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(has_permission('Manage Users')): ?>
							<li><a href="users"> Users</a></li>
						<?php endif; ?>
						<?php if(has_permission('Manage Permissions')): ?>
							<li><a href="permissions"> Permissions</a></li>
						<?php endif; ?>
						<li><a href="companyinfo"> Company Information</a></li>
						<!--<li><a href="backup"> Back Up</a></li>-->
						<li class="shown-in-terminal" style="display: none"><a href="printers.php"> Printers</a></li>
						<?php if(has_permission('General Settings')): ?>
							<li><a href="general_settings"> General Settings</a></li>
						<?php endif; ?>
						<!--<li><a href="backup"> Back Up</a></li>-->
					</ul>
				</li>
				<?php endif; ?>	
				
			</ul>
		</div>


	  </div>
	  <!-- /sidebar menu -->

	  <!-- /menu footer buttons -->

	  <!-- /menu footer buttons -->
	</div>
</div>

  <!-- top navigation -->
  <div class="top_nav">
	<div class="nav_menu">
	  <nav class="" role="navigation">
		<div class="nav toggle">
		  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>

		<ul class="nav navbar-nav navbar-right">
		  <li class="">
			<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<img src="get_image?task=user_image" alt=""><?php echo ucwords(user_name()); ?>
			  <span class=" fa fa-angle-down"></span>
			</a>
			<ul class="dropdown-menu dropdown-usermenu pull-right">
			  <li><a href="profile"> Profile</a></li>
			  
			  <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
			</ul>
		  </li>

		</ul>
	  </nav>
	</div>
  </div>