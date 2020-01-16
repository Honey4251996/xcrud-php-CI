<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		if(is_login()){
			header('Location:'.base_url('index.php/dashboard'));
			exit();
		}else{
			header('Location:'.base_url('index.php/login'));
			exit();
		}
	}
	
	public function login(){
//		$this->load->library('session');
		//$this->load->helper('url');
		$this->load->database();
		$this->load->view('login',array('login_type'=>  get_settings('login_type')));
	}
	
	public function logout(){
//		$this->load->library('session');
//		$this->load->helper('url');
		$this->load->library('session');
		unset($_SESSION[PRODUCT_ID]);
		header("Location:login");
		exit();
	}
	
	
	public function profile(){
		$this->load->view('profile');
	}
	
	public function users(){
		if(!has_permission('Manage Users')){
			access_deny();
			exit();
		}
		$this->load->view('users');
	}
	
	public function permissions(){
		if(!has_permission('Manage Permissions')){
			access_deny();
			exit();
		}
		$this->load->view('permissions');
	}
	
	public function collection(){
		$this->load->view('collection');
	}
	
	public function submission(){
		$this->load->view('submission');
	}
	
	public function customers(){
		$this->load->view('customers',['this_file'=>__FUNCTION__]);
	}
	
	public function orders(){
		$this->load->view('orders',['this_file'=>__FUNCTION__]);
	}
	
	public function services(){
		$this->load->view('services',['this_file'=>__FUNCTION__]);
	}
	
	public function items(){
		$this->load->view('items',['this_file'=>__FUNCTION__]);
	}
	
	public function order_report(){
		$this->load->view('order_report');
	}
	
	public function payment_report(){
		$this->load->view('payment_report');
	}
	
	public function service_report(){
		$this->load->view('service_report');
	}
	
	public function companyinfo(){
		$settings = get_settings();
		$this->load->view('company_info',["settings"=>$settings]);
	}
	
	public function general_settings(){
		$settings = get_settings();
		$this->load->view('general_settings',["settings"=>$settings]);
	}
	
	public function printers(){
		$this->load->view('printers');
	}
	
	public function dashboard(){
		if(has_permission("Collect Order")){
			header("location:collection");
			exit();
		}
	}
	
}
