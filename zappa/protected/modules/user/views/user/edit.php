<?php $this->pageTitle=Yii::app()->name . ' - Change Timezone';?>
<h2><?php echo 'Change timezone'; ?></h2>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="flashMessage">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">

<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($user);	?>
	  <div class="row">
			<?php echo CHtml::activeLabelEx($user,'timezone_id'); ?>
			<?php echo CHtml::activeDropDownList($user, 'timezone_id', CHtml::listData(Timezone::model()->findAll(), 'id', 'label')); ?>
			<?php echo CHtml::error($user,'timezone_id'); ?>
	  </div>

	  <div class="row buttons">
			<?php echo CHtml::submitButton('Save'); ?>
			<a href="<?php echo CHtml::normalizeUrl(array('/user/profile')); ?>">Cancel</a>
	  </div>
	
<?php echo CHtml::endForm(); ?>

</div><!-- form -->
<?php
	echo CGoogleApi::init();
    echo CHtml::script(CGoogleApi::load('jqueryui','1.8.0') . "\n");
	Yii::app()->clientScript->registerCoreScript('jquery');
?>
<script type="text/javascript">
    $(":submit").button();
</script>