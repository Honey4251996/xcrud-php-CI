<?php 
	$settings = get_settings();
?>
<div class="header">
	<div class="pull-left" style="width:35%;padding-top: 5px">
		<p class="line" style="font-size: 22px;line-height: 27px"><b><?php echo isset($settings['company_name'])?$settings['company_name']:""; ?></b></p>
		<p class="line" style="font-size: 14px"></p>
	</div>
	<div class="pull-left" style="width:30%">
	<?php if(isset($settings['company_logo']) && $settings['company_logo'] != ""): ?>
		<img id="logo" src="<?php echo IMAGEURL.$settings['company_logo'] ?>" style="width:100%;">
	<?php endif; ?>
	<p class="text-center" style="font-size: 8px; margin:5px 0px;"></p>
	</div>
	<div class="pull-right text-right" style="width:35%;padding-top: 5px">
		<p class="line" style="font-size: 16px;line-height: 20px">Tel:<?php echo isset($settings['company_tel'])?$settings['company_tel']:""; ?></p>
	</div>
	<div class="clearfix"></div>
</div>

