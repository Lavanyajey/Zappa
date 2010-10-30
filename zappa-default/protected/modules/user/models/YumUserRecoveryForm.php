<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'YumUserController'.
 */
class YumUserRecoveryForm extends YumFormModel {
	public $email, $user_id;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array(
			// username and password are required
			array('email', 'required'),
			array('email', 'email'),
			// password needs to be authenticated
			//array('email', 'checkexists'),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array(
			'email'=>Yii::t("UserModule.user", "Your email address"),
		);
	}
	
	public function checkexists() {
		if(!$this->hasErrors()) {
			$user = YumUser::model()->findByAttributes(array('email'=>$this->email));

			if($user === null) {
				$this->addError("email",Yii::t("UserModule.user", "Email is incorrect."));
				return false;
			} else {
				$this->user_id = $user->id;
				return true;
			}
		}
	}

}
