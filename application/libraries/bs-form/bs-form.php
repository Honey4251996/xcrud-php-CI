<?php
/**
 *
 * @author Ahmed Saif
 */
require_once "bs_config.php";

abstract class element{
	protected $class = array();
	protected $id = "";
	protected $attr = array();
	
	protected $output;
	
	public function setId($id=""){
		$this->id=$id;
	}
	
	public function addClass(...$classes){
		foreach($classes as $class){
			if($class != ""){
				$this->class = array_merge($this->class,explode(" ",$class));
			}
		}
	}
	
	public function getClass(){
		$out = "";
		if(!empty($this->class)){
			foreach($this->class as $class){
				$out .= " ".$class;
			}
		}
		return $out;
	}
	
	public function removeClass(...$classes){
		foreach($classes as $class){
			if($class != "" && in_array($class,$this->class)){
				unset($this->class[array_search($class,$this->class)]);
			}
		}
	}
	
	public function resetClass(){
		$this->class = array();
	}
	
	public function setAttr($attr,$value=null){
		if($attr != ""){
			$this->attr[$attr] = $value;
		}
	}
	
	public function removeAttr($attr){
		if($attr != ""){
			unset($this->attr[$attr]);
		}
	}
	
	public function resetAttr(){
		$this->attr = array();
	}
	
	public function getAttr($attr=""){
		if($attr != ""){
			return $this->attr[$attr];
		}else{
			$out = "";
			if(!empty($this->attr)){
				foreach($this->attr as $attr=>$value){
					if($value != null){
						$out .= " {$attr}=\"{$value}\"";
					}else{
						$out .= " {$attr}";
					}
				}
			}
			return $out;
		}
	}
	
	public abstract function prepare();
	
	public function render(){
		$this->prepare();
		echo $this->output;
	}
	
	public function toString(){
		$this->prepare();
		return $this->output;
	}
	
}

abstract class formElement extends element{
	protected $name;
	protected $value;
	
	public function setValue($value=""){
		$this->value=$value;
	}
	
	public function setName($name=""){
		$this->name=$name;
	}
	
	public function getValue($value=""){
		return $this->value;
	}
	
	public function getName($name=""){
		return $this->name;
	}
	
}

abstract class input extends formElement{
	protected $type;
	
	public function __construct($type="text",$name="",$value=""){
		$this->type = $type;
		$this->name = $name;
		$this->value = $value;
	}
	
	public function prepare(){
		$out="";
		$out .= "<input type =\"{$this->type}\" ";
		$out .= ($this->name != "")?"name=\"{$this->name}\" ":"";
		$out .= ($this->value != "")?"value=\"{$this->value}\" ":"";
		$out .= ($this->id != "")?" id=\"{$this->id}\" ":"";
		$out .= "class=\"{$this->getClass()}\" ";
		$out .= $this->getAttr();
		$out .= "/>";
		$this->output = $out;
	}
}

class textInput extends input{
	public function __construct($name="",$value=""){
		parent::__construct("text",$name,$value);
	}
}

class hiddenInput extends input{
	public function __construct($name="",$value=""){
		parent::__construct("hidden",$name,$value);
	}
}

class passwordInput extends input{
	public function __construct($name="",$value=""){
		parent::__construct("password",$name,$value);
	}
}

class fileInput extends input{
	public function __construct($name="",$value=""){
		parent::__construct("file",$name,$value);
	}
}

class radioInput extends input{
	protected $list;
	
	public function __construct($name,$value,$list=array()){
		parent::__construct("radio",$name,$value);
		$this->list = $list;
	}
	
	public function prepare(){
		$out = "";
		if(!empty($this->list)){
			foreach($this->list as $key=>$value){
				$checked = ((string) $key == (string) $this->value);
				$out .= "<div class=\"radio\">";
				$out .= "<label>";
				$out .= "<input type=\"radio\" ";
				$out .= ($this->name != "")?"name=\"{$this->name}\" ":"";
				$out .= "value=\"{$key}\" ";
				//$out .= ($data["id"] != "")?" id=\"{$data["id"]}\" ":"";
				$out .= "class=\"{$this->getClass()}\"";
				$out .= ($checked)?"checked ":"";
				$out .= $this->getAttr();
				$out .= "/> ";
				$out .= $value."</label>";
				$out .= "</div>";
			}
		}
		$this->output = $out;
	}
}

class checkboxInput extends input{
	protected $list;
	
	public function __construct($name,$value,array $list=array()){
		if(count($name) != count($list)){
			trigger_error("Name and List must be with same length", E_USER_ERROR);
		}
		parent::__construct("checkbox",$name,$value);
		$this->list = $list;
	}
	
	public function prepare(){ 
		$out = "";
		if(!empty($this->list)){
			$names = is_array($this->name)?$this->name:array($this->name);
			foreach($this->list as $key=>$value){
				$name = current($names);
				$checked = false;
				if(is_array($this->value)){
					$checked = (in_array((string) $key,array_map('strval',$this->value)));
				}else{
					$checked = ((string) $key == (string) $this->value);
				}
				$out .= "<div class=\"checkbox\">";
				$out .= "<label>";
				$out .= "<input type=\"checkbox\" ";
				$out .= ($name != "")?"name=\"{$name}\" ":"";
				$out .= "value=\"{$key}\" ";
				//$out .= ($data["id"] != "")?" id=\"{$data["id"]}\" ":"";
				$out .= "class=\"{$this->getClass()}\"";
				$out .= ($checked==true)?"checked ":"";
				$out .= $this->getAttr();
				$out .= "/> ";
				$out .= $value."</label>";
				$out .= "</div>";
				next($names);
			}
		}
		$this->output = $out;
	}
}

Class selectList extends formElement{
	protected $list;
	
	public function __construct($name="",$value="",$list=""){
		$this->name = $name;
		$this->value = $value;
		$this->list = $list;
	}
	
	public function prepare(){
		$out = "";
		if(!empty($this->list)){
			$out .= "<select ";
			$out .= ($this->name != "")?"name=\"{$this->name}\" ":"";
			$out .= ($this->id != "")?" id=\"{$this->id}\" ":"";
			$out .= "class=\"{$this->getClass()}\"";
			$out .= $this->getAttr();
			$out .= "/>";
				foreach($this->list as $key=>$value){
					if(is_array($this->value)){
						$selected = in_array($key, $this->value);
					}else{
						$selected = ($key == $this->value);
					}
					$out .= "<option value=\"{$key}\" ";
					$out .= ($selected)?"selected ":"";
					$out .= ">{$value}</option>";
				}
			$out .="</select>";
		}
		$this->output =  $out;
	}
}

Class textarea extends formElement{
	public function __construct($name="",$value=""){
		$this->name = $name;
		$this->value = $value;
	}
	
	public function prepare(){
		$out = "";
		$out .= "<textarea ";
		$out .= ($this->name != "")?"name=\"{$this->name}\" ":"";
		$out .= ($this->id != "")?" id=\"{$this->id}\" ":"";
		$out .= "class=\"{$this->getClass()}\"";
		$out .= $this->getAttr();
		$out .= "/>";
		$out .= $this->value;
		$out .="</textarea>";
$this->output =  $out;
	}
}

class imageInput extends fileInput{
	protected $noImagePath =  NOIMAGEURL;
	protected $path = IMAGEURL;
	protected $upload_file = UPLOADFILE;
	protected $max_size = IMAGEMAXSIZE;
	
	public function __construct($name="",$value=""){
		parent::__construct($name,$value);
		$this->setAttr('data-maxsize',$this->max_size);
		$this->setAttr('data-path',$this->path);
		$this->setAttr('data-upload',$this->upload_file);
	}
			
	public function setPath($path){
		$this->path = $path;
	}
	
	public function prepare() {
		ob_start(); ?>
		<div class="bs-container bs-file-container">
			<div>
				<img class="bs-preview-image" 
				src ="<?php echo ($this->value == "")? $this->noImagePath : $this->path.$this->value ;?>" 
				data-noimage="<?php echo $this->noImagePath;?>"/>
			</div>
			<br>
			<div class="text-center">
				<a class='bs-select-image btn btn-success'>Select Image</a>
				<a class='bs-remove-image btn btn-danger'>Remove Image</a>
<!--				<a class='upload btn btn-info disabled'>Upload</a>-->
			</div>
			<input type="hidden" class="image-value <?php echo $this->getClass();?>" name="<?php echo $this->name; ?>" value="<?php echo $this->value; ?>"/>
			<?php $this->removeClass('bs-input'); ?>
			<input class="bs-file bs-image <?php echo $this->getClass();?>" accept="image/jpeg,image/png" 
			type="<?php echo $this->type; ?>"
			<?php echo $this->getAttr(); ?> 
			style='display: none'/>
		</div>
		<?php
		$this->output = ob_get_contents();
		ob_end_clean();
	}
}

class formGroup extends element{
	
	protected $formElement;
	protected $label;
	
	public function __construct($label="",$formElement) {
		if(!is_subclass_of($formElement,"formElement")){
			trigger_error("Second arrgement should be a form Element", E_USER_ERROR);
		}
		$this->label = $label;
		$this->formElement = $formElement;
		$this->addClass("form-group");
	}
	
	public function prepare(){
		$out="";
		$out .= "<div ";
		$out .= ($this->id != "")?" id=\"{$this->id}\" ":"";
		$out .= "class=\"{$this->getClass()}\" ";
		$out .= $this->getAttr();
		$out .= ">";
		if($this->label != ""){
			$out .= "<label>{$this->label}</label>";
		}
		$out .= $this->formElement->toString();
		$out .= "<div class='bs-validation-message ".$this->formElement->getName()."'></div>";
		$out .= "</div>";
		$this->output = $out;
	}
}

class horizontalFormGroup extends formGroup{
	protected $labelClass;
	protected $fieldClass;

	public function __construct($label="",$formElement,$labelClass="col-md-2",$fieldClass="col-md-10") {
		parent::__construct($label,$formElement);
		$this->labelClass = $labelClass;
		$this->fieldClass = $fieldClass;
	}
	
	public function prepare(){
		$out="";
		$out .= "<div ";
		$out .= ($this->id != "")?" id=\"{$this->id}\" ":"";
		$out .= "class=\"{$this->getClass()}\" ";
		$out .= $this->getAttr();
		$out .= ">";
		$out .= "<label class=\"{$this->labelClass} control-label\">{$this->label}</label>";
		$out .= "<div class=\"{$this->fieldClass}\">";
		$out .= $this->formElement->toString();
		$out .= "<div class='bs-validation-message ".$this->formElement->getName()."'></div>";
		$out .= "</div>";
		$out .= "</div>";
		$this->output = $out;
	}
}

class form extends element{
	
	const NORMAL = 0;
	const HORIZONTAL = 1;
	const INLINE = 2;
	protected $typeClass = [
		self::NORMAL=>"form",
		self::HORIZONTAL=>"form-horizontal",
		self::INLINE=>"form-inline"
	];
	protected $groupMethod = [
		self::NORMAL=>"formGroup",
		self::HORIZONTAL=>"horizontalFormGroup",
		self::INLINE=>"formGroup"
	];

	protected $name;
	protected $url;
	protected $serial;
	protected $type;
	protected $title ="";
	
	protected $fields = array();
	
	protected static $next = 0;
	
	public function __construct($type = self::NORMAL,$name='',$url="") {
		$this->type = $type;
		$this->name = $name;
		$this->url = $url;
		$this->serial = hash('sha1',self::$next);
		self::$next++;
	}
	
	public function setType($type =self::NORMAL){
		$this->type = $type;
	}
	
	public function title($title=""){
		$this->title = $title;
	}
	
	public function addField($title,$formElement,$label="") {
		if(is_subclass_of($formElement,"formElement")){
			$field = $formElement;
			$field->addClass("bs-input");
		}else{
			trigger_error("Second arrgement should be an array or form Element", E_USER_ERROR);
		}
		if($label == ""){
			$label = ucfirst($title);
			$label = str_replace("_"," ",$label);
		}
		$this->fields[$title] = array("label"=>"$label","field"=>$field);
	}
	
	public function removeField($title) {
		if(isset($this->fields[$title])){
			unset($this->fields[$title]);
		}
	}
	
	public function labels($labels=array()){
		if(is_array($labels)){
			foreach($labels as $field=>$label){
				if(isset($this->fields[$field])){
					$this->fields[$field]['label'] = $label;
				}
			}
		}
	}
	
	public function fieldId($id="",$field){
		if(isset($this->fields[$field]["field"])){
			$this->fields[$field]["field"]->setId($id);
		}
	}
	
	public function fieldClass($class="",$replace=false,...$fields){
		if(!empty($fields)){
			foreach($fields as $title){
				if(isset($this->fields[$title]['field'])){
					if($replace){
						$this->fields[$title]['field']->resetClass();
						$this->fields[$title]['field']->addClass("bs-input");
					}
					$this->fields[$title]['field']->addClass($class);
				}
			}
		}else{
			foreach($this->fields as $title=>$field){
				if($replace){
					$this->fields[$title]['field']->resetClass();
					$this->fields[$title]['field']->addClass("bs-input");
				}
				$this->fields[$title]['field']->addClass($class);
			}
		}
	} 
	
	public function fieldAttr($attr=array(),$replace=false,...$fields){
		if(!empty($fields)){
			foreach($fields as $title){
				if(isset($this->fields[$title]['field'])){
					if($replace){
						$this->fields[$title]['field']->resetAttr();
					}
					foreach($attr as $key=>$value){
						$this->fields[$title]['field']->setAttr($key,$value);
					}
				}
			}
		}else{
			foreach($this->fields as $title=>$field){
				if($replace){
					$this->fields[$title]['field']->resetAttr();
				}
				foreach($attr as $key=>$value){
					$this->fields[$title]['field']->setAttr($key,$value);
				}
			}
		}
	}
	
	public function groupId($id,$field){
		if(isset($this->fields[$field])){
			$this->fields[$field]["id"] = $id;
		}
	}
	
	public function groupClass($class="",$replace=false,...$fields){
		if(!empty($fields)){
			foreach($fields as $title){
				if(isset($this->fields[$title])){
					if($replace || !isset($this->fields[$title]['class'])){
						$this->fields[$title]['class'] = $class;
					}else{
						$this->fields[$title]['class'] .= " ".$class;
					}
				}
			}
		}else{
			foreach($this->fields as $title=>$field){
				if($replace || !isset($this->fields[$title]['class'])){
					$this->fields[$title]['class']= $class;
				}else{
					$this->fields[$title]['class'] .= " ".$class;
				}
			}
		}
	} 
	
	public function groupAttr($attr=array(),$replace=false,...$fields){
		if(!empty($fields)){
			foreach($fields as $title){
				if(isset($this->fields[$title])){
					if($replace){
						$this->fields[$title]['attr'] = $attr;
					}else{
						$this->fields[$title]['attr'] = array_merge($this->fields[$title]['attr'],$attr);
					}
				}
			}
		}else{
			foreach($this->fields as $title=>$field){
				if($replace){
					$this->fields[$title]['attr'] = $attr;
				}else{
					$this->fields[$title]['attr'] = array_merge($this->fields[$title]['attr'],$attr);
				}
			}
		}
	}
	
	public function setHorizontalClasses($labelClass,$fieldClass,...$fields){
		if(!empty($fields)){
			foreach($fields as $field){
				$this->fields[$field]["labelClass"] = $labelClass;
				$this->fields[$field]["fieldClass"] = $fieldClass;
			}
		}else{
			foreach($this->fields as $field=>$value){
				$this->fields[$field]["labelClass"] = $labelClass;
				$this->fields[$field]["fieldClass"] = $fieldClass;
			}
		}
	}
	
	public function prepare(){
		$this->removeClass(...array_values($this->typeClass));
		$this->addClass($this->typeClass[$this->type]);
		ob_start();
		require BS_PATH."/themes/".bs_config::$theme."/form.php";
		$this->output = ob_get_contents();
		ob_end_clean();
	}
	
	protected function renderFields(){
		foreach($this->fields as $group){
			$arrg = [$group['label'],$group['field']];
			if($this->type == self::HORIZONTAL && isset($group['labelClass']) && isset($group['fieldClass'])){
				$arrg[] = $group["labelClass"];
				$arrg[] = $group["fieldClass"];
			}
			$field = new $this->groupMethod[$this->type](...$arrg);
			if(isset($group['id'])){
				$field->setId($group['id']);
			}
			if(isset($group['class'])){
				$field->addClass($group['class']);
			}
			if(isset($group['attr'])){
				foreach($group['attr'] as $key=>$value){
					$field->setAttr($key,$value);
				}
			}
			$field->render();
		}
	}
	
}