<?php

if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
}
//require_once PRODUCT_PATH.'/core/main_functions.php';
require_once PRODUCT_PATH.'/application/xcrud/xcrud.php';

class user {
	
	public function profile() {
		$profile = Xcrud::get_instance();
		$profile -> table('users');
		$profile -> hide_button('save_return,save_new,save_view,return,new');
		$profile -> set_lang("save_edit","Save Changes");
		$profile -> before_update("confirm_password_update",__FILE__);
		$profile -> fields("image,name,username,mobile,password,confirm_password");
		$profile -> readonly('name,username,extension,employee_no');
		//$profile -> readonly('password,confirm_password'); //for demo only
		$profile -> change_type("password","password","sha256");
		$profile -> change_type("confirm_password","password","sha256");
		$profile -> change_type("image","image","",array('path'=>'../../assets/userdata/profiles',"url"=>base_url()."index.php/get_image?task=profile_image&image=",'width'=>'150px'));
		//$profile -> change_type("signature","image","",array('path'=>'../../userdata/signatures','width'=>'150px'));
		//$profile -> validation_required('mobile');
		//$profile->label(array('email'=>'User Name'));
		$profile -> validation_pattern("mobile","numeric");
		$profile -> validation_pattern("password",'^([a-zA-Z_0-9]{8,})+$',"i");
		$profile -> field_tooltip("password","Minimum length is 8 characters (a-z,A-Z,0-9 and _ )");
		$profile -> table_name(ucwords(user_name()));
		$profile -> after_resize('image_upload',__FILE__);
		return $profile;
	}
	
	public function manage_users() {
		$users = Xcrud::get_instance();
		$users -> table("users");
		//$users -> is_selectable = true;
		//$users -> add_row_class('image,name,mobile','test');
		$users -> where("status != 0");
		$users -> unset_csv();
		$users -> unset_print();
		$users -> unset_view();
		$users -> hide_button("save_new,save_edit,new,save_view");
		$users -> set_lang("save_return","Save");
		$users -> validation_required("name,username,user_type");
		$users -> change_type("password","password","sha256");
		$users -> change_type("confirm_password","password","sha256");
		$users -> before_update("confirm_password_update",__FILE__);
		$users -> before_insert("confirm_password_insert",__FILE__);
		$users -> relation("user_type","users_type","type_id","type_title");
		$users -> change_type("image","image","",array('path'=>'userdata/profiles','width'=>'150px'));
		//$users->change_type("signature","image","",array('path'=>'../../userdata/signatures','width'=>'150px'));
		//$users -> validation_pattern("email","email");
		//$users -> validation_pattern("name",'^([a-zA-Z\s])+$');
		$users -> validation_pattern("password",'^([a-zA-Z_0-9]{8,})+$',"i");
		$users -> field_tooltip("password","Minimum length is 8 characters (a-z,A-Z,0-9 and _ )");
		$users -> validation_pattern("mobile,extension,employee_no","numeric");
		$users -> replace_remove('remove_user',__FILE__);
		//$users -> columns('status',true);
		$users -> columns("image,name,username,mobile,user_type");
		$users -> fields("image,name,username,mobile,user_type,password,confirm_password");
		//$users ->label(array('email'=>'User Name'));
		//$users->create_action('unlock','unlock_user',__FILE__);
//		$users->button("#","Unlock","fa fa-unlock-alt","btn-default xcrud-action",
//				array('data-task'=>'action','data-action'=>'unlock','data-primary'=>'{id}'),
//				array('status','=',2)
//				);
//		$users->add_row_class('mobile,extension,employee_no,user_type','col-sm-6 xcrud-half-row');
//		$users->add_row_class('image','xcrud-center');
//		$users->custom_theme_config('details_row','form-group col-sm-12');
//		$users->custom_theme_config('details_label_cell','xcrud-label');
//		$users->custom_theme_config('details_field_cell','xcrud-field');
		return $users;
	}
		
	public function permissions(){
		$table = Xcrud::get_instance();
		$table	->table('users_type');
		$table	->table_name('Permissions');
		$table	->unset_view();
		$table	->unset_print();
		$table	->unset_csv();
		$table	-> hide_button("save_new,save_edit,new,save_view");
		$table	-> set_lang("save_return","Save");
		$table	->label(array('type_title'=>'User Type'));
		$table	->validation_required('type_title');
		//$table->relation('permissions','permission','permission_id','permission_title','','',true);
		$table->fk_relation('Permissions','type_id','user_permission','type_id','permission_id','permission','permission_id','permission_title');
		$table->set_attr('Permissions',array('class'=>'xcrud-input searchable'));
		$table->column_width('type_title','25%');
		$table->column_cut(500,'Permissions');
		//$table->after_insert('set_permissions');
		//$table->after_update('set_permissions');
		return $table;
	}
}

function confirm_password_insert($postdata,$xcrud) {
	if ($postdata->get("password") == "") {
			$xcrud->set_exception("password,confirm_password","Password is required","error");
	}else if(($postdata->get("password") !== $postdata->get("confirm_password"))){
		$xcrud->set_exception("password,confirm_password","Password doesn't match confirmation","error");
	}
	
}

function confirm_password_update($postdata,$primary,$xcrud) {
	if($postdata->get("password") !== $postdata->get("confirm_password")){
		$xcrud->set_exception("password,confirm_password","Password doesn't match confirmation","error");
	}
	
}


function set_permissions($postdata,$primary,$xcrud){
	//require PRODUCT_PATH.'/core/ini_db.php';
	ini_db();$db = $GLOBALS['db'];
	$statement = $db->prepare('DELETE FROM `user_permission` WHERE `type_id` = ?');
	$statement->execute(array($primary));
	$permissions = explode(",",$postdata->get('permissions'));
	$statement = $db->prepare('INSERT INTO `user_permission` (`type_id`,`permission_id`) VALUES (?,?)');
	foreach($permissions as $row) {
		$statement->execute(array($primary,$row));
	}
}
function remove_user($primary,$xcrud){
	//require PRODUCT_PATH.'/core/ini_db.php';
	ini_db();$db = $GLOBALS['db'];
	$statement = $db->prepare('UPDATE `users` SET `status` = 0 WHERE `id` = ?');
	$statement->execute(array($primary));
}

function unlock_user($xcrud){
	//require PRODUCT_PATH.'/core/ini_db.php';
	ini_db();$db = $GLOBALS['db'];
	$id = $xcrud->get('primary');
	$query = $db->prepare('SELECT * FROM `users` WHERE `id` = ?');
	$query->execute(array($id));
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if($row['status'] == 2){
		$query = $db->prepare('UPDATE `users` SET `status` =  1 WHERE `id` = ?');
		$query->execute(array($id));
	}
}

function image_upload($field,$filename,$file_path,$config,$xcrud){
	$_SESSION[PRODUCT_ID]['upload_image'] = $filename;
}