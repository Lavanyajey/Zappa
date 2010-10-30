<?php

class YumUserController extends YumController
{
	const PAGE_SIZE = 10;
	private $_model;
	public $contentTitle = '';
	
	public function accessRules() {
		return array(
			array('allow',
				'actions'=>array('registration','login', 'recovery', 'activation', 'demo'),
				'users'=>array('?'),
			),
			array('allow',
				'actions'=>array('edit', 'logout', 'login', 'changepassword', 'profile', 'editprofile'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin'),
				'expression' => 'Yii::app()->user->isAdmin()'
			),
			array('deny',  // deny all other users
				'users'=>array('*'),
				),
			);
	}

	public function actions() {
		return UserModule::module()->allowCaptcha 
			? array(
				'captcha'=>array(
					'class'=>'CCaptchaAction',
					'backColor'=>0xFFFFFF,
				),
			)
			: array();
	}

	public function actionIndex() {
	    $this->redirect(array('/settings'));
	}

	/* 
	Registration of an new User in the system.
	Depending on whether $enableEmailActivation is set, a confirmation email or
	activation email will be sent to the user.
	*/
	public function actionRegistration() {
		$form = new YumUser;
		// User is already logged in?
		if (($uid = Yii::app()->user->id) === true) {
			$this->redirect(Yii::app()->homeUrl);
		} else {
			if(isset($_POST['YumUser'])) {
				$form->attributes = $_POST['YumUser'];
				if($form->validate()) {
					$user = new YumUser();
					if ($user->register($form->email, $form->password, $form->timezone_id)) {
						if(UserModule::module()->enableEmailActivation) {
							$this->sendActivationEmail($user);
						} else {
							$this->sendConfirmationEmail($user);
						}
						$this->sendNewUserNotificationToAdmin($user);
						
						if (UserModule::$allowInactiveAcctLogin && Yii::app()->user->allowAutoLogin) {
							$identity = new YumUserIdentity($form->email,$form->password);
							$identity->authenticate();
							Yii::app()->user->login($identity, 0);
							$this->redirect(UserModule::module()->returnUrl);
						} else {
							Yii::app()->user->setFlash('registration',
								Yii::t("UserModule.user",
									"Thank you! Further instructions have been sent to {email}. You can now close this window.",
									array('{email}'=>$user->email)));
							$this->refresh();
						}
					} else {
						Yii::app()->user->setFlash('registration',
							Yii::t("UserModule.user",
								"Your registration didn't work. Please contact our System Administrator at {adminEmail}",
								array('{adminEmail}'=>Yii::app()->params['adminEmail'])));
						$this->refresh();
					}
				}
			}
			$this->render('registration', array('form' => $form));
		}
	}

	public function actionLogin() {
		if (Yii::app()->user->id > 0) {
			$this->redirect(UserModule::module()->returnUrl);
		}
		
		$model=new YumUserLogin;
		// collect user input data
		if(isset($_POST['YumUserLogin'])) {
			$model->attributes=$_POST['YumUserLogin'];
			// validate user input and redirect to previous page if valid
			if($model->validate()) {
				$lastVisit = YumUser::model()->findByPk(Yii::app()->user->id);
				$lastVisit->lastvisit = time();
				$lastVisit->save();
				$this->redirect(UserModule::module()->returnUrl);
			}
		}
		// display the login form
		$this->render('/user/login',array('model'=>$model,));
	}

	public function actionLogout() {
		Yii::app()->user->logout();
    	$this->redirect(Yii::app()->homeUrl);
	}

	public function actionActivation ($email=null, $activationKey=null) {
		$activationStatus = YumUser::model()->activate($email, $activationKey);
		if($activationStatus==1) {
			$user = YumUser::model()->findByAttributes(array('email'=>$email));
			$identity = new YumUserIdentity($user->email,$user->password);
			$identity->authenticate(true);
			Yii::app()->user->login($identity, 0);
			Yii::app()->user->setFlash('success', Yii::t('UserModule.user', 'Your Account has been activated.'));
			$this->redirect(UserModule::module()->afterActivationUrl);
		} elseif ($activationStatus==2) {
			$this->render('message',array(
				'title'=>Yii::t("UserModule.user", "User activation"),
				'content'=>Yii::t("UserModule.user", 'Your account is already activated. Please go to the login page.')));
		} else {
			$this->render('message',array(
				'title'=>Yii::t("UserModule.user", "User activation"),
				'content'=>Yii::t("UserModule.user", "Incorrect activation link.")));
		}
	}

	public function actionChangepassword() {
		$form = new YumUserChangePassword('edit-settings');
		if(!Yii::app()->user->demo && isset($_POST['YumUserChangePassword'])) {
			$form->attributes = $_POST['YumUserChangePassword'];
			if($form->validate()) {
				$new_password = YumUser::model()->findByPk(Yii::app()->user->id);
				$new_password->password = YumUser::encrypt($form->password);
				$new_password->activationKey = YumUser::encrypt(microtime().$form->password);

				if($new_password->save()) {
					Yii::app()->user->setFlash('profileMessage',
						Yii::t("UserModule.user", "Your new password has been saved."));
					$this->redirect(array("/user/profile"));
				} else {
					Yii::app()->user->setFlash('profileMessage',
						Yii::t("UserModule.user", "There was an error saving your password."));
					$this->redirect(array("/user/profile"));
				}
			}
		}
		$this->render('changepassword',array('form'=>$form));
	}
	
	public function actionEmailchange() {
		if (isset($_GET['email']) && isset($_GET['activationKey']) && isset($_GET['new_email'])) {
			$email = $_GET['email'];
			$new_email = $_GET['new_email'];
			$activationKey = $_GET['activationKey'];
			$find = YumUser::model()->findByAttributes(array('email'=>$email));
			if($find
			   && $find->activationKey==$activationKey
			   && $new_email!=''
			   && $find->new_email==$new_email) {
				$find->email = $find->new_email;
				$find->new_email = '';
				$find->activationKey = YumUser::encrypt(microtime());
				$find->save();
				if (Yii::app()->user->isGuest) {
					$this->render('message',array(
						'title'=>Yii::t("UserModule.user", "Email change"),
						'content'=>Yii::t("UserModule.user", "Your email has been changed.")));
					return;
				} else {
					Yii::app()->user->setFlash('success',Yii::t("UserModule.user", "Your email has been changed."));
					$this->redirect(UserModule::module()->returnUrl);
				}
			}
		}
		$this->render('message',array(
			'title'=>Yii::t("UserModule.user", "Email change"),
			'content'=>Yii::t("UserModule.user", "Incorrect email change confirmation link."))
		);
	}

	public function actionRecovery() {
		$form = new YumUserRecoveryForm;
		$layout = $this->layout;

		// User is already logged in
		if (($uid = Yii::app()->user->id) === true) {
			$this->redirect(UserModule::module()->returnUrl);
		} else {
			if (isset($_GET['email']) && isset($_GET['activationKey'])) {
				$email = $_GET['email'];
				$activationKey = $_GET['activationKey'];
				$form2 = new YumUserChangePassword;
				$find = YumUser::model()->findByAttributes(array('email'=>$email));
				if($find->activationKey==$activationKey) {
					if(isset($_POST['YumUserChangePassword'])) {
						$form2->attributes=$_POST['YumUserChangePassword'];
						if($form2->validate()) {
							$find->password=YumUser::encrypt($form2->password);
							$find->activationKey=YumUser::encrypt(microtime().$form2->password);
							$find->save();
							Yii::app()->user->setFlash('loginMessage',Yii::t("UserModule.user", "Your new password has been saved."));
							$this->redirect(UserModule::module()->loginUrl);
						}
					}
					$this->render('recoverpassword',array('form'=>$form2));
				} else {
					Yii::app()->user->setFlash('recoveryMessage',Yii::t("UserModule.user", "Incorrect password recovery link."));
					$this->redirect('http://' . $_SERVER['HTTP_HOST'].$this->createUrl('user/recovery'));
				}
			} else {
				if(isset($_POST['YumUserRecoveryForm'])) {
					$form->attributes=$_POST['YumUserRecoveryForm'];

					if($form->validate()) {
						if ($form->checkexists()) {
							$user = YumUser::model()->findbyPk($form->user_id);
							
							$activation_url = $this->getActivationUrl($user, 'user/recovery');
							
							try {
							Yii::import('application.extensions.phpmailer.JPhpMailer');
							$mail = new JPhpMailer;
							$mail->AddAddress($user->email);
							$mail->Subject = Yii::t('UserModule.user', 'Password recovery');
							$mail->MsgHTML($this->render('/emails/password-recovery', array('activation_url'=>$activation_url), true));		
							$mail->Send();
							} catch (Exception $e) {
								//echo $e->getMessage(); //Boring error messages from anything else!
							}
						}

						Yii::app()->user->setFlash('recoveryMessage',Yii::t("UserModule.user", 'Further instructions have been sent to {email}', array('{email}' => $form->email)));
						$this->refresh();
					}
				}
				//this is needed, because sending email changes the layout
				$this->layout = $layout;
				$this->render('recovery',array('form'=>$form));
			}
		}
	}
	
	public function actionDemo() {
		$identity = new YumUserIdentity('chilla.robot@gmail.com','g~}$Q}<&w]+hbNKI@+*o5#x;1');
		$identity->authenticate();
		Yii::app()->user->login($identity, 0);
		$demoActivities = $this->createUrl(UserModule::module()->returnUrl[0]).'?demo';
		$this->redirect($demoActivities);
	}
	
	public function actionProfile() {
		$model = $this->loadUser();
	    $this->render('profile',array(
	    	'model'=>$model
	    ));
	}

	public function actionEdit() {
		$user = $this->loadUser();
		$user->setScenario('edit');
		if(!Yii::app()->user->demo && isset($_POST['YumUser'])) {
			$user->attributes=$_POST['YumUser'];
			if($user->validate()) {
				$user->save();
				Yii::app()->user->setFlash('profileMessage', "Settings were updated.");
				$this->redirect(array('/user/profile'));
			}
		}

		$this->render('edit',array(
			'user'=>$user
		));
	}
	
	public function actionAdmin() {
		$dataProvider=new CActiveDataProvider('YumUser', array(
			'pagination'=>array(
				'pageSize'=>self::PAGE_SIZE,
		)));

		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}
		
	public function sendActivationEmail($user) {
		$activation_url = $this->getActivationUrl($user, 'user/activation');
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->AddAddress($user->email);
		$mail->Subject = Yii::t('UserModule.user', 'Welcome to Teskaita! Activate your account.');
		$mail->MsgHTML($this->render('/emails/welcome_activation', array('activation_url'=>$activation_url), true));		
		$mail->Send();
		return true;
	}
	
	public function sendNewUserNotificationToAdmin() {
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->AddAddress(Yii::app()->params->adminEmail);
		$mail->Subject = 'New User!';
		$mail->MsgHTML($this->render('/emails/admin/new_user', array(), true));		
		$mail->Send();
		return true;
	}
	
	public function sendConfirmationEmail($user) {
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->AddAddress($user->email);
		$mail->Subject = Yii::t('UserModule.user', 'Welcome to Chinchilla!');
		$mail->MsgHTML($this->render('/emails/welcome_no_activation', null, true));		
		$mail->Send();
		return true;
	}
	
	public function sendEmailChangeEmail($user) {
		$activation_url = $this->getEmailChangeUrl($user, 'user/emailchange');
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->AddAddress($user->new_email);
		$mail->Subject = Yii::t('UserModule.user', 'Email change request');
		$mail->MsgHTML($this->render('/emails/email_change', array('activation_url'=>$activation_url), true));		
		$mail->Send();
		return true;
	}
	
	public function getActivationUrl($user, $action) {
		$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl($action,array(
			"activationKey" => $user->activationKey,
			"email" => $user->email));
		return $activation_url;
	}
	
	public function getEmailChangeUrl($user, $action) {
		$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl($action,array(
			"activationKey" => $user->activationKey,
			"email" => $user->email,
			"new_email" => $user->new_email));
		return $activation_url;
	}

	/**
	 * Loads the User Object instance
	 * @return YumUser
	 */
	public function loadUser($uid = 0) {
		if($this->_model === null) {
			if($uid != 0)
				$this->_model = YumUser::model()->findByPk($uid);
			else
				$this->_model = YumUser::model()->findByPk(Yii::app()->user->id);
			if($this->_model === null)
				throw new CHttpException(404,'The requested User does not exist.');
		}
		return $this->_model;
	}	
}
