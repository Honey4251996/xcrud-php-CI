<?php
defined('BASEPATH') OR exit('No direct script access allowed');

global $order_status;
$order_status = array(1=>"Pending",2=>"Submitted",3=>"Cancelled");

function secure_session_start() {
	$CI =& get_instance();
    $CI->load->library('session');
}

function is_login(){
	if(session_status() !== PHP_SESSION_ACTIVE){
		secure_session_start();
	}
	if(isset($_SESSION[PRODUCT_ID])){
		return true;
	} else {
		return false;
	}
}

function user_id() {
	if(is_login()){
		return $_SESSION[PRODUCT_ID]['user_id'];
	} else {
		return false;
	}
}
function user_name() {
	if(is_login()){
		ini_db();
		$db = $GLOBALS['db'];
		$statement = $db->prepare('SELECT `name` FROM `users` WHERE `id` = ?');
		$statement->execute(array($_SESSION[PRODUCT_ID]['user_id']));
		if($statement->rowCount() == 1){
			return $statement->fetchColumn();
		} else {
			return 'User Name';
		}
	} else {
		return false;
	}
}

function get_user_data($id,$field='') {
	if(is_login()){
		ini_db();
		$db = $GLOBALS['db'];
		$statement = $db->prepare('SELECT * FROM `users` WHERE `id` = ?');
		$statement->execute(array($id));
		if($statement->rowCount() == 1){
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			if($field != '' && isset($result[$field])){
				return $result[$field];
			}else{
				return $result; 
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function user_type() {
	if(is_login()){
		ini_db();$db = $GLOBALS['db'];
		$statement = $db->prepare('SELECT `user_type` FROM `users` WHERE `id` = ?');
		$statement->execute(array($_SESSION[PRODUCT_ID]['user_id']));
		if($statement->rowCount() == 1){
			return $statement->fetchColumn();
		} else {
			return 0;
		}
	} else {
		return false;
	}
}

function has_permission($title = ""){
	if($title != ""){
		ini_db();$db = $GLOBALS['db'];
		$statement = $db->prepare('SELECT * FROM `user_permission` INNER JOIN (`permission`) ON `user_permission`.`permission_id` = `permission`.`permission_id` WHERE `type_id` = ? AND `permission_title` = ? ');
		$statement->execute(array(user_type(),$title));
		if($statement->rowCount() == 1){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function access_deny($msg=''){
	$out = '<h1 class="alert alert-danger text-center" style="position:relative;top:50px;"><span class="fa fa-ban"></span> ';
	if($msg != ''){
		$out .= $msg;
	} else {
		$out .= 'Access Deny';
	}
	$out .= ' <span class="fa fa-ban"></span></h1>';
	echo $out;
}

function get_customers(){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `customers` WHERE `status` = 1');
	$query->execute(array());
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}
function customer_name($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT `name` FROM `customers` WHERE `customer_id` = ?');
	$query->execute(array($id));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['customer_name'];
}

function customer_data($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `customers` WHERE `customer_id` = ?');
	$query->execute(array($id));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function area_name($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT `area_name` FROM `areas` WHERE `id` = ?');
	$query->execute(array($id));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['area_name'];
}
function get_services(){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `services` WHERE `status` = 1');
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function get_service_items($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `item_services` LIFT JOIN `items` ON `item_services`.`item_id` = `item`.`item_id` WHERE `item_services`.`service_id` = ?');
	$query->execute(array($id));
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function service_name($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT `service_name` FROM `services` WHERE `service_id` = ?');
	$query->execute(array($id));
	$result = $query->fetchColumn();
	return $result;
}

function item_name($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT `item_name` FROM `items` WHERE `item_id` = ?');
	$query->execute(array($id));
	$result = $query->fetchColumn();
	return $result;
}

function item_unit($id,$column='unit_label'){
	$CI =& get_instance();
	$CI->load->database();
	$query = $CI->db->query('SELECT * FROM `items` JOIN `units` ON `items`.`unit_id` = `units`.`unit_id` WHERE `item_id` = ?',array($id));
	$result = $query->row_array();
	if($column != ''){
		return $result[$column];
	}else{
		return $result;
	}
}

function get_items(){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `items` JOIN `units` ON `items`.`unit_id` = `units`.`unit_id` JOIN `qty_dialogs` ON `items`.`dialog_id` = `qty_dialogs`.`dialog_id`');
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function get_item_services($id){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare('SELECT * FROM `item_services` LEFT JOIN `services` ON `item_services`.`service_id` = `services`.`service_id` WHERE `item_services`.`item_id` = ?');
	$query->execute(array($id));
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function get_order_info($order_id){
	ini_db(); $db = $GLOBALS['db'];
	$query1 = $db->prepare("SELECT * FROM `orders` WHERE `order_id` = ?");
	$query2 = $db->prepare("SELECT * FROM `order_lines` WHERE `order_id` = ?");
	$query3 = $db->prepare("SELECT if(sum(`paid`) IS NULL,0.000,sum(`paid`)) FROM `order_payments` WHERE `order_id` = ?");
	$query1->execute(array($order_id));
	$order = $query1->fetch(PDO::FETCH_ASSOC);
	if(empty($order)){
		return array();
	}else{
		$query2->execute(array($order_id));
		$order_lines = $query2->fetchAll(PDO::FETCH_ASSOC);
		$query3->execute(array($order_id));
		$paid = $query3->fetchColumn();
		return array('order'=>$order,'order_lines'=>$order_lines,'paid'=>$paid);
	}
}

function get_collection_info($action_id){
	ini_db(); $db = $GLOBALS['db'];
	$query1 = $db->prepare("SELECT *,`ex_actions`.`created_by` as `user`,`ex_actions`.`created_at` as `created_time` FROM `ex_actions` JOIN `orders` ON `ex_actions`.`order_id` = `orders`.`order_id` JOIN `ex_action_types` ON `ex_actions`.`ex_action_type_id` = `ex_action_types`.`ex_action_type_id` WHERE `ex_actions`.`ex_action_type_id` = ? AND `ex_actions`.`ex_action_id` = ?");
	$query2 = $db->prepare("SELECT *,`ex_action_lines`.`quantity` as `action_quantity`,`order_lines`.`quantity` as `total_quantity` FROM `ex_action_lines` JOIN `order_lines` ON `ex_action_lines`.`line_id` = `order_lines`.`line_id` WHERE `ex_action_lines`.`ex_action_id` = ?");
	$query3 = $db->prepare("SELECT * FROM `order_payments` WHERE `order_id` = ? AND `created_at` = ?");
	$query1->execute(array(1,$action_id));
	$action = $query1->fetch(PDO::FETCH_ASSOC);
	if(empty($action)){
		return array();
	}else{
		$query2->execute(array($action_id));
		$action_lines = $query2->fetchAll(PDO::FETCH_ASSOC);
		$query3->execute(array($action['order_id'],$action['created_time']));
		$payment = $query3->fetchAll(PDO::FETCH_ASSOC);
		return array('action'=>$action,'action_lines'=>$action_lines,'payment'=>$payment);
	}
}

function get_submission_info($action_id){
	ini_db(); $db = $GLOBALS['db'];
	$query1 = $db->prepare("SELECT *,`ex_actions`.`created_by` as `user`,`ex_actions`.`created_at` as `created_time` FROM `ex_actions` JOIN `orders` ON `ex_actions`.`order_id` = `orders`.`order_id` JOIN `ex_action_types` ON `ex_actions`.`ex_action_type_id` = `ex_action_types`.`ex_action_type_id` WHERE `ex_actions`.`ex_action_type_id` = ? AND `ex_actions`.`ex_action_id` = ?");
	$query2 = $db->prepare("SELECT *,`ex_action_lines`.`quantity` as `action_quantity`,`order_lines`.`quantity` as `total_quantity` FROM `ex_action_lines` JOIN `order_lines` ON `ex_action_lines`.`line_id` = `order_lines`.`line_id` WHERE `ex_action_lines`.`ex_action_id` = ?");
	$query3 = $db->prepare("SELECT if(sum(`paid`) IS NULL,0.000,sum(`paid`)) FROM `order_payments` WHERE `order_id` = ? AND `created_at` <= ?");
	$query4 = $db->prepare("SELECT * FROM `order_payments` WHERE `order_id` = ? AND `created_at` = ?");
	$query1->execute(array(2,$action_id));
	$action = $query1->fetch(PDO::FETCH_ASSOC);
	if(empty($action)){
		return array();
	}else{
		$query2->execute(array($action_id));
		$action_lines = $query2->fetchAll(PDO::FETCH_ASSOC);
		$query3->execute(array($action['order_id'],$action['created_time']));
		$paid = $query3->fetchColumn();
		$query4->execute(array($action['order_id'],$action['created_time']));
		$payment = $query4->fetchAll(PDO::FETCH_ASSOC);
		return array('action'=>$action,'action_lines'=>$action_lines,'payment'=>$payment,'paid'=>$paid);
	}
}

function xcrud_fieldname_encode($name = '')
{
	return str_replace(array(
		'=',
		'/',
		'+'), array(
		'-',
		'_',
		':'), base64_encode($name));
}

function get_price($item=0,$service=0){
	ini_db();$db = $GLOBALS['db'];
	$query = $db->prepare("SELECT `price` FROM `item_services` WHERE `item_id` = ? AND `service_id` = ?");
	$query->execute(array($item,$service));
	$price = $query->fetchColumn();
	return $price;
}

function calculate_price($item=array()){
	
	//$percent = "/^[0-9]*\.?[0-9]*%$/";
	//$number = "/^[0-9]*\.?[0-9]{0,3}$/";
	$price = $item['price'];
	$quantity = $item['quantity'];
	$discount = $item['discount'];
	$total = $price * $quantity * (1 - floatval($discount)/100);
	return $total;
//	if(preg_match($percent, $discount) == 1){
//		return $price*$quantity - $price*$quantity*floatval($discount)/100;
//	}elseif(preg_match($number, $discount) == 1){
//		return $price*$quantity - floatval($discount);
//	}else{
//		return $price*$quantity;
//	}
}

function get_settings($title=''){
	$CI =& get_instance();
	$CI->load->database();
	$query = $CI->db->get('settings');
	$settings = array();
	foreach($query->result_array() as $row){
		$settings[$row['title']] = $row['value'];
	}
	
	return ($title != "" && isset($settings[$title]))?$settings[$title]:$settings;
}

$db;
function ini_db(){
	global $db;
	$host=DB_HOST; 
	$User=DB_USER;       
	$Password=DB_PASSWORD;      
	$Database=DB_NAME;     	

#***********************************************************************
	try{
		$db = new PDO("mysql:dbname=$Database;host=$host;charset=UTF8",$User,$Password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    		
	    
	}catch(PDOException $ex){

		die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
	}
}