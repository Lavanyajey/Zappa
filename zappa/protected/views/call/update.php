<?php
$this->breadcrumbs=array(
	'Job Queues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JobQueue', 'url'=>array('index')),
	array('label'=>'Create JobQueue', 'url'=>array('create')),
	array('label'=>'View JobQueue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JobQueue', 'url'=>array('admin')),
);
?>

<h1>Update JobQueue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>