<?php

date_default_timezone_set('Asia/Bahrain');

define("PRODUCT_ID",'laundry');

if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__.'/../')));
}
if(!defined('ROOT_PATH')){
	define('ROOT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
}

if(!defined('PRODUCT_URL')){
	//define('HOME_PAGE',(isset($_SERVER['HTTPS'])?'https://':'http://').str_replace('bahrainshops.net','',$_SERVER['SERVER_NAME']).(str_replace('bahrainshops.net','',$_SERVER['SERVER_NAME'])!= ""?'/':'').'bahrainshops.net/index.php');
	define('PRODUCT_URL',(isset($_SERVER['HTTPS'])?'https://':'http://').$_SERVER["HTTP_HOST"].strstr($_SERVER["PHP_SELF"],"/".basename($_SERVER["PHP_SELF"]),true));
}

define('DB_HOST','localhost'); 
define("DB_USER",'alhawaj1_4season');       
define('DB_PASSWORD','gVnmLZVX%Psz');      
define('DB_NAME','alhawaj1_4season_test');

