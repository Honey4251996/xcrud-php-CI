<?php echo $this->render_table_name(); ?>
<?php if($this->detail_buttons_position[0] == 'both' || $this->detail_buttons_position[0] == 'up'): ?>
<div class="xcrud-top-actions btn-group <?php echo($this->detail_buttons_position[1] == 'right')?'pull-right':''; ?>">
    <?php 
    echo $this->render_button('save_return','save','list','btn btn-default','','create,edit');
    echo $this->render_button('save_new','save','create','btn btn-default','','create,edit');
    echo $this->render_button('save_edit','save','edit','btn btn-default','','create,edit');
	//echo $this->render_button('edit','edit','','btn btn-default','','view'); 
	//echo $this->render_button('save_view','save','view','btn btn-default','','create,edit');
	echo $this->render_button('new','create','','btn btn-default','','create,edit');
	echo $this->render_button('return','list','','btn btn-default'); 
	if($this->custom_save !=false){
		echo '<a class="btn btn-default '.$this->custom_save.'">Save</a>';
	}
	?>
</div>
<?php endif; ?>
<div class="xcrud-view">
<?php echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table')) : $this->render_fields_list($mode,'div','div','label','div'); ?>
</div>
<?php if($this->detail_buttons_position[0] == 'both' || $this->detail_buttons_position[0] == 'down'): ?>
<div class="xcrud-top-actions btn-group <?php echo($this->detail_buttons_position[1] == 'right')?'pull-right':''; ?>">
    <?php 
    echo $this->render_button('save_return','save','list','btn btn-default','','create,edit');
    echo $this->render_button('save_new','save','create','btn btn-default','','create,edit');
    echo $this->render_button('save_edit','save','edit','btn btn-default','','create,edit');
	//echo $this->render_button('edit','edit','','btn btn-default','','view'); 
	//echo $this->render_button('save_view','save','view','btn btn-default','','create,edit');
	echo $this->render_button('new','create','','btn btn-default','','create,edit');
	echo $this->render_button('return','list','','btn btn-default'); 
	if($this->custom_save != false){
		echo '<a class="btn btn-default '.$this->custom_save.'">Save</a>';
	}
	?>
</div>
<?php endif; ?>
<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div>
