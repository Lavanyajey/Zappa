<?php
$this->breadcrumbs=array(
	'Job Queues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JobQueue', 'url'=>array('index')),
	array('label'=>'Manage JobQueue', 'url'=>array('admin')),
);
?>

<h1>Create JobQueue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>