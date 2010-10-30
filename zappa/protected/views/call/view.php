<?php
$this->breadcrumbs=array(
	'Job Queues'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JobQueue', 'url'=>array('index')),
	array('label'=>'Create JobQueue', 'url'=>array('create')),
	array('label'=>'Update JobQueue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JobQueue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JobQueue', 'url'=>array('admin')),
);
?>

<h1>View JobQueue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'call_id',
		'phone',
		'time',
	),
)); ?>
