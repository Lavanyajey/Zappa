<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="white">
<div class="container">

	<div id="topbar">
		<?php if (!Yii::app()->user->isGuest): ?>
		<div class="mainmenu">
			<?php
				$username = Yii::app()->user->instance->email;
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>$username),
						array('label' => ' | '),
						array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::t('global', 'Logout'))
					),
				));
			?>
		</div><!-- mainmenu -->
		<?php endif; ?>
				
	</div><!-- topbar -->
	
	
    <div id="content">
		<div id="secondaryContainer">
			<div class="bg">
				<?php $this->pageTitle=Yii::app()->name . ' - Time Tracker / Productivity App'?>

				<div class="loginContainer">
					<h1>a corner for existing users <span class="heart">♥</span></h1>
					<?php $this->widget('user.widgets.login'); ?>
				</div>
				
				<div class="left">
					<div class="buttonContainer">
						<a href="<?php echo CHtml::normalizeUrl(array('/user/user/registration')); ?>" class="awesomeButton registerButton">Register</a>
					</div>
					
					<div class="descriptionContainer">
						<h1>super hyper personalised phone calls</h1>
						<p>Description...</p>
					</div>
				</div>
			</div>
		</div>
    </div>
    
</div><!-- page -->
</div>

<div id="footer">
	<div id="copyright">
		Copyright &copy; <?php echo date('Y'); ?> by Zappa Team. All Rights Reserved. <?php echo Yii::powered(); ?>
	</div><!-- copyright -->
</div><!-- footer -->
<?php $this->endContent(); ?>