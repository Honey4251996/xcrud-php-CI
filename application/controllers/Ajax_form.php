<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_form extends CI_Controller {

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
			case 'company_info':
				$error = false;
				$report = array();
				if($_POST['data']['company_name'] == ""){
					$error = true;
					$report['company_name'] = "This field is required";
				}
				if($error){
					$output = array("fail"=>"fail","message"=>"There are some errors");
					$output['report'] = $report;
					echo json_encode($output);
				}else{
					$this->load->database();
					$sql = "INSERT INTO `settings` (`title`,`value`) VALUES (?,?) ON DUPLICATE KEY UPDATE `value` = ? ";
					foreach($_POST['data'] as $key=>$value){
						$this->db->query($sql,array($key,$value,$value));
					}
					$output = array("status"=>"success","message"=>"Changes saved successfully");
					echo json_encode($output);
				}
			break;
			case 'general_settings':
				$error = false;
				$report = array();
				
				if($error){
					$output = array("fail"=>"fail","message"=>"There are some errors");
					$output['report'] = $report;
					echo json_encode($output);
				}else{
					$this->load->database();
					$sql = "INSERT INTO `settings` (`title`,`value`) VALUES (?,?) ON DUPLICATE KEY UPDATE `value` = ? ";
					foreach($_POST['data'] as $key=>$value){
						$this->db->query($sql,array($key,$value,$value));
					}
					$output = array("status"=>"success","message"=>"Changes saved successfully");
					echo json_encode($output);
				}
			break;
		}
	}
	
	
}
