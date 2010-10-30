<?php 
// Page title
$this->pageTitle = $this->contentTitle = Yii::t("UserModule.user", "Password recovery");
?>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="flash">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>
	<div class="fields">
		<div class="row">
			<?php echo CHtml::activeLabel($form,'email'); ?>
			<?php echo CHtml::activeTextField($form,'email') ?>
		</div>
		
		<div class="row submit">
			<?php echo CHtml::submitButton(Yii::t("UserModule.user", "Recover")); ?>
		</div>
	</div>
<?php echo CHtml::endForm(); ?>

</div><!-- form -->
<?php endif; ?>
