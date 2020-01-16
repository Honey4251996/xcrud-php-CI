<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincode extends CI_Controller {

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
		$this->load->library('session');

		$user	=	filter_input(INPUT_POST,'user');
		$password	=	filter_input(INPUT_POST,'password');
		//if($password != ""){
		$password   =   hash('sha256',$password);
		//}
		$login_type = get_settings('login_type');
		// SELECT MATCH FROM THE DATABASE
		ini_db();
		$db = $GLOBALS['db'];
		if($login_type == "username"){
			$query	=	"SELECT * FROM `users` where `username`=? LIMIT 1";
		}else{
			$query	=	"SELECT * FROM `users` where `id`=? LIMIT 1";
		}
		$parameters	=	array($user);
		$statement	=	$db->prepare($query);
		$statement->execute($parameters);

		if($statement->rowCount() == 1){
			$data = $statement->fetch(PDO::FETCH_ASSOC);

			if($data['password'] == $password && $data['status'] == 1) {
				$_SESSION[PRODUCT_ID]['user_id'] =   $data['id'];
				$output['status'] = "success";
				$output['msg']	=	'Logged in Successfully';
			} else {
				$output['status'] = "failed";
				$output['msg']		=	'Unable to login, provide correct deitals';
			}
		} else {
			$output['status'] = "failed";
			$output['msg']		=	'Unable to login, provide correct deitals';
		}
		echo json_encode($output);
	}

		
	
	
}
