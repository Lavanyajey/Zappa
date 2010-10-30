<!doctype html> 
<html lang="en"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<!-- YUI CSS Reset and Base -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset/reset-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/base/base-min.css">
<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400&subset=latin' rel='stylesheet' type='text/css'>
<!-- Zappa Styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/zappa.css" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="icon" type="image/png" href="/images/favicon.png" />	

<?php
Yii::app()->clientScript->scriptMap = array(
    'jquery.js'=>"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js",
);
?>
<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerJqueryUI();
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Zappa.js');
?>
</head>
<body>

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
		
		<div id="logo">
			<a href="<?php echo $this->createAbsoluteUrl('/'); ?>">Zappa</a>
		</div>
		
	</div><!-- topbar -->
	
	
    <div id="content">
		<div id="secondaryContainer">
			<div class="bg">
				<?php echo $content; ?>
			</div>
		</div>
    </div>
    
</div><!-- page -->
</div>
    
<div id="footer">
	
	<div id="copyright">
		Copyright &copy; <?php echo date('Y'); ?> by Zappa Team. All Rights Reserved. <?php echo Yii::powered(); ?>
	</div><!-- copyright -->
        
	<div class="addthis">
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style">
		<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=karolis" class="addthis_button_compact" addthis:ui_click="true" addthis:title="Chinchilla - Time Tracker / Productivity App" addthis:url="http://chilla.betterfly.lt">Share this website</a>
		</div>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=karolis"></script>
		<script type="text/javascript">
				var addthis_config = {
				//services_compact: 'email, facebook, twitter, more',
				services_exclude: 'print',
				services_compact: 'facebook, google reader, twitter, delicious, digg, google, myspace, live, stumbleupon, tumblr, favorites, more'
			}
		</script>
		<!-- AddThis Button END -->
	</div><!-- addthis -->
		
</div><!-- footer -->

</body>
</html>