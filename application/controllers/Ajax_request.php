<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_request extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		if(isset($_POST['task'])){
			$task = filter_input(INPUT_POST,'task');
		}else{
			$task = 'undefined';
		}
		switch ($task){
			case 'save_order':
				ini_db();
				$db = $GLOBALS['db'];
				$order = json_decode(filter_input(INPUT_POST, 'order'),true);
				$payment = json_decode(filter_input(INPUT_POST, 'payment'),true);
				$customer = json_decode(filter_input(INPUT_POST, 'customer'),true);
				$status = 1;
				$created_by = user_id();
				$created_at = date('Y-m-d H:i:s');
				$query1 = $db->prepare("INSERT INTO `orders` (`status`,`customer`,`total`,`created_by`,`created_at`) VALUES (?,?,?,?,?)");
				$query2 = $db->prepare("INSERT INTO `order_lines` (`order_id`,`service_id`,`item_id`,`price`,`quantity`,`discount`,`total`,`system_note`) VALUES (?,?,?,?,?,?,?,?)");
				$query3 = $db->prepare("INSERT INTO `ex_actions` (`order_id`,`ex_action_type_id`,`created_by`,`created_at`) VALUES (?,?,?,?)");
				$query4 = $db->prepare("INSERT INTO `ex_action_lines` (`ex_action_id`,`line_id`,`quantity`) VALUES (?,?,?)");
				$query5 = $db->prepare("INSERT INTO `order_payments` (`order_id`,`payment_type`,`paid`,`given`,`created_by`,`created_at`) VALUES (?,?,?,?,?,?)");
				$query1->execute(array($status,$customer,$payment['total'],$created_by,$created_at));
				$order_id = $db->lastInsertId();
				$query3->execute(array($order_id,1,$created_by,$created_at));
				$action_id = $db->lastInsertId();
				if($payment['payments']['cash'] > 0){
					$query5->execute(array($order_id,'cash',($payment['payments']['cash']-$payment['changes']),$payment['payments']['cash'],$created_by,$created_at));
				}
				if($payment['payments']['card'] > 0){
					$query5->execute(array($order_id,'card',$payment['payments']['card'],$payment['payments']['card'],$created_by,$created_at));
				}
				foreach($order as $line){
					$price = get_price($line['item'],$line['service']);
					$line['price'] = $price;
					$query2->execute(array($order_id,$line['service'],$line['item'],$price,$line['quantity'],$line['discount'],  calculate_price($line),$line['systemNote']));
					$line_id = $db->lastInsertId();
					$query4->execute(array($action_id,$line_id,$line['quantity']));
				}
				echo $action_id;
				//print_r($order);
				//print_r($payment);
			break;
			case "get_customer":
				$id = filter_input(INPUT_POST,'id');
				echo json_encode(customer_data($id));
			break;
			case "submission_order_details":
				$id = filter_input(INPUT_POST,'id');
				ini_db();$db = $GLOBALS['db'];
				$query1 = $db->prepare("SELECT * FROM `orders` WHERE `order_id` = ?");
				$query2 = $db->prepare("SELECT * FROM (SELECT *,(SELECT SUM(`quantity`) FROM `ex_action_lines`  WHERE `line_id` = `order_lines`.`line_id`) as `pending` FROM `order_lines`) as `lines` WHERE `order_id` = ?");
				//$query3 = $db->prepare("SELECT sum(if(`paid` IS NULL,0,`paid`)) FROM `order_actions` LEFT JOIN `order_payments` ON `order_actions`.`action_id` = `order_payments`.`action_id` WHERE `order_actions`.`order_id` = ?");
				$query3 = $db->prepare("SELECT if(sum(`paid`) IS NULL,0.000,sum(`paid`)) FROM `order_payments` WHERE `order_id` = ?");
				$out = array();
				$query1->execute(array($id));
				$query2->execute(array($id));
				$query3->execute(array($id));
				$order = $query1->fetch(PDO::FETCH_ASSOC);
				$lines = $query2->fetchAll(PDO::FETCH_ASSOC);
				$payment = $query3->fetchColumn();
				$customer = customer_data($order['customer']);
				$pending = "";
				$submitted = "";
				foreach($lines as $line){
					$temp =  "<div class='order-line'>";
					if($line['pending'] > 0){
						$temp =  "<div class='order-line active'>";
						$temp .= "<input class='line-id' type='checkbox' checked value = ".$line['line_id']." >";
					}
					$temp .= "<div class='row'>";
					$temp .= "<div class='col-xs-7 line-item'>".$line['system_note'].' '.item_name($line['item_id'])." - ".service_name($line['service_id'])."</div>";
					$temp .= "<div class='col-xs-2 quantity text-right'>".$line["quantity"]."x</div>";
					$temp .= "<div class='col-xs-3 text-right pirce'>BD ".$line['price']."</div>";
					$temp .= "<div class='clearfix'></div></div>";
					$temp .= "<div class='row'>";
					$temp .= "<div class='col-xs-4 discount'>";
					if($line['discount'] > 0){
						$temp .= "Disc ".$line['discount']."%";
					}
					$temp .= "</div>";
					$temp .= "<div class='col-xs-5 text-right'>SubTotal</div>";
					$temp .= "<div class='col-xs-3 subtotal text-right'> BD ".$line['total']."</div>";
					$temp .= "<div class='clearfix'></div></div></div>";
					if($line['pending'] > 0){
						$pending .= $temp;
					}else{
						$submitted .= $temp; 
					}
				}
				$out = "<div class='order-details'>";
				if($pending != ""){
				$out .= "<div class='pending'>";
				$out .= "<h2 class='text-center'>Pending</h2>";
				$out .= $pending;
				$out .= "</div>";
				}
				if($submitted != ""){
					$out .= "<div class='submitted'>";
					$out .= "<h2 class='text-center'>Submitted</h2>";
					$out .= $submitted;
					$out .= "</div>";
				}
				$out .= "</div>";
				//$out .= "<div class='customer-info'>".$customer['name']." - Mob: ".$customer['mobile_num']."</div>";
				//$out .=	"<div class='order-total'>";
				//$out .= "<div class='col-xs-6'>Total</div>";
				//$out .= "<div class='col-xs-6 total text-right'>BD ".$order['total']."</div>";
				//$out .= "</div>";
				$data['html'] = $out;
				$data['order_info'] = $order;
				//$data['order_lines'] = $lines;
				$data['order_payment'] = $payment;
				$data['customer'] = $customer;
				echo json_encode($data);
			break;
			case "submit_order":
				$data = json_decode(filter_input(INPUT_POST,'submission'),true);
				ini_db();$db = $GLOBALS['db'];
				$query1 = $db->prepare("INSERT INTO `ex_actions` (`order_id`,`ex_action_type_id`,`created_by`,`created_at`) VALUES (?,?,?,?)");
				$query2 = $db->prepare("SELECT `quantity` FROM `order_lines` WHERE `line_id` = ?");
				$query3 = $db->prepare("INSERT INTO `ex_action_lines` (`ex_action_id`,`line_id`,`quantity`) VALUES (?,?,?)");
				$query4 = $db->prepare("INSERT INTO `order_payments` (`order_id`,`payment_type`,`paid`,`given`,`created_by`,`created_at`) VALUES (?,?,?,?,?,?)");
				$query5 = $db->prepare("SELECT sum(`ex_action_lines`.`quantity`) FROM `ex_actions` JOIN `ex_action_lines` ON `ex_actions`.`ex_action_id` = `ex_action_lines`.`ex_action_id` WHERE `ex_actions`.`order_id` = ?");
				//$query6 = $db->prepare("SELECT `total`-(SELECT if(sum(`paid`) IS NULL,0.000,sum(`paid`)) FROM `order_payments` WHERE `order_id` = `order`.`order_id`) as `payment` FROM `orders` WHERE `order_id` = ?");
				$query7 = $db->prepare("UPDATE `orders` SET `status` = ? WHERE `order_id` = ?");
				$action_type = 2;
				$created_by = user_id();
				$created_at = date('Y-m-d H:i:s');
				$query1->execute(array($data['order'],$action_type,  $created_by,$created_at));
				$action_id = $db->lastInsertId();
				foreach($data['lines'] as $line){
					$query2->execute(array($line));
					$quantity = $query2->fetchColumn();
					$query3->execute(array($action_id,$line,-$quantity));
				}
				$payment = $data['payment'];
				if($payment['payments']['cash'] > 0){
					$query4->execute(array($data['order'],'cash',($payment['payments']['cash']-$payment['changes']),$payment['payments']['cash'],$created_by,$created_at));
				}
				if($payment['payments']['card'] > 0){
					$query4->execute(array($data['order'],'card',$payment['payments']['card'],$payment['payments']['card'],$created_by,$created_at));
				}
				$query5->execute(array($data['order']));
				$pending_qty = $query5->fetchColumn();
				if($pending_qty == 0){
					$query7->execute(array(2,$data['order']));
				}
		//		$query6->execute(array($data['order']));
		//		$pending_payment = $query6->fetchColumn();
		//		if($pending_payment > 0 && $pending_qty > 0){
		//			$query7->execute(array(1,$data['order']));
		//		}elseif($pending_payment > 0 && $pending_qty == 0){
		//			$query7->execute(array(2,$data['order']));
		//		}elseif($pending_payment == 0 && $pending_qty > 0){
		//			$query7->execute(array(3,$data['order']));
		//		}elseif($pending_payment == 0 && $pending_qty == 0){
		//			$query7->execute(array(4,$data['order']));
		//		}
				echo $action_id;
				//print_r($data);
			break;
			case "get_receipt":
				$type = filter_input(INPUT_POST,'type');
				$id = filter_input(INPUT_POST,'id');
				$this->load->helper("url");
				$this->load->library("bs_form");
				if($type == "order"){
					$this->load->view('printing/order_receipt',array('order_id'=>$id));
				}elseif($type == "collection"){
					$this->load->view('printing/collection_receipt',array('action_id'=>$id));
				}elseif($type == "submission"){
					$this->load->view('printing/submission_receipt',array('action_id'=>$id));
				}
			break;
		}

	}
	
	
}
