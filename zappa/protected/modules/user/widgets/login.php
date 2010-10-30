<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('application.components.Helper');

class login extends CPortlet {

    public function init() {
		//$this->title=CHtml::encode(Yii::app()->user->name);
		parent::init();
	}
	
	protected function renderContent() {
	    $model=new YumUserLogin;
		// collect user input data
		if(isset($_POST['YumUserLogin'])) {
			$model->attributes=$_POST['YumUserLogin'];
			// validate user input and redirect to previous page if valid
			if($model->validate()) {
				$lastVisit = YumUser::model()->findByPk(Yii::app()->user->id);
				$lastVisit->lastvisit = time();
				$lastVisit->save();
				$returnUrl = Yii::app()->user->getState('__returnUrl', UserModule::module()->returnUrl);
				//hardcoded the logout url here
				if ($returnUrl == 'user/logout') {
					$returnUrl = UserModule::module()->returnUrl;
				}
				Helper::redirect($returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model,));
	}

}
