<?php

class YumUserIdentity extends CUserIdentity
{
	private $id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIVE=4;
	const ERROR_STATUS_BANNED=5;

	public function authenticate($encryptedPassword=false) {
		$user=null;

		$user = YumUser::model()->findByAttributes(array('email'=>$this->username));

		$password = $encryptedPassword ? $this->password : YumUser::encrypt($this->password);

		if($user===null) {
			$this->errorCode=self::ERROR_EMAIL_INVALID;
		} elseif ($password!==$user->password) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} elseif ($user->status == 0 && UserModule::$allowInactiveAcctLogin==false) {
			$this->errorCode=self::ERROR_STATUS_NOTACTIVE;
		} elseif($user->status==-1) {
			$this->errorCode=self::ERROR_STATUS_BANNED;
		} else {
			$this->id=$user->id;
			$this->setState('id', $user->id);
			$this->username=$user->email;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->id;
	}

	public function getRoles() {
		return $this->Role;
	}

}
