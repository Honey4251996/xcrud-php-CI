<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "root.php";
/**
 * Description of report
 *
 * @author Ahmed Saif
 */
class report {
	
	protected function customer_filter(&$table,$customer=0,$field="customer"){
		if($customer != 0){
			$table->where($field,$customer);
		}
	}
	
	protected function service_filter(&$table,$service=0,$field="service_id"){
		if($service != 0){
			$table->where($field,$service);
		}
	}
	
	protected function item_filter(&$table,$item=0,$field="item_id"){
		if($item != 0){
			$table->where($field,$item);
		}
	}
	
	protected function status_filter(&$table,$status=1,$field="status"){
		if(is_array($status)){
			
		}if($status != 0){
			$table->where($field,$status);
		}
	}
	
	protected function serial_filter(&$table,$serial_st = 0,$serial_end = 0,$field="order_id"){
		if($serial_st != 0 && $serial_end != 0){
			$table->where($field." >=",$serial_st);
			$table->where($field." <=",$serial_end);
		}elseif($serial_st !=0 && $serial_end == 0){
			$table->where($field." =",$serial_st);
		}elseif($serial_st ==0 && $serial_end != 0){
			$table->where($field." <=",$serial_end);
		}
	}
	
	protected function date_filter(&$table,$start_d = 0,$end_d = 0,$field="created_at"){
		if($start_d != 0 && $end_d != 0){
			$table->where("DATE(".$field.") >= '".date("Y-m-d",$start_d)."'");
			$table->where("DATE(".$field.") <= '".date("Y-m-d",$end_d)."'");
		}elseif($start_d !=0 && $end_d == 0){
			$table->where("DATE(".$field.") = '".date("Y-m-d",$start_d)."'");
		}elseif($start_d ==0 && $end_d != 0){
			$table->where("DATE(".$field.") <= '".date("Y-m-d",$end_d)."'");
		}
	}


	public function order_report($serial_st=0,$serial_end=0,$start_d=0,$end_d=0,$customer=0,$status=0){
		Xcrud_config::$manual_load = true;
		$table = xcrud::get_instance();
		$table->table("orders");
		//$table->query("Select * From `orders`");
		$this->status_filter($table, $status);
		$this->customer_filter($table, $customer);
		$this->serial_filter($table, $serial_st, $serial_end);
		$this->date_filter($table, $start_d, $end_d);
		
		$table->table_name("Orders Report");
		$table->unset_add();
		$table->unset_view();
		$table->unset_edit();
		$table->unset_remove();
		$table->unset_search();
		$table->unset_limitlist();
		$table->unset_print();
		$table->subselect("Order No","CONCAT_WS('',LPAD({order_id},8,'0'))");
		$table->relation("customer","customers","customer_id",array("name","mobile_num"),"","",""," - ");
		$table->relation("status","order_status","status_id","title");
		$table->relation("created_by","users","id","name");
		$table->subselect("Amount","SELECT SUM(`price`) FROM `quotation_items` WHERE `quotation_id` = {quotation_id}");
		//$table->subselect("#Items","SELECT SUM(`quantity`) FROM `order_lines` WHERE `order_id` = {order_id}");
		$table->limit('all');
		
		root::price_type($table, "total");
		$table->sum('total');
		//$table->subselect("Car Info","CONCAT_WS('',{reg_no},' - ',if({car_type} != 0,(SELECT `title` FROM `car_type` WHERE `type_id` = {car_type}),{other_type}))");
		$table->columns("Order No,customer,status,total,created_at,created_by");
		//$table->label(array("reg_no"=>"Reg. No.","customer_id"=>"Customer","quotation_id"=>"Serial No"));
		return $table;
	}
	
	public function payment_report($start_d=0,$end_d=0,$customer=0){
		Xcrud_config::$manual_load = true;
		$table = xcrud::get_instance();
		$table->table("order_payments");
		//$table->join("action_id","order_actions","action_id");
		$table->join("order_id","orders","order_id");
		//$table->query("Select * From `orders`");
		//$this->status_filter($table, $status);
		$this->customer_filter($table, $customer,"orders.customer");
		//$this->serial_filter($table, $serial_st, $serial_end);
		$this->date_filter($table, $start_d, $end_d,"order_payments.created_at");
		
		$table->table_name("Payment Report");
		$table->unset_add();
		$table->unset_view();
		$table->unset_edit();
		$table->unset_remove();
		$table->unset_search();
		$table->unset_limitlist();
		$table->unset_print();
		$table->subselect("Order No","CONCAT_WS('',LPAD({orders.order_id},8,'0'))");
		$table->relation("orders.customer","customers","customer_id",array("name","mobile_num"),"","",""," - ");
		$table->relation("created_by","users","id","name");
		$table->column_callback("order_payments.payment_type","upper_case_first",__FILE__);
		//$table->relation("order_actions.action_type_id","order_action_types","action_type_id","action_title");
		//$table->relation("order_actions.created_by","users","id","name");
		//$table->subselect("Amount","SELECT SUM(`price`) FROM `quotation_items` WHERE `quotation_id` = {quotation_id}");
		//$table->subselect("#Items","SELECT SUM(`quantity`) FROM `order_lines` WHERE `order_id` = {order_id}");
		$table->limit('all');
		
		root::price_type($table, "order_payments.paid");
		$table->sum('order_payments.paid');
		//$table->subselect("Car Info","CONCAT_WS('',{reg_no},' - ',if({car_type} != 0,(SELECT `title` FROM `car_type` WHERE `type_id` = {car_type}),{other_type}))");
		$table->columns("Order No,orders.customer,order_payments.paid,order_payments.payment_type,order_payments.created_at,order_payments.created_by");
		$table->label(array("order_payments.payment_type"=>"Type"));
		return $table;
	}
	
	public function service_report($start_d=0,$end_d=0,$customer=0,$service=0,$item=0){
		Xcrud_config::$manual_load = true;
		$table = xcrud::get_instance();
		$table->table("order_lines");

		$table->join("order_id","orders","order_id");
		$table->join("order_lines.item_id","items","item_id");
		$table->join("items.unit_id","units","unit_id");
		$this->service_filter($table, $service);
		$this->item_filter($table, $item);
		$this->customer_filter($table, $customer,"orders.customer");
		$this->date_filter($table, $start_d, $end_d,"orders.created_at");
		
		$table->table_name("Service Report");
		$table->unset_add();
		$table->unset_view();
		$table->unset_edit();
		$table->unset_remove();
		$table->unset_search();
		$table->unset_limitlist();
		$table->unset_print();
		$table->subselect("Order No","CONCAT_WS('',LPAD({orders.order_id},8,'0'))");
		$table->subselect("Quantity","CONCAT_WS(' ',{order_lines.quantity},{units.unit_label})");
		$table->relation("orders.customer","customers","customer_id",array("name","mobile_num"),"","",""," - ");
		$table->relation("order_lines.service_id","services","service_id","service_name");
		//$table->relation("order_lines.item_id","items","item_id","item_name");
		$table->relation("orders.created_by","users","id","name");
		//$table->subselect("Amount","SELECT SUM(`price`) FROM `quotation_items` WHERE `quotation_id` = {quotation_id}");
		//$table->subselect("#Items","SELECT SUM(`quantity`) FROM `order_lines` WHERE `order_id` = {order_id}");
		$table->limit('all');
		$table->label(array('service_id'=>"Service",'item_id'=>'Item'));
		root::price_type($table, "order_lines.total");
		$table->sum('order_lines.total');
		//$table->subselect("Car Info","CONCAT_WS('',{reg_no},' - ',if({car_type} != 0,(SELECT `title` FROM `car_type` WHERE `type_id` = {car_type}),{other_type}))");
		$table->columns("Order No,orders.customer,order_lines.service_id,items.item_name,Quantity,order_lines.total,orders.created_at,orders.created_by");
		$table->column_callback("items.item_name","system_note",__FILE__);
		$table->label(array("items.item_name"=>"Item"));
		return $table;
	}

}


function upper_case_first($value, $fieldname, $primary_key, $row, $xcrud)
{
   return ucfirst($value);
}

function system_note($value, $fieldname, $primary_key, $row, $xcrud){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare("SELECT `system_note` FROM `order_lines` WHERE `line_id` = ?");
	$query->execute(array($primary_key));
	$note = $query->fetchColumn();
	if($note != ""){
		return $value." (".$note.")";
	}else{
		return $value;
	}
}