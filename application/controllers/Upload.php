<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
		require_once APPPATH."libraries/bs-form/bs_config.php";
		if(!is_login()){
			header('Location:index');
			exit();
		}
		if(isset($_POST['task'])){
			$task = filter_input(INPUT_POST,'task');

			switch($task):
				case "upload_image":
					if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
						$file = $_FILES['image'];
						$fileInfo = pathinfo($file['name']);
						$fileName = $fileInfo['basename'];
						$output = array();
						$uploaddir = IMAGEPATH;
						$uploadfile = $uploaddir .$fileName;
						$i = 1;
						while(file_exists($uploadfile)){
							$fileName = $fileInfo['filename']."-".$i.".".$fileInfo['extension'];
							$uploadfile = $uploaddir .$fileName;
							$i++;
						}
						if($file['type'] != "image/jpeg" && $file['type'] != "image/png"){
							$output['status'] = "error"; 
							$output['message'] = "File type is not allowed"; 
						}elseif($file['size']/(1024*1024) > IMAGEMAXSIZE){
							$output['status'] = "error"; 
							$output['message'] = "File size exceed the limit"; 
						}elseif (move_uploaded_file($file['tmp_name'], $uploadfile)) {
							$output['status'] = "done"; 
							$output['message'] = "Image added Successfully"; 
							$output['file'] = $fileName; 
						} else {
							$output['status'] = "error"; 
							$output['message'] = "Unable to upload the file";
						}
						echo json_encode($output);
					}
				break;
			endswitch;
		}


	}
	
}
