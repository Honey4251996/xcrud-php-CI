<?php echo $this->render_table_name(); ?>
<!--div class="xcrud-top-actions btn-group">
    <?php /*
    echo $this->render_button('save_return','save','list','btn btn-primary','','create,edit');
    echo $this->render_button('save_new','save','create','btn btn-default','','create,edit');
    echo $this->render_button('save_edit','save','edit','btn btn-default','','create,edit');
	echo $this->render_button('edit','edit','','btn btn-default','','view'); 
	echo $this->render_button('save','save','view','btn btn-default','','create,edit');
	echo $this->render_button('return','list','','btn btn-warning'); 
	echo $this->render_button('cancel','view','','btn btn-warning','','edit');
	 */ ?>
</div-->
<div class="xcrud-view">
<?php echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table')) : $this->render_fields_list($mode,'div','div','label','div'); ?>
</div>
<?php /*<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div> */ ?>
