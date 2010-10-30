<?php
if(!isset($model)) 
	$model = new YumUserLogin();
$this->pageTitle = $this->contentTitle = Yii::t("UserModule.user", "Login");
?>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
<div class="fields">
	<div class="row">
		<?php echo CHtml::activeLabel($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email') ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password') ?>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t("UserModule.user", "Login")); ?>
	</div>
	
	<div class="row">
	<p class="hint">
		<?php echo CHtml::link(Yii::t("UserModule.user", "Forgot password?"), $this->module->recoveryUrl); ?>
	</p>
	</div>
</div>
<?php echo CHtml::endForm(); ?>

</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'email'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
