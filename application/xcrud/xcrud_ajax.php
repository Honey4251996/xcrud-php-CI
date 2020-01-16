<?php 
if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__."/../../")));
}
require_once PRODUCT_PATH.'/core/main_functions.php';
if(is_login()){
include ('xcrud.php');
header('Content-Type: text/html; charset=' . Xcrud_config::$mbencoding);
echo Xcrud::get_requested_instance();
}else{
	access_deny();
}
