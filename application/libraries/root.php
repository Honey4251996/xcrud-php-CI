<?php


//require_once PRODUCT_PATH.'/core/main_functions.php';
require_once PRODUCT_PATH.'/application/xcrud/xcrud.php';
//require_once PRODUCT_PATH.'/core/templates.php';

/**
 * Description of party
 *
 * @author Ahmed Saif
 */
abstract class root {
	
	protected $table_name ;
	protected $primary = "id";
	protected $new_title ;
	protected $edit_title ;
	protected $list_title ;
	
	protected $edit = true;
	protected $view = false;
	protected $remove = false;
	
	protected $buttons_position; // both,up,down // left,right
	protected $selectable ;
	protected $fields ;
	protected $columns ;
	protected $labels = array();
	
	protected $left_fields;
	protected $right_fields ;
	protected $required_fields;
	protected $price_fields;
	protected $this_file = __FILE__;
	protected $theme_config = array();


	public static function price_type(&$table,$fields=""){
		if($fields != ""){
			$table->change_type($fields,"price","",array('decimals'=>3,'prefix'=>'BD '));
		}
	}

	protected function initialize(&$table){
		$table->detail_buttons_position = $this->buttons_position;
		if($this->fields != ""){
			$table->fields($this->fields);
		}
		if($this->columns != ""){
			$table->columns($this->columns);
		}
		if(!empty($this->labels)) {
			$table->label($this->labels);
		}
		if($this->left_fields != ""){
			$table->add_row_class($this->left_fields,'xcrud-half-row left-field');
		}
		if($this->right_fields != ""){
			$table->add_row_class($this->right_fields,'xcrud-half-row right-field');
		}
		if($this->required_fields != ""){
			$table->validation_required($this->required_fields);
		}
		
		if(!empty($this->theme_config)) {
			foreach($this->theme_config as $key=>$value){
				$table->custom_theme_config($key,$value);
			}
		}
		
		$table->before_insert('before_insert',$this->this_file);
		$table->after_insert('after_insert',$this->this_file);
		$table->after_update('after_update',$this->this_file);
		
		$this->setting($table);
		
//		if($this->price_fields != ""){
//			$table->change_type($this->price_fields,"price","",array('decimals'=>3,'prefix'=>'BD '));
//		}
		
		root::price_type($table, $this->price_fields);
		
		return $table;
	}
	
	protected function setting(&$table){
		
	}
	
	public function add($render=true) {
		$table = Xcrud::get_instance();
		$table->table($this->table_name);
		$table->table_name($this->new_title);
		$table->hide_button("save_return,save_new,return,new");
		$table->set_lang("save_edit","Save");
		$this->initialize($table);
		if($render){
			return $table->render('create');
		}else{
			return $table;
		}
	}

	public function listing($render=true) {
		$table = Xcrud::get_instance();
		$table->is_selectable = $this->selectable;
		$table->table($this->table_name);
		$table->table_name($this->list_title);
		$table->unset_view();
		$table->unset_add();
		$table->unset_edit();
		$this->initialize($table);
		if(!$this->remove){
			$table->unset_remove();
		}
		if($this->edit){
			$table->button("?{$this->table_name}={{$this->primary}}","edit","glyphicon glyphicon-edit","btn-warning");
		}
		if($this->view){
			$table->button("?{$this->table_name}={{$this->primary}}&view","Open","fa fa-search","btn-info");
		}
		
		if($render){
			return $table->render();
		}else{
			return $table;
		}
	}
	
	public function edit($id=0,$render=true) {
		if(!$this->edit){
			access_deny();
			return false;
		}
		$table = Xcrud::get_instance();
		$table->table($this->table_name);
		$table->table_name($this->edit_title);
		$table->unset_add();
		$table->unset_list();
		$table->unset_view();
		$table->hide_button("save_return,save_new,new,return");
		$table->set_lang("save_edit","Save");
		$this->initialize($table);
		if($render){
			return $table->render('edit',$id);
		}else{
			return $table;
		}
		
	}
	
	public function view($id=0,$render=true) {
		if(!$this->view){
			access_deny();
			return false;
		}
		$table = Xcrud::get_instance();
		$table->table($this->table_name);
		$table->table_name($this->edit_title);
		$table->unset_add();
		$table->unset_list();
		$table->unset_edit();
		$table->unset_remove();
		$table->hide_button("save_edit,save_return,save_new,new,return");
		$this->initialize($table);
		
		if($render){
			return $table->render('view',$id);
		}else{
			return $table;
		}
	}

}
