<?php

class dialogs {
	
	public static function keypad(){
		ob_start();
		include "keypad.php";
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function discount_dialog(){
		ob_start(); ?>
			<div id="disc-dialog" style="display: none;max-width: 500px;">
				<h2>Discount</h2>
				<div class="row">
					<div class="col-xs-5" >
						<?php include 'keypad.php'; ?>
					</div>
					<div class="col-xs-7 discount-panel">
						<div class="form">
							<div class="form-group">
								<div class="">
									<label>
										<input class="discount-type" name="discount_type" type="radio" value="total" checked>
										Total Discount
									</label>
								</div>
								<div class="">
								<label>
									<input class="discount-type" name="discount_type" type="radio" value="line">
									Line Discount
								</label>
								</div>
							</div>
							<div class="">
								<input class="form-control discount-input" type="text" placeholder="0.000">
							</div>
						</div>
						<div class="discount-keys">
							<div class="col-xs-6 y1-key key" data-fun="percent_disc">%</div>
							<div class="col-xs-6 y1-key key" data-fun="amount_disc">BD</div>
							<a class="col-xs-12 key close-dialog">Cancel</a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function quantity_dialog(){
		ob_start(); ?>
		<div id="qty-dialog" style="display: none;max-width: 500px;">
			<h2>Quantity</h2>
			<div class="row">
				<div class="col-xs-5" >
					<?php include 'keypad.php'; ?>
				</div>
				<div class="col-xs-7 qty-panel">
					<div class="form">
						<div class="">
							<label>Quantity</label>
							<input class="form-control qty-input" type="text" placeholder="0">
						</div>
					</div>
					<div class="qty-keys">
						<div class="col-xs-6 y1-key key" data-fun="del">Del</div>
						<div class="col-xs-6 y1-key key" data-fun="clear">CE</div>
						<a class="col-xs-6 key close-dialog">Cancel</a>
						<div class="col-xs-6 y1-key key" data-fun="change-qty">OK</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function area_rectangle_dialog(){
		ob_start(); ?>
		<div id="area-rectangle-dialog" style="display: none;max-width: 500px;">
			<h2>Rectangle Area Calculator</h2>
			<div class="row">
				<div class="col-xs-5" >
					<?php include 'keypad.php'; ?>
				</div>
				<div class="col-xs-7 qty-panel">
					<div class="form">
						<div class="">
							<label>Width</label>
							<input class="form-control width-input" type="text" placeholder="0">
						</div>
						<div class="">
							<label>Height</label>
							<input class="form-control height-input" type="text" placeholder="0">
						</div>
					</div>
					<div class="qty-keys" style="margin-top: 5px;">
						<div class="col-xs-6 y1-key key" data-fun="del">Del</div>
						<div class="col-xs-6 y1-key key" data-fun="clear">CE</div>
						<a class="col-xs-6 key close-dialog">Cancel</a>
						<div class="col-xs-6 y1-key key" data-fun="calculate-rectangle-area">OK</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function customer_dialog(){
		$CI =& get_instance();
		$CI->load->library('customer');
		$customer = new customer();
		ob_start(); ?>
		<div id="customer-dialog" style="display: none;max-width: 1000px;">
			<h2>Customer</h2>
			<div class="row customer-form">
				<div>
					<?php echo $customer->create_dialog(); ?>
				</div>
				<div class="pull-left">
					<div class='btn btn-default save-customer' data-task='save' data-after='edit'>Save Changes</div>
				</div>
				<div class='pull-right'>
					<div class='btn btn-default close-dialog'>Cancel</div>
					<div class='btn btn-default select-customer'>OK</div>
				</div>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function checkout_dialog(){
		ob_start(); ?>
		<div id="checkout-dialog" style="display: none; max-width: 800px;">
			<h2>Checkout</h2>
			<div class="details-panel">
				
				<div class="form">
					<div class="row payment-info">
						<div class="col-sm-6">
							<div class="form-group">
								<div class="text-center"><h4>Total</h4></div>
								<div class="payment-label text-center total"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="text-center"><h4>Remaining</h4></div>
								<div class="payment-label text-center remaining"></div>
							</div>
						</div>
						<div class="col-xs-12 changes-block">
							<div class="form-group">
								<div class="text-center"><h4>Change</h4></div>
								<div class="payment-label text-center changes"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row payments">
					<h3 class="text-center">Payments</h3>
					<div class="payments-list">
						
					</div>
				</div>
				
				<div class="control-keys">
					<div class="x3-key y1-key key pull-left" data-fun="goToPayment">Add Payment</div>
					<div class="x2-key y1-key key pull-right" data-fun="pay">Checkout</div>
					<div class="x2-key y1-key key close-dialog pull-right">Cancel</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
			
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function payment_dialog(){
		ob_start(); ?>
		<div id="payment-dialog" style="display: none; max-width: 800px;">
			<h2>Add Payment</h2>
			<div class="payment-keypad">
				<div class="x1-key y1-key key" data-fun="clear">CE</div>
				<div class="x2-key y1-key key" data-fun="enter">Enter</div>

				<?php include 'keypad.php'; ?>
				<div class="clearfix"></div>
			</div>
			
			<div class="details-panel">
				
				<div class="form">
					
					<div class="row">
						
						<div class="col-sm-12">
							<div class="form-group">
								<div class="">
									<label class="radio-label">
										<input class="payment-type" name="payment_type" type="radio" value="cash" checked>
										<i class="fa fa-money fa-fw"></i> Cash Payment
									</label>
								</div>
								<div class="">
									<label class="radio-label">
										<input class="payment-type" name="payment_type" type="radio" value="card">
										<i class="fa fa-credit-card fa-fw"></i> Card Payment
									</label>
								</div>
							</div>
							<div class="form-group">
								<label>Payment</label>
								<input class="form-control given-input" type="text" placeholder="0.000" value="">
							</div>
						</div>
						
					</div>
					
					
				</div>
				
				<div class="control-keys">
					<div class="x2-key y1-key key" data-fun="checkout">Cancel</div>
					<div class="x2-key y1-key key" data-fun="add-payment">Add</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	
	public static function soft_keypad(){
		ob_start(); ?>
			<div class="soft-keypad">
				<a class="close-keypad"><i class="fa fa-remove"></i></a>
				<div class="x1-key y1-key key" data-fun="clear">CE</div>
				<div class="x2-key y1-key key" data-fun="enter">Enter</div>
				<?php echo dialogs::keypad(); ?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
}

