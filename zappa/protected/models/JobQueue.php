<?php

/**
 * This is the model class for table "{{job_queue}}".
 *
 * The followings are the available columns in table '{{job_queue}}':
 * @property integer $id
 * @property integer $call_id
 * @property integer $phone
 * @property string $time
 *
 * The followings are the available model relations:
 * @property JobQueue $call
 * @property JobQueue[] $jobQueues
 */
class JobQueue extends CActiveRecord
{
  public $timezone_id = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobQueue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{job_queue}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone, timezone_id', 'required'),
			array('time', 'validateTime'),
			array('id, call_id, phone, time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'call' => array(self::BELONGS_TO, 'Calls', 'call_id'),
			'timezone' => array(self::BELONGS_TO, 'Timezones', 'timezone_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'call_id' => 'Call',
			'phone' => 'Phone',
			'time' => 'Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('call_id',$this->call_id);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		parent::beforeSave();
		//$this->time = strtotime($this->time);
		$this->time = date('Y-m-d H:i:s', strtotime($this->time));
		return true;
	}
	
	public function validateTime($attribute, $params) {
		if (empty($this->time)) {
			$this->addError('time', 'Time cannot be blank');
			return false;
		}
		
		$now = time();
		$timestamp = strtotime($this->time);
		
		if (!$timestamp) {
			$this->addError('time', 'Invalid time');
			return false;
		}
		
		if ($timestamp > $now && $timestamp<($now+3*60)) {
			$this->addError('time', 'Time should be at least 3 minutes from now');
			return false;
		}
		
		if ($timestamp<$now) {
			$this->addError('time', 'You should provide a future time');
			return false;
		}
	}
}
