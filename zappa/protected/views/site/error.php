<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->layout = 'main';
?>

<div style="text-align:center; margin:30px;">
	<h2>Error <?php echo $code; ?></h2>
	<div class="error">
	<?php echo CHtml::encode($message); ?>
	</div>
</div>