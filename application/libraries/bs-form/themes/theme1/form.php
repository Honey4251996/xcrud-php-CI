<?php
if($this->title != ""){
	echo "<div class=\"bs-form-title\">{$this->title}</div>";
}
?>
<div <?php echo ($this->id != "")?"id=\"{$this->id}\" ":"";	 ?> class="bs-form <?php echo $this->getClass() ?>">
	<div class="bs-message" style="display:none">Test</div>
	<div class="row">
		<div class="col-xs-12 text-left">
			<a class="btn btn-default bs-submit" data-url="<?php echo $this->url; ?>" data-name="<?php echo $this->name; ?>">Save</a>
		</div>
	</div>
	<?php $this->renderFields(); ?>
</div>

