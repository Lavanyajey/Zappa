<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action 
 * of 'UserController'.
 */

class YumUserChangePassword extends YumFormModel 
{
	public $password;
	public $oldPassword;

	public function rules() {
		return array(
			array('oldPassword', 'required', 'on'=>'edit-settings'),
			array('password', 'required'),
			array('password', 'length', 'max'=>128, 'min' => 4,
				'message' => Yii::t("UserModule.user", "Incorrect password (minimal length 4 symbols).")),
			array('oldPassword', 'verifyOldPassword', 'on'=>'edit-settings'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array(
			'password'=>Yii::t("UserModule.user", "New password"),
			'oldPassword'=>Yii::t("UserModule.user", "Old password"),
		);
	}
	
	public function verifyOldPassword($attribute, $params) {
		$user = YumUser::model()->findByPk(Yii::app()->user->id);
		if ((strcmp(YumUser::encrypt($this->oldPassword), $user->password)!==0)) {
            $this->addError('oldPassword', Yii::t("UserModule.user", "The old password is incorrect."));
		}

	}
} 
