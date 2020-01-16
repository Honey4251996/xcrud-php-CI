<?php
	
	//require_once '../core/main_functions.php';
	secure_session_start();
	
	if(!is_login()){
		header('Location:login');
		exit();
	}
	$widgets = true;
	require_once PRODUCT_PATH.'/application/xcrud/xcrud.php';

