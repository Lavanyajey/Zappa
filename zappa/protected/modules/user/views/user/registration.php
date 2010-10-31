<?php 
// Page title
$this->pageTitle = $this->contentTitle = Yii::t("UserModule.user", "Registration");
?>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="flash">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form registration">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="fields">
	<div class="row">
	<?php echo CHtml::activeLabel($form,'email', array('label'=>'Your email')); ?>
	<?php echo CHtml::activeTextField($form,'email'); ?>
	</div>
	
	<div class="row">
	<?php echo CHtml::activeLabel($form,'password', array('label'=>'Create a password')); ?>
	<?php echo CHtml::activePasswordField($form,'password', array('autocomplete'=>'off')); ?>
	<?php echo CHtml::label(Yii::t('UserModule.user', 'Show password'), 'showpassword', array('id'=>'label_showpassword')); ?>
	<?php echo CHtml::checkBox('showpassword'); ?>
	</div>
	
	<?php if(extension_loaded('gd') && UserModule::module()->allowCaptcha): ?>
	<div class="row captcha">
		<?php echo CHtml::activeLabelEx($form,'verifyCode'); ?>
		<?php echo CHtml::activeTextField($form,'verifyCode'); ?>
		<p><?php echo Yii::t("UserModule.user","Please enter the letters as they are shown in the image above."); ?></p>
		<div>
		<?php $this->widget('CCaptcha', array('buttonLabel'=>Yii::t('global', 'Get a new image'))); ?>		
		</div>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t("UserModule.user", "Register")); ?>
	</div>
	</div>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery.showpassword-1.0.js'); ?>
<script type="text/javascript">
	$('#YumUser_password').showPassword('#showpassword');
</script>