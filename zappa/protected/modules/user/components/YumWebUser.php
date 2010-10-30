<?php

Yii::import('application.modules.user.core.*');

class YumWebUser extends CWebUser
{
	private $user;
	public $loginUrl='/login';

/*
	public function init() {
		// parse route and replace all placeholders with relative route
		$this->loginUrl=array(YumHelper::route($this->loginUrl));
		parent::init();
	}
*/
	
	public function isAdmin() {
		if($this->isGuest)
			return false;
		else {
			$user = $this->loadUser();
			if($user->superuser==1) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function getInstance() {
		return $this->loadUser(Yii::app()->user->id);
	}
	
	function getDemo() {
		$user = $this->loadUser();
		return Yii::app()->user->id==Yii::app()->params->demoUserId;
	}
	
	protected function loadUser($id=null) {
		if($this->user===null) {
			if($id!==null) {
				$this->user = YumUser::model()->findByPk($id);
			}
		}
		return $this->user;
	}
}
?>
