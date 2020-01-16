<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class filter_widgets {
	
	public static function prepare_inputs(){
		global $serial_st,$serial_end,$customer_id,$start_d,$end_d,$service_id,$item_id,$query;
		if(isset($serial_st)){
			if(isset($_GET["serial_st"])){
				$serial_st = filter_input(INPUT_GET,'serial_st');
			}
			$query["serial_st"] = $serial_st;
		}
		if(isset($serial_end)){
			if(isset($_GET["serial_end"])){
				$serial_end = filter_input(INPUT_GET,'serial_end');
			}
			$query["serial_end"] = $serial_end;
		}
		if(isset($start_d)){
			if(isset($_GET["start_d"]) && $_GET["start_d"] != ""){
				$start_d = strtotime(filter_input(INPUT_GET,'start_d'));
			}
			$query["start_d"] = $start_d;
		}
		if(isset($end_d)){
			if(isset($_GET["end_d"]) && $_GET["end_d"] != ""){
				$end_d = strtotime(filter_input(INPUT_GET,'end_d'));
			}
			$query["end_d"] = $end_d;
		}
		if(isset($customer_id)){
			if(isset($_GET["customer"])){
				$customer_id = filter_input(INPUT_GET,'customer');
			}
			$query["customer"] = $customer_id;
		}
		if(isset($service_id)){
			if(isset($_GET["service"])){
				$service_id = filter_input(INPUT_GET,'service');
			}
			$query["service"] = $service_id;
		}
		if(isset($item_id)){
			if(isset($_GET["item"])){
				$item_id = filter_input(INPUT_GET,'item');
			}
			$query["item"] = $item_id;
		}

	} 
	
	public static function serial_start($serial_st="",$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Serial (from)</label>
				<input type="text" class="form-control filter-input" name="serial_st" placeholder="From Serial No." value="<?php echo $serial_st; ?>">
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function serial_end($serial_end="",$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Serial (to)</label>
				<input type="text" class="form-control filter-input" name="serial_end" placeholder="To Serial No." value="<?php echo $serial_end; ?>">
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function customer($customer_id=0,$class="col-sm-6"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Customer</label>
				<select class="form-control searchable filter-input" name="customer">
					<option value="0" <?php echo ($customer_id == 0)?"selected":"" ?>>All</option>
					<?php foreach(get_customers() as $customer):?>
					<option value="<?php echo $customer['customer_id']; ?>" <?php echo ($customer_id == $customer['customer_id'])?"selected":"" ?>><?php echo $customer['name']." - ".$customer['mobile_num'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	
	public static function start_date($start_d=0,$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Start Date</label>
				<input type="text" class="form-control date-input filter-input" name="start_d" placeholder="start date" value="<?php echo ($start_d == 0)?"":date('d.m.Y',$start_d); ?>">
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function end_date($end_d=0,$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">End Date</label>
				<input type="text" class="form-control date-input filter-input" name="end_d" placeholder="end date" value="<?php echo ($end_d == 0)?"":date('d.m.Y',$end_d); ?>">
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function service($service_id=0,$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Service</label>
				<select class="form-control searchable filter-input" name="service">
					<option value="0" <?php echo ($service_id == 0)?"selected":"" ?>>All</option>
					<?php foreach(get_services() as $service):?>
					<option value="<?php echo $service['service_id']; ?>" <?php echo ($service_id == $service['service_id'])?"selected":"" ?>><?php echo $service['service_name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public static function item($item_id=0,$class="col-sm-3"){
		ob_start();
		?>
		<div class="<?php echo $class; ?>">
			<div class="form-group">
				<label class="control-label">Item</label>
				<select class="form-control searchable filter-input" name="item">
					<option value="0" <?php echo ($item_id == 0)?"selected":"" ?>>All</option>
					<?php foreach(get_items() as $item):?>
					<option value="<?php echo $item['item_id']; ?>" <?php echo ($item_id == $item['item_id'])?"selected":"" ?>><?php echo $item['item_name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}

