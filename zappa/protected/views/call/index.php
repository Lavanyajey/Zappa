<div id="createAlert">
<h1>Create an Alert</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div id="alertSchedule">
	<h1>Alert Schedule</h1>
	<div class="list">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'template'=>'{items}'
		)); ?>
	</div>
</div>

<div class="clearfloats"></div>

<div style="text-align:right;">
	<h2>Your phone number is <?php echo Yii::app()->user->getInstance()->phone; ?></h2>
</div>
