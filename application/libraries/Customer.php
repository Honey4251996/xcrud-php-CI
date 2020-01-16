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
class customer extends root {
	
	protected $table_name ="customers";
	protected $primary = "customer_id";
	protected $new_title = "New Customer";
	protected $edit_title = "Edit Customer";
	protected $list_title = "Customers";
	protected $buttons_position = array("up","left"); // both,up,down // left,right
	protected $selectable = false;
	protected $fields = "name,mobile_num,tel_num,building,road,block,area,remark";
	protected $columns = "name,mobile_num,tel_num,building,road,block,area,remark";
	protected $labels = array("name"=>"Customer Name","tel_num"=>"Telephone","mobile_num"=>"Mobile");
	
	protected $left_fields="mobile_num,building,block";
	protected $right_fields = "tel_num,road,area";
	protected $required_fields = "mobile_num";
	protected $price_fields = "";
	
	protected $this_file = __FILE__;
	protected $theme_config = array(
			'details_label_cell'=>'control-label col-sm-2 xcrud-label',
			'details_field_cell'=>'col-sm-10 xcrud-field'
		);
	
	protected function setting(&$table) {
		Xcrud_config::$manual_load=true;
		//$table->before_insert('before_insert',__FILE__);
		//$table->after_insert('after_insert',__FILE__);
		$table->no_editor('remark');
		$table->relation('area','areas','id','area_name');
		$table->set_attr('area',array('class'=>'xcrud-input searchable'));
		$table->subselect('Address',"CONCAT_WS('',if({building} = '','',CONCAT('<b>Building:</b> ',{building},' ')),"
				. "if({road} = '','',CONCAT('<b>Road:</b> ',{road},' ')),"
				. "if({block} = '','',CONCAT('<b>Block:</b> ',{block},'\n')),"
				. "if({area} = '','',CONCAT('<b>Area:</b> ',(SELECT `area_name` FROM `areas` WHERE `id` = {area}),'\n')),"
				. ")");
		if(!has_permission("Edit Customers")){
			$this->edit = false;
		}
	}
	
	public function create_dialog(){
		Xcrud_config::$manual_load=true;
		$this->fields = "customer,".$this->fields;
		$this->buttons_position = array("","");
		$table = parent::add(false);
		$table->unset_title();
		$table->hide_button('save_edit');
		$table->create_field('customer','text');
		$table->set_attr('name',array("data-name"=>"name"));
		$table->set_attr('mobile_num',array("data-name"=>"mobile_num"));
		$table->set_attr('tel_num',array("data-name"=>"tel_num"));
		$table->set_attr('building',array("data-name"=>"building"));
		$table->set_attr('address',array("data-name"=>"address"));
		$table->set_attr('remark',array("data-name"=>"remark"));
		$table->field_callback('customer','select_customer',__FILE__);
		$table->after_insert('after_insert2',$this->this_file);
		//$table->before_edit('before_edit',$this->this_file);
		return $table->render("create");
	}
	
}


function before_insert($postdata,$xcrud){
	if(trim($postdata->get('name')) == ""){
		$postdata->set("name","Customer - ".$postdata->get("mobile_num"));
	}
	$postdata->set("status",1);
	$postdata->set("created_by",  user_id());
	$postdata->set("created_at",  date("Y-m-d H:i:s"));
}

function after_insert($postdata,$id,$xcrud){
	$xcrud->set_message("Data Saved Successfully",'success');
	echo "<input type='hidden' class='xcrud-data' name='primary' value='{$id}' />";
	exit();
}

function select_customer($value, $field, $mode, $list, $xcrud){
	if(isset($list["primary_key"])){
		$id = $list["primary_key"];
	}else{
		$id = 0;
	}
ob_start();
?>
	<div>
	<select class="customer-selection form-control searchable xcrud-input" name='<?php echo xcrud_fieldname_encode("customer_id") ?>'>
		<option value="0">-- New --</option>
		<?php foreach (get_customers() as $row): ?>
		<option value="<?php echo $row['customer_id']; ?>" <?php echo ($row['customer_id'] == $id)?"selected":""; ?>><?php echo $row['name']." - Mob: ".$row['mobile_num']; ?></option>
		<?php endforeach; ?>
	</select>
	</div>
<?php
$output = ob_get_contents();
ob_end_clean();
return $output;
}
?>