<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Zappa',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.modules.user.*',
		'application.modules.user.core.*',
		'application.modules.user.models.*',
		'application.models.*',
		'application.components.*',
		'application.widgets.*'
	),

	'defaultController'=>'site/intro',
	
	'modules'=>array(
		'user'=>array(
            'returnUrl' => array('/')
        )
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => '/',
            'class' => 'application.modules.user.components.YumWebUser'
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=latentflip_zappa',
			'username' => 'latentflip_zappa',
			'password' => 'zappazappa123',
			'emulatePrepare' => true,
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			'enableProfiling'=>true,
			'enableParamLogging'=>true
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'user/<action:\w+>'=>'user/user/<action>',
				'login'=>'user/user/login',
				'logout'=>'user/user/logout'
				
				/*
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'activities'=>'activity/index',
				'activities/statistics'=>'activity/statistics',
				'login'=>'user/user/login',
				'logout'=>'user/user/logout'
				*/
            ),
        ),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'clientScript'=>array(
		    'class'=>'ClientScript',
		),
	),
	
	'modules'=>array(
		'user' => array(
			'layout' => 'application.views.layouts.main',
			//'adminLayout' => 'application.views.layouts._simple',
			'enableEmailActivation' => false,
			'allowInactiveAcctLogin' => true,
			'allowCaptcha' => false,
			'_urls' => array(
				'registration'=>array('user/registration'),
				'recovery'=>array('user/recovery'),
				'return'=>array('/activities'),
				'afterActivation'=>array('/activities'),
				'returnLogout'=>array('/'),
				'login'=>array('/'),
				'logout'=>array('/logout'),
				'profile'=>array('/user/profile')
	        ),
		),
		'gii' => array(
			'class'=>'system.gii.GiiModule',
			'password'=>'enter',
		)
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);

//debugging
$config['components']['log'] = array(
		'class'=>'CLogRouter',
		'routes'=>array(
			array(
				'class'=>'CFileLogRoute',
				'levels'=>'error, warning',                  
			),
			// uncomment the following to show log messages on web pages
			/*
			array(
				'class'=>'CWebLogRoute',
				'categories'=>'application, system.db.*'
			),
			*/
			array(
				'class' => 'ext.shiki.firePHPLogRoute.ShikiFirePHPLogRoute',
				'fbPath' => 'ext.shiki.firePHPLogRoute.FirePHPCore.fb',
				'categories'=>'system.db.*, application'
			)
		)
	);

return $config;
