<?php

class Helper {
    public static function redirect($url,$terminate=true,$statusCode=302) {
	    if(is_array($url))	{
		    $route = isset($url[0]) ? $url[0] : '';
            $url = Yii::app()->createUrl(trim($route,'/'),array_splice($url,1),'&');
	    }
	    Yii::app()->getRequest()->redirect($url,$terminate,$statusCode);
    }
}
