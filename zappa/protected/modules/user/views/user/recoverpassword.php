<?php 

$this->pageTitle = $this->contentTitle=Yii::t('UserModule.user', "Change password");
?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>
	
    <div class="fields">
        <div class="row">
        <?php echo CHtml::activeLabel($form,'password'); ?>
        <?php echo CHtml::activePasswordField($form,'password'); ?>
		<?php echo CHtml::label(Yii::t('UserModule.user', 'Show password'), 'showpassword', array('id'=>'label_showpassword')); ?>
        <?php echo CHtml::checkBox('showpassword'); ?>
        </div>
        
        <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('UserModule.user', "Change")); ?>
        </div>
    </div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery.showpassword-1.0.js'); ?>
<script type="text/javascript">
    $('#YumUserChangePassword_password').showPassword('#showpassword');
</script>
