<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-queue-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($call); ?>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
  </div>

	<div class="row">
		<?php echo $form->label($call,'message'); ?>
		<?php echo $form->textArea($call,'message',array('rows'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($call,'zipcode'); ?>
		<?php echo $form->textField($call,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($call,'joke'); ?>
		<?php echo $form->checkBox($call,'joke'); ?>
  </div>

	<div class="row">
		<?php echo $form->label($call,'news'); ?>
		<?php echo $form->checkBox($call,'news'); ?>
  </div>

  <div class="row">
		<?php echo $form->label($model,'timezone_id'); ?>
		<?php echo $form->dropDownList($model,'timezone_id', CHtml::listData(Timezone::model()->findAll(), 'id', 'label'), array('empty'=>'')); ?>
  </div>

	
	<div class="row">
		<?php echo $form->label($call,'closing_message'); ?>
		<?php echo $form->textArea($call,'closing_message',array('rows'=>8)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
