<?php

class CallController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/main';
  
  public $jokes = array(
    '1' => array(
      '1' =>'A Horse goes into a bar and the bartender says "Hey buddy, Why the Long Face"',
      '2' =>' Where do you find a one legged dog?  Where you left it.',
      '3' =>'What do you get when you cross a vampire and a snowman? Frostbite.',
      '4' =>'Why did the vampire go to the orthodontist? To improve his bite.',
      '5' =>'1e',
    ),
    '2' => array(
      '1' =>'',
      '2' =>'',
      '3' =>'',
      '4' =>'',
      '5' =>'',
    ),
    '3' => array(
      '1' =>'',
      '2' =>'',
      '3' =>'',
      '4' =>'',
      '5' =>'',
    ),
    '4' => array(
      '1' =>'',
      '2' =>'',
      '3' =>'',
      '4' =>'',
      '5' =>'',
    ),
    '5' => array(
      '1' =>'',
      '2' =>'',
      '3' =>'',
      '4' =>'',
      '5' =>'',
    ),
    '6' => array(
      '1' =>'',
      '2' =>'',
      '3' =>'',
      '4' =>'',
      '5' =>'',
    ),
    '7' => array(
      '1' =>'7a',
      '2' =>'7b',
      '3' =>'7c',
      '4' =>'7d',
      '5' =>'7e',
    ),
  );
  
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('get', 'weather'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'create','update', 'delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobQueue']))
		{
			$model->attributes=$_POST['JobQueue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//if(Yii::app()->request->isPostRequest)
		//{
			// we only allow deletion via POST request
			$jobQueueModel = $this->loadModel($id);
			$jobQueueModel->call->delete();
			$jobQueueModel->delete();
			

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		//}
		//else
		//	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria(array(
			'order' => 't.time ASC',
            'limit' => -1,
			'with' => 'call',
			'condition' => 'call.status=0'
        ));
		$criteria->compare('call.user_id', Yii::app()->user->id, true);
        $dataProvider = new CActiveDataProvider('JobQueue', array(
			'criteria'=>$criteria,
			'pagination'=>false,
        ));
		
		$jobQueueModel = new JobQueue;
        $callModel = new Calls;
		
		if(isset($_POST['JobQueue'])) {
			$jobQueueModel->attributes=$_POST['JobQueue'];
			if ($jobQueueModel->validate()) {
				$callModel->message = $jobQueueModel->_message;
				$callModel->user_id = Yii::app()->user->id;
				if ($callModel->validate()) {
					$callModel->save();
					$jobQueueModel->call_id = $callModel->id;
					if ($jobQueueModel->save()) {
						$this->redirect(array('index'));
					} else {
						throw new CHttpException(400,'Oops. Fail whale.');
					}
				}
			}
		} else {
			$jobQueueModel->phone = Yii::app()->user->getInstance()->phone;
		}
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$jobQueueModel,
		));
	}
         /**
         * Get a call in XML Format
         */
    public function actionGet($id)
	{
		$model = Calls::model()->findByPk((int)$id);
		$message = $model->message;
    $postcode = $model->zipcode;
    $closing = $model['closing message'];
		$model->status=1;
		$model->save();
    $weather = $this->basicWeather($postcode);
    print_r($this->jokes[date('N')][rand(1,5)]);
		$this->renderPartial('get',array(
		  'message'=>$message,
      'weather'=>$weather,
      'closing'=>$closing,
		));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JobQueue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobQueue']))
			$model->attributes=$_GET['JobQueue'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=JobQueue::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-queue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
function FtoC($fah) {
  return round(($fah - 32)*5/9);
}  
  
  
  function getWeather($postCode) {



$requestAddress = "http://www.google.com/ig/api?weather=".$postCode;

$xml_str = file_get_contents($requestAddress,0);

$xml = new SimplexmlElement($xml_str);
    
    foreach($xml->weather as $item) {
        $location = $item->forecast_information->city['data'];
        if(isset($location)) {
          $today = array(
            'condition' => $item->current_conditions->condition['data'],
            'temp' => $this->FtoC($item->current_conditions->temp_f['data']),
            'humidity' => $item->current_conditions->humidity['data'],
            'wind' => $item->current_conditions->wind_condition['data'],
            'date' => $item->forecast_information->forecast_date['data'],
            'icon' => $item->current_conditions->icon['data'],
          );
          $count = 0;
          $future = array();
          foreach($item->forecast_conditions as $new) {
              $future[$count] = array(
                'dayOfWeek' => $new->day_of_week['data'],
                'lowTemp' => $this->FtoC($new->low['data']),
                'highTemp' => $this->FtoC($new->high['data']),
                'condition' => $new->condition['data'],
                'icon' => $new->icon['data'],
              );
              $count++;
              
          }
        }
    }
return array($location, $today, $future);
}
  
  function basicWeather($postcode) {
  $val = $this->getWeather($postcode);
  $location = $val['0'];
  $today = $val['1'];
  $ret;
  if(isset($location)) {
    $ret = 'Today in '. $location .' the weather condition is: '. $today['condition'].' with temperatures around '.$today['temp'].' degrees Celsius and '.$today['humidity'];
  }  
  else
    $ret = '';
    return $ret;
}
  
  function validLocation($postcode) {
    $val = $this->getWeather($postcode);
    if(isset($val['0']))
      return true;
    return false;
  }
  
  public function actionWeather($postcode) {
    echo $this->basicWeather($postcode);
  }
}
