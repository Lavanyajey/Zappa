<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'YumUserController'.
 */

Yii::import('application.modules.user.components.YumUserIdentity');

class YumUserLogin extends YumFormModel
{
	public $email;
	public $password;
	public $rememberMe;

	public function rules() {
		return array(
			array('email, password', 'required'),
			array('rememberMe', 'boolean'),
			array('password', 'authenticate'),
		);
	}

	public function attributeLabels() {
		return array(
			'email'=>Yii::t("UserModule.user", "Email"),
			'password'=>Yii::t("UserModule.user", "Password"),
			'rememberMe'=>Yii::t("UserModule.user", "Remember me next time"),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params) {
		if(!$this->hasErrors()) {  // we only want to authenticate when no input errors
			$identity=new YumUserIdentity($this->email,$this->password);
			$identity->authenticate();
			switch($identity->errorCode) {
				case YumUserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration);
					break;
				case YumUserIdentity::ERROR_EMAIL_INVALID:
					$this->addError("email",Yii::t("UserModule.user", "Email is incorrect."));
					break;
				case YumUserIdentity::ERROR_STATUS_NOTACTIVE:
					$this->addError("status",Yii::t("UserModule.user", "Your account is not activated. Please check your email."));
					break;
				case YumUserIdentity::ERROR_STATUS_BANNED:
					$this->addError("status",Yii::t("UserModule.user", "Your account is blocked."));
					break;
				case YumUserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password",Yii::t("UserModule.user", "Password is incorrect."));
					break;
			}
		}
	}
}
