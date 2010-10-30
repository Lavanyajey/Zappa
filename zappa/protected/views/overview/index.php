<?php $this->pageTitle=Yii::app()->name. ' - Overview' ?>

<div id="OverviewFilter" class="form">
<?php echo CHtml::beginForm(array('/overview'),'get'); ?>
<table>
	<tr>
		<td>
			<label>From</label>
			<?php echo CHtml::textField('OverviewForm[start_time]',  $form->getFormattedStartTime(), array('id'=>'datepicker_start', 'class'=>'datepicker')); ?>
		</td>
		<td class="to">
			<label>To</label>
			<?php echo CHtml::textField('OverviewForm[end_time]',  $form->getFormattedEndTime(), array('id'=>'datepicker_end', 'class'=>'datepicker')); ?>
		</td>
		<td rowspan="2" style="text-align:center; width:200px">
			<img src="<?php echo Yii::app()->baseUrl?>/images/icons/chart_64.png" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label>Keywords</label>
			<?php echo CHtml::activeTextField($form, 'keywords'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label>Tags</label>
			<?php echo CHtml::activeTextField($form, 'tags', array('autocomplete'=>'off')); ?>
		</td>
		<td>
			<input class="button" type="submit" value="Filter" />
		</td>
	</tr>
</table>
<?php echo CHtml::endForm(); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'overview',
    'dataProvider' => $dataProvider,
    'columns'=>array(
		array(
			'class'=>'CLinkColumn',
            //'name'=>'start_time',
            'header'=>'Date',
            'labelExpression'=>'Activity::t2s("Y m d", $data->start_time)',
			'urlExpression'=>'CHtml::normalizeUrl("activities/#".Activity::t2s("Y/m/d", $data->start_time));'
        ),
        array(
            'name'=>'start_time',
            'header'=>'Time',
            'value'=>'Activity::t2s("H:i", $data->start_time)." - ".Activity::t2s("H:i", $data->end_time)',
        ),
		'duration',
        'title',
        'description',
        '_tags'
    ),
	'cssFile'=>'css/gridview.css',
	'template'=>'{items}{summary}{pager}'
)); ?>

<div style="text-align:center; margin-top:50px; font-size:120%;">
Total duration of these activities:
<?php
	if ($totalDuration >= 0) {
		echo Activity::model()->formatDuration($totalDuration/60, true);
	} else {
		echo 'Oops.';
	}
?>
</div>

<div>
<table style="width:500px; margin:20px auto;">
<?php 
	foreach($stats as $row) {
		echo '<tr style="border-bottom:1px solid #aaa;"><td style="padding-left:10px;">'. $row['name'] .'</td><td>'. Activity::model()->formatDuration($row['duration']/60) .'</td></tr>';
	}
?>
</table>
</div>
 
<?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerJqueryUI();
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery.notification.js');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery-autocomplete/jquery.autocomplete.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery-autocomplete/jquery.autocomplete.js');
?>
<script type="text/javascript">
	$(':submit').button();
</script>

<script type="text/javascript">

	var Statistics = function() {
		var init = function() {
		    $("#datepicker_start").datepicker({
		        dateFormat: "yy/mm/dd",
		        showButtonPanel: true,
		        closeText: "Close",
		        showAnim: "",
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        showWeek: true
		    });
		    $("#datepicker_end").datepicker({
		        dateFormat: "yy/mm/dd",
		        showButtonPanel: true,
		        closeText: "Close",
		        showAnim: "",
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        showWeek: true
		    });
		};

	    return {
			init : init
		};
	    
	}();
	
	Statistics.init();
    
</script>
<script type="text/javascript">
var settings = {
	tags: <?php echo json_encode(Tag::model()->suggestTags(''));?>
};
Chilla.Overview.init(settings);
</script>