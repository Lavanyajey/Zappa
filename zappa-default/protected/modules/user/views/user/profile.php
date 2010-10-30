<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t('UserModule.user', "Settings");?>
<h2><?php echo Yii::t('UserModule.user', 'Account settings'); ?></h2>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="flashMessage" style="display:none"><?php echo Yii::app()->user->getFlash('profileMessage'); ?></div>
<?php endif; ?>


<?php if (Yii::app()->user->demo==false): ?>
<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('timezone_id')); ?></th>
    <td><?php echo CHtml::encode($model->timezone->label); ?> <?php echo CHtml::link(Yii::t('UserModule.user', 'Change timezone'),array('edit')); ?></td>
</tr>

<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('password')); ?></th>
    <td><?php echo CHtml::link(Yii::t('UserModule.user', "Change password"),array("changepassword")); ?></td>
</tr>
</table>
<?php else: ?>
You can't modify settings in the demo account.
<?php endif; ?>

<?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-plugins/jquery.notification.js');
?>
<script type="text/javascript">
    $('.flashMessage').each(function() {
    	$.notification.display({
            msg: $(this).html()
        });
    });
</script>