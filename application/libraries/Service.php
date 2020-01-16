<?php

if(!defined('PRODUCT_PATH')){
	define('PRODUCT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
}
require_once "root.php";

/**
 * Description of party
 *
 * @author Ahmed Saif
 */
class service extends root{
	
	protected $table_name ="services";
	protected $primary = "service_id";
	protected $new_title = "New Service";
	protected $edit_title = "Edit Service";
	protected $list_title = "Services";
	protected $buttons_position = array("up","left"); // both,up,down // left,right
	protected $selectable = false;
	protected $fields = "image,service_name";
	protected $columns = "image,service_name";
	protected $labels = array();
	protected $left_fields;
	protected $right_fields;
	protected $required_fields = "service_name";
	protected $this_file = __FILE__;
	protected $theme_config = array(
			'details_label_cell'=>'control-label col-lg-2 xcrud-label',
			'details_field_cell'=>'col-lg-10 xcrud-field'
		);
	
	protected function setting(&$table){
		Xcrud_config::$manual_load=true;
		$table->where("status",1);
		$table->unset_print();
		$table->unset_csv();
		$table->change_type("image","image","",array('path'=>'../../assets/photos/services','width'=>'150px'));
	}
	
	public function edit($id = 0,$render=true) {
		return parent::edit($id).$this->items($id);
	}
	
	public function items($id = 0){
		$table = Xcrud::get_instance();
		$table->table("item_services");
		$table->table_name("Prices");
		$table->where("service_id",$id);
		$table->hide_button("save_edit,save_new,new");
		$table->set_lang("save_return","Save");
		$table->unset_print();
		$table->unset_csv();
		$table->pass_var('service_id',$id);
		$table->fields("item_id,price");
		$table->columns("item_id,price");
		$table->label(array("item_id"=>"Item"));
		$table->relation("item_id","items","item_id","item_name","item_id = '{item_id}' OR NOT EXISTS (SELECT * FROM `item_services` WHERE `service_id` = ".$id." AND `item_id` = `items`.`item_id`)");
		$table->validation_required('item_id');
		root::price_type($table, "price");
		return $table->render();
	}
	
}


function before_insert($postdata,$xcrud){
	
}

function after_insert($postdata,$id,$xcrud){
	$xcrud->set_message("Data Saved Successfully",'success');
	echo "<input type='hidden' class='xcrud-data' name='primary' value='{$id}' />";
	exit();
}