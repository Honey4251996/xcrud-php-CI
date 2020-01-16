<?php

if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
}
require_once "root.php";

/**
 * Description of party
 *
 * @author Ahmed Saif
 */
class order extends root {
	
	protected $table_name ="orders";
	protected $primary = "order_id";
	protected $new_title = "New Order";
	protected $edit_title = "Edit Order";
	protected $list_title = "Orders";
	protected $buttons_position = array("up","left"); // both,up,down // left,right
	protected $selectable = false;
	protected $fields = "Order No,customer,status,total,Remaining,created_by,created_at";
	protected $columns = "Order No,customer,status,total,Remaining,created_by,created_at";
	protected $labels = array();
	
	protected $edit = false;
	protected $view = true;
	protected $remove = false;
	
	protected $left_fields="";
	protected $right_fields = "";
	protected $required_fields = "";
	protected $price_fields = "total,Remaining";
	
	protected $this_file = __FILE__;
	protected $theme_config = array(
			'details_label_cell'=>'control-label col-sm-2 xcrud-label',
			'details_field_cell'=>'col-sm-10 xcrud-field'
		);
	
	protected function setting(&$table) {
		Xcrud_config::$manual_load=true;
		//$table->subselect("created");
		//$table->before_insert('before_insert',__FILE__);
		//$table->after_insert('after_insert',__FILE__);
		//$table->no_editor('remark');
		$table->subselect("Order No","CONCAT_WS('',LPAD({order_id},8,'0'))");
		$table->subselect("#Items","SELECT SUM(`quantity`) FROM `order_lines` WHERE `order_id` = {order_id}");
		$table->subselect("Remaining","SELECT total-if(sum(`paid`) IS NULL,0.000,sum(`paid`)) FROM `order_payments` WHERE `order_id` = {order_id}");
		$table->relation("customer","customers","customer_id",array("name","mobile_num"),"","",""," - Mob:");
		//$table->relation("status","order_status","status_id","title");
		global $order_status;
		$table->change_type("status","select","",$order_status);
		$table->relation("created_by","users","id","name");
	}
	
	public function listing($id = 0, $render = true) {
		$table = parent::listing($id, false);
		
		if(has_permission("Cancel Orders")){
			$table->create_action('cancel','cancel_order',$this->this_file);
			$table->button("#","Cancel","fa fa-remove","btn-danger xcrud-action",array(
			'data-task' => 'action',
			'data-action' => 'cancel',
			'data-primary' => '{order_id}'),array('status',"=",1));
		}
		
		$table->button("printing/print_order?order={order_id}","Print","fa fa-print","btn-primary",array('target'=>'_blank'));
		$table->button("#","View Receipt","fa fa-file-text-o","btn-default show-receipt",array('data-id'=>"{order_id}",'data-type'=>'order'));
		return $table->render();
	}
	
	public function view($id = 0, $render = true) {
		return parent::view($id, $render).$this->lines($id).$this->actions($id);
	}
	
	protected function lines($order = 0){
		Xcrud_config::$manual_load=true;
		$table = Xcrud::get_instance();
		$table->table("order_lines");
		$table->where("order_id",$order);
		$table->unset_add();
		$table->unset_edit();
		$table->unset_view();
		$table->unset_remove();
		$table->unset_csv();
		$table->unset_print();
		$table->unset_search();
		$table->unset_pagination();
		$table->unset_title();
		$table->subselect('Unit',"SELECT `unit_label` FROM `items` JOIN `units` ON `items`.`unit_id` = `units`.`unit_id` WHERE `item_id` = {item_id}");
		$table->columns("service_id,item_id,price,quantity,Unit,discount,total");
		$table->label(array("service_id"=>"Service","item_id"=>"Item"));
		$table->relation("service_id","services","service_id","service_name");
		$table->relation("item_id","items","item_id","item_name");
		$table->column_callback('discount',"format_discount",$this->this_file);
		$table->column_callback('item_id',"system_note",$this->this_file);
		//$table->sum('quantity,total');
		root::price_type($table, "price,total");
		return $table->render();
	}


	protected function actions($order = 0){
		Xcrud_config::$manual_load=true;
		$table = Xcrud::get_instance();
		$table->table("ex_actions");
		$table->join('ex_action_type_id','ex_action_types','ex_action_type_id');
		$table->table_name("Collections & Submissions");
		$table->where("order_id",$order);
		$table->unset_add();
		$table->unset_edit();
		$table->unset_view();
		$table->unset_remove();
		$table->unset_csv();
		$table->unset_print();
		$table->unset_search();
		$table->unset_pagination();
		$table->button("#","Print","fa fa-print","btn-primary print-receipt",array('data-id'=>"{ex_action_id}",'data-type'=>'{ex_action_types.action_title}'));
		$table->button("#","View Receipt","fa fa-file-text-o","btn-default show-receipt",array('data-id'=>"{ex_action_id}",'data-type'=>'{ex_action_types.action_title}'));
		$table->columns("ex_action_type_id,created_by,created_at");
		$table->label(array("ex_action_type_id"=>"Operation"));
		$table->relation("ex_action_type_id","ex_action_types","ex_action_type_id","action_title");
		$table->relation("created_by","users","id","name");
		//$table->sum('quantity,total');
		root::price_type($table, "price,total");
		return $table->render();
	}
}

function cancel_order($xcrud){
	if($xcrud->get("primary") && has_permission("Cancel Orders")){
		//require PRODUCT_PATH.'/core/ini_db.php';
		ini_db();$db = $GLOBALS['db'];
		$query = $db->prepare("UPDATE `orders` SET `status` = 3 WHERE `order_id` = ?");
		$query->execute(array($xcrud->get('primary')));
	}
}

function format_discount($value, $fieldname, $primary_key, $row, $xcrud){
	return $value."%";
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



