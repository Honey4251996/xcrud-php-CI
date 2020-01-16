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
class item extends root{
	
	protected $table_name ="items";
	protected $primary = "item_id";
	protected $new_title = "New Item";
	protected $edit_title = "Edit Item";
	protected $list_title = "Items";
	protected $buttons_position = array("up","left"); // both,up,down // left,right
	protected $selectable = false;
	protected $fields = "";
	protected $columns = "image,item_name,unit_id";
	protected $labels = array('unit_id'=>"Unit","dialog_id"=>"Qty Dialog");
	protected $left_fields;
	protected $right_fields;
	protected $required_fields = "item_name";
	protected $this_file = __FILE__;
	protected $theme_config = array(
			'details_label_cell'=>'control-label col-sm-2 xcrud-label',
			'details_field_cell'=>'col-sm-10 xcrud-field'
		);
	
	protected function setting(&$table){
		Xcrud_config::$manual_load=true;
		$table->unset_print();
		$table->unset_csv();
		$table->change_type("image","image","",array('path'=>'../../assets/photos/items','width'=>'150px'));
		$table->relation("unit_id","units","unit_id","unit_name");
		$table->relation("dialog_id","qty_dialogs","dialog_id","dialog_name");
		$table->disabled("unit_id",'edit');
	}
	
	public function edit($id = 0,$render=true) {
		return parent::edit($id).$this->services($id);
	}
	
	public function services($id = 0){
		$table = Xcrud::get_instance();
		$table->table("item_services");
		$table->table_name("Prices");
		$table->where("item_id",$id);
		$table->hide_button("save_edit,save_new,new");
		$table->set_lang("save_return","Save");
		$table->unset_print();
		$table->unset_csv();
		$table->unset_view();
		$table->pass_var('item_id',$id);
		$table->fields("service_id,price");
		$table->columns("service_id,price");
		$table->label(array("service_id"=>"Service"));
		$table->relation("service_id","services","service_id","service_name","service_id = '{service_id}' OR NOT EXISTS (SELECT * FROM `item_services` WHERE `item_id` = ".$id." AND `service_id` = `services`.`service_id`)");
		$table->validation_required('service_id');
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