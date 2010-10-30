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
			array('phone', 'required'),
			array('phone', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, call_id, phone, time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'call' => array(self::BELONGS_TO, 'JobQueue', 'call_id')
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
}