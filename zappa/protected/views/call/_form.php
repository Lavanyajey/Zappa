<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-queue-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'_message'); ?>
		<?php echo $form->textField($model,'_message'); ?>
		<?php echo $form->error($model,'_message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->