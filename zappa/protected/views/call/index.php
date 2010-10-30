<?php
$this->breadcrumbs=array(
	'Job Queues',
);

$this->menu=array(
	array('label'=>'Create JobQueue', 'url'=>array('create')),
	array('label'=>'Manage JobQueue', 'url'=>array('admin')),
);
?>

<h1>Job Queues</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
