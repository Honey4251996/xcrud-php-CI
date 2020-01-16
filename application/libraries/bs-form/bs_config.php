<?php
if(!defined('BS_PATH')){
	define('BS_PATH',str_replace('\\','/',realpath(__DIR__)));
}

define('NOIMAGEURL',PRODUCT_URL."/assets/photos/no-image.png");
define('IMAGEURL',PRODUCT_URL."/assets/photos/company/");
define('IMAGEPATH',PRODUCT_PATH."/assets/photos/company/");
define('IMAGEMAXSIZE',5);
define('UPLOADFILE',PRODUCT_URL."/index.php/upload");

class bs_config {
	public static $theme = "default";
}

