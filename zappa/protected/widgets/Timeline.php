<?php

Yii::import('zii.widgets.CPortlet');

class Timeline extends CWidget
{
	
	public $dataProvider;
	
	public function init()
	{		
		if($this->dataProvider===null)
			throw new CException('The "dataProvider" property cannot be empty.');
	}

	public function run()
	{
		$this->render('Timeline', array('dataProvider'=>$this->dataProvider));
	}
}