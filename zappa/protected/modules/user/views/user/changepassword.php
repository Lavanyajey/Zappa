<?php $this->pageTitle=Yii::app()->name . ' - Change Password';?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
        <div class="row">
        <?php echo CHtml::activeLabel($form,'oldPassword'); ?>
        <?php echo CHtml::activePasswordField($form,'oldPassword', array('tabindex'=>1)); ?>
        <?php echo CHtml::label(Yii::t('UserModule.user', 'Show passwords'), 'showpassword', array('id'=>'label_showpassword')); ?>
        <?php echo CHtml::checkBox('showpassword'); ?>
        </div>
        <div class="row">
        <?php echo CHtml::activeLabel($form,'password'); ?>
        <?php echo CHtml::activePasswordField($form,'password', array('tabindex'=>2)); ?>
        </div>
        
        <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('UserModule.user', "Change"), array('tabindex'=>3)); ?>
		<a href="<?php echo CHtml::normalizeUrl(array('/user/profile')); ?>">Cancel</a>
        </div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery.showpassword-1.0.js'); ?>
<script type="text/javascript">
    $('#YumUserChangePassword_oldPassword, #YumUserChangePassword_password').showPassword('#showpassword');
</script>
