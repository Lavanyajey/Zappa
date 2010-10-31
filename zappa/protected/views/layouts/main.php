<!doctype html> 
<html lang="en"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<!-- YUI CSS Reset and Base -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset/reset-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/base/base-min.css">
<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400&subset=latin' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light&subset=latin' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Neucha&subset=latin' rel='stylesheet' type='text/css'>
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
	
	<?php echo $content; ?>

<script type="text/javascript">
	Zappa.visuals();
</script>

</body>
</html>