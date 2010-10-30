<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; ?>

<div id="loginForm" class="form">
<?php echo CHtml::beginForm(); ?>
	
	<?php //echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<label for="UserLogin_email">email</label>
		<?php echo CHtml::activeTextField($model,'email') ?>
		<?php echo CHtml::error($model, 'email'); ?>
	</div>
	
	<div class="row">
		<label for="UserLogin_password">password</label>
		<?php echo CHtml::activePasswordField($model,'password') ?>
		<?php echo CHtml::error($model, 'password'); ?>
	</div>
	
	<div class="row rememberMe"">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?> <label for="YumUserLogin_rememberMe" style="display:inline">stay logged in</label>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t('UserModule.user', "Login")); ?>
	</div>
	
	<div class="row lost">
		<p class="hint">
		<?php echo CHtml::link(Yii::t('UserModule.user', "Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
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

<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
    echo CGoogleApi::init();
    echo CHtml::script(CGoogleApi::load('jqueryui','1.8.0') . "\n");
?>