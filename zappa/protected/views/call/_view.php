<div class="view">

	<?php echo CHtml::encode($data->time); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->call->message); ?>
	<br />
	<?php echo CHtml::link('Update', array('view', 'id'=>$data->id)); ?>
	<?php echo CHtml::link('Delete', array('delete', 'id'=>$data->id)); ?>

</div>