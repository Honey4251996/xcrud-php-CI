<?php
if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
}
require_once PRODUCT_PATH.'/core/config.php';
require_once PRODUCT_PATH.'/core/classes/action_log.php';
//----------------------------Users Functions ------------------------------
function confirm_password_insert($postdata,$xcrud) {
	if ($postdata->get("password") == "") {
			$xcrud->set_exception("password,confirm_password","Password is required","error");
	}else if(($postdata->get("password") !== $postdata->get("confirm_password"))){
		$xcrud->set_exception("password,confirm_password","Password doesn't match confirmation","error");
	}
	
}

function confirm_password_update($postdata,$primary,$xcrud) {
	if($postdata->get("password") !== $postdata->get("confirm_password")){
		$xcrud->set_exception("password,confirm_password","Password doesn't match confirmation","error");
	}
	
}

function set_permissions($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('DELETE FROM `user_permission` WHERE `type_id` = ?');
	$statement->execute(array($primary));
	$permissions = explode(",",$postdata->get('permissions'));
	$statement = $db->prepare('INSERT INTO `user_permission` (`type_id`,`permission_id`) VALUES (?,?)');
	foreach($permissions as $row) {
		$statement->execute(array($primary,$row));
	}
}
function remove_user($primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `users` SET `status` = 0 WHERE `id` = ?');
	$statement->execute(array($primary));
}

function unlock_user($xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$id = $xcrud->get('primary');
	$query = $db->prepare('SELECT * FROM `users` WHERE `id` = ?');
	$query->execute(array($id));
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if($row['status'] == 2){
		$query = $db->prepare('UPDATE `users` SET `status` =  1 WHERE `id` = ?');
		$query->execute(array($id));
	}
}
//-----------------------party functions -----------------------------------
function create_party($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `customer_address` SET `customer_id` = ? WHERE `default` = ?');
	$statement->execute(array($primary,$primary));
	$xcrud->set_message('New Customer added successully','success');
	//$_SESSION['party_id'] = $primary;
	//action_log::general('create customer','customer',$postdata->to_array(), $primary);
}

function update_party($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('SELECT * FROM `customer` WHERE `customer_id` = ?');
	$statement->execute(array($primary));
	$old = $statement->fetch(PDO::FETCH_ASSOC);
	$xcrud->set_message('Changes saved successully','success');
	//action_log::general_edit('edit customer','customer',$old,$postdata->to_array(), $primary);
}

function delete_party($primary,$xcrud) {
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `customer` SET `status` = 0 WHERE `customer_id` = ?');
	$statement->execute(array($primary));
	//action_log::general('delete customer','customer','', $primary);
}

function restore_party($xcrud) {
	require PRODUCT_PATH.'/core/ini_db.php';
	if($xcrud->get('primary')) {
		$primary = $xcrud->get('primary');
		$statement = $db->prepare('UPDATE `customer` SET `status` = 1 WHERE `customer_id` = ?');
		$statement->execute(array($primary));
		//action_log::general('Restore Party','party','', $xcrud->get('primary'));
	}
	
}
//----------------------------------------------------------------------------------------------

function quotation_items($value, $field, $priimary_key, $list, $xcrud)
{
	return "<div class='items'>"
		."<div class='row'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-primary'>Description</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-primary'>Amount (BD)</h4></div>"
		. "</div>"
		."<div class='row item-row'>"
		."<div class='col-xs-8'><input class='form-control xcrud-input description' data-required='1'></div>"
		."<div class='col-xs-4'><input class='form-control xcrud-input amount' data-required='1' placeholder='0.000'></div>"
		. "</div>"
		."<div class='row items-total'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-info'>Total</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-info total-amount'>BD 0.000</h4></div>"
		. "</div>"
		. "</br><div>"
		. "<a class='btn btn-default pull-right add-row'><i class='fa fa-plus'></i></a>"
		. "<a class='btn btn-default pull-right remove-row'><i class='fa fa-minus'></i></a>"
		. "</div>"
		. "</div>";
}


function quotation_serial($value, $field, $primary_key, $list, $xcrud){
	$serial = "Q".str_pad($value,5,"0",STR_PAD_LEFT);
	return "<input type='text' value='".$serial."' readonly class='form-control'>";
}

function after_insert_quotation_items($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$query = $db->prepare('INSERT INTO `quotation_items`(`quotation_id`, `description`, `price`) VALUES (?,?,?)');
	$items =json_decode($_POST['xcrud']['items'],true);
	foreach($items as $row){
		$query->execute(array($primary,$row['description'],$row['amount']));
	}
	echo '<input type="hidden" class="xcrud-data" name="primary" value="'.$primary.'">';
	exit();
}

function before_insert_quotation_items($postdata,$xcrud){
	$postdata->set('created_at',date("Y-m-d H:i:s"));
}
//-------------------------------------------------------------------------------------------
function memo_items($value, $field, $priimary_key, $list, $xcrud)
{
	return "<div class='items'>"
		."<div class='row'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-primary'>Description</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-primary'>Amount (BD)</h4></div>"
		. "</div>"
		."<div class='row item-row'>"
		."<div class='col-xs-8'><input class='form-control xcrud-input description' data-required='1'></div>"
		."<div class='col-xs-4'><input class='form-control xcrud-input amount' data-required='1' placeholder='0.000'></div>"
		. "</div>"
		."<div class='row items-total'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-info'>Total</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-info total-amount'>BD 0.000</h4></div>"
		. "</div>"
		. "</br><div>"
		. "<a class='btn btn-default pull-right add-row'><i class='fa fa-plus'></i></a>"
		. "<a class='btn btn-default pull-right remove-row'><i class='fa fa-minus'></i></a>"
		. "</div>"
		. "</div>";
}

function memo_serial($value, $field, $primary_key, $list, $xcrud){
	$serial = "C".str_pad($value,5,"0",STR_PAD_LEFT);
	return "<input type='text' value='".$serial."' readonly class='form-control'>";
}

function after_insert_memo_items($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$query = $db->prepare('INSERT INTO `memo_items`(`memo_id`, `description`, `price`) VALUES (?,?,?)');
	$items =json_decode($_POST['xcrud']['items'],true);
	foreach($items as $row){
		$query->execute(array($primary,$row['description'],$row['amount']));
	}
	echo '<input type="hidden" class="xcrud-data" name="primary" value="'.$primary.'">';
	exit();
}

function before_insert_memo_items($postdata,$xcrud){
	$postdata->set('created_at',date("Y-m-d H:i:s"));
}
//---------------------------------------------------------------------------------------
function invoice_items($value, $field, $priimary_key, $list, $xcrud)
{
	return "<div class='items'>"
		."<div class='row'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-primary'>Description</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-primary'>Amount (BD)</h4></div>"
		. "</div>"
		."<div class='row item-row'>"
		."<div class='col-xs-8'><input class='form-control xcrud-input description' data-required='1'></div>"
		."<div class='col-xs-4'><input class='form-control xcrud-input amount' data-required='1' placeholder='0.000'></div>"
		. "</div>"
		."<div class='row items-total'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-info'>Total</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-info total-amount'>BD 0.000</h4></div>"
		. "</div>"
		. "</br><div>"
		. "<a class='btn btn-default pull-right add-row'><i class='fa fa-plus'></i></a>"
		. "<a class='btn btn-default pull-right remove-row'><i class='fa fa-minus'></i></a>"
		. "</div>"
		. "</div>";
}

function invoice_serial($value, $field, $primary_key, $list, $xcrud){
	$serial = "IN".str_pad($value,5,"0",STR_PAD_LEFT);
	return "<input type='text' value='".$serial."' readonly class='form-control'>";
}

function after_insert_invoice_items($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$query = $db->prepare('INSERT INTO `invoice_items`(`invoice_id`, `description`, `price`) VALUES (?,?,?)');
	$items =json_decode($_POST['xcrud']['items'],true);
	foreach($items as $row){
		$query->execute(array($primary,$row['description'],$row['amount']));
	}
	echo '<input type="hidden" class="xcrud-data" name="primary" value="'.$primary.'">';
	exit();
}

function before_insert_invoice_items($postdata,$xcrud){
	$postdata->set('created_at',date("Y-m-d H:i:s"));
}
function invoice_paid($xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$query = $db->prepare('UPDATE `invoice` SET `payment_status` = 2 WHERE `invoice_id` = ?');
	if($xcrud->get('primary')){
		$query->execute(array($xcrud->get('primary')));
	}
}
//---------------------------------------------------------------------------------------

function delivery_items($value, $field, $priimary_key, $list, $xcrud)
{
	return "<div class='items'>"
		."<div class='row'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-primary'>Description</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-primary'>Amount (BD)</h4></div>"
		. "</div>"
		."<div class='row item-row'>"
		."<div class='col-xs-8'><input class='form-control xcrud-input description' data-required='1'></div>"
		."<div class='col-xs-4'><input class='form-control xcrud-input amount' data-required='1' placeholder='0.000'></div>"
		. "</div>"
		."<div class='row items-total'>"
		."<div class='col-xs-8'><h4 class='text-center form-control-static bg-info'>Total</h4></div>"
		."<div class='col-xs-4'><h4 class='text-center form-control-static bg-info total-amount'>BD 0.000</h4></div>"
		. "</div>"
		. "</br><div>"
		. "<a class='btn btn-default pull-right add-row'><i class='fa fa-plus'></i></a>"
		. "<a class='btn btn-default pull-right remove-row'><i class='fa fa-minus'></i></a>"
		. "</div>"
		. "</div>";
}

function delivery_serial($value, $field, $primary_key, $list, $xcrud){
	$serial = "D".str_pad($value,5,"0",STR_PAD_LEFT);
	return "<input type='text' value='".$serial."' readonly class='form-control'>";
}

function after_insert_delivery_items($postdata,$primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$query = $db->prepare('INSERT INTO `delivery_items`(`delivery_id`, `description`, `price`) VALUES (?,?,?)');
	$items =json_decode($_POST['xcrud']['items'],true);
	foreach($items as $row){
		$query->execute(array($primary,$row['description'],$row['amount']));
	}
	echo '<input type="hidden" class="xcrud-data" name="primary" value="'.$primary.'">';
	exit();
}

function before_insert_delivery_items($postdata,$xcrud){
	$postdata->set('created_at',date("Y-m-d H:i:s"));
}


function remove_quotation($primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `quotation` SET `status` = 0 WHERE `quotation_id` = ?');
	$statement->execute(array($primary));
}

function remove_memo($primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `memo` SET `status` = 0 WHERE `memo_id` = ?');
	$statement->execute(array($primary));
}

function remove_invoice($primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `invoice` SET `status` = 0 WHERE `invoice_id` = ?');
	$statement->execute(array($primary));
}

function remove_delivery($primary,$xcrud){
	require PRODUCT_PATH.'/core/ini_db.php';
	$statement = $db->prepare('UPDATE `delivery` SET `status` = 0 WHERE `delivery_id` = ?');
	$statement->execute(array($primary));
}

?>