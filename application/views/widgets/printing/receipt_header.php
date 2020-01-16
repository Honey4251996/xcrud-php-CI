<?php 
	$settings = get_settings();
?>
<?php if(isset($settings['company_logo']) && $settings['company_logo'] != ""): ?>
	<img id="logo" src="<?php echo IMAGEURL.$settings['company_logo'] ?>">
<?php endif; ?>
<?php if(isset($settings['receipt_header']) && $settings['receipt_header'] != ""):
	echo $settings['receipt_header'];
else: ?>
	<h3 class="text-center" style="font-size:24px;"><?php echo isset($settings['company_name'])?$settings['company_name']:""; ?></h3>
	<h4 class="text-center" style="font-size:20px;">Tel:<?php echo isset($settings['company_tel'])?$settings['company_tel']:""; ?></h4>
<?php endif; ?>

<?php echo $separator; ?>
<p class="text-center line" style="font-size:20px;"><?php echo $receipt_name ?></p>

