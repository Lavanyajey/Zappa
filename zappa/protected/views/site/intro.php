<?php $this->pageTitle=Yii::app()->name . ' - Time Tracker / Productivity App'?>

	<div class="loginContainer">
		<h1>a corner for existing users <span class="heart">♥</span></h1>
		<?php $this->widget('user.widgets.login'); ?>
	</div>
	
	<div class="left">
		<div class="buttonContainer">
			<a href="<?php echo CHtml::normalizeUrl(array('/user/registration')); ?>" class="awesomeButton registerButton">Register</a>
		</div>
		
		<div class="descriptionContainer">
			<h1>super hyper personalised phone calls</h1>
			<p>Description...</p>
		</div>
	</div>
