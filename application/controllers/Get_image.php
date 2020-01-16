<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_image extends CI_Controller {

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
		if(!is_login()){
			header('Location:index');
			exit();
		}
		//$this->load->helper('url');
		ini_db();
		$db = $GLOBALS['db'];
		$task = filter_input(INPUT_GET,"task");
		switch($task){
			case "user_image":
				$statement = $db->prepare("SELECT `image` FROM `users` WHERE `id`=?");
				$statement->execute(array($_SESSION[PRODUCT_ID]['user_id']));
				$img = $statement->fetchColumn();
				if($img == ""){
					$img = 'user.png';
					$image = "assets/userdata/profiles/".$img;
				}else{
					$image = "assets/userdata/profiles/".$img;
				}
				$imginfo = getimagesize($image);
				header("Content-type:".$imginfo['mime']);
				readfile($image);
			break;
			case "profile_image":
				$img = trim(filter_input(INPUT_GET,"image"),'/');
				if(isset($_SESSION[PRODUCT_ID]['upload_image']) && $_SESSION[PRODUCT_ID]['upload_image'] == $img){
					$image = "assets/userdata/profiles/".$img;
				}else{
					$statement = $db->prepare("SELECT `image` FROM `users` WHERE `id`=?");
					$statement->execute(array($_SESSION[PRODUCT_ID]['user_id']));
					$img = $statement->fetchColumn();
					if($img == ""){
						$img = 'user.png';
						$image = "assets/userdata/profiles/".$img;
					}else{
						$image = "assets/userdata/profiles/".$img;
					}
				}
				$imginfo = getimagesize($image);
				header("Content-type:".$imginfo['mime']);
				readfile($image);
			break;
		}
	}

		
	
	
}
