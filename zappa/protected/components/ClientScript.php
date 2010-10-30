<?php
/**
 * ClientScript class file.
 */
class ClientScript extends CClientScript
{
	public $juiDefaultTheme = 'jquery-ui-theme';
	public $juiScriptFile = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js';
	public $juiCssFile = 'theme.css';
	//public $juiPathAlias = 'zii.vendors.jqueryui';

	public function registerJqueryUI($cssFile = '', $theme = '', $useI18n = false, $position=ClientScript::POS_HEAD)
	{
		if($cssFile === '') {
			$cssFile = $this->juiCssFile;
		}
		if($theme === '') {
			$theme = $this->juiDefaultTheme;
		}

		//$basePath = Yii::getPathOfAlias($this->juiPathAlias);
		$baseUrl = Yii::app()->baseUrl;//Yii::app()->getAssetManager()->publish($basePath, true);

		$scriptUrl = $baseUrl.'/js';
		$cssUrl = $baseUrl.'/css';

		$this->registerCssFile($cssUrl.'/'.$theme.'/'.$cssFile);
		$this->registerScriptFile($this->juiScriptFile, $position);
		if($useI18n) {
			$this->registerScriptFile($scriptUrl.'/'.$this->juiI18nScriptFile, $position);
		}
	}
}

?>