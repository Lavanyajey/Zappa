<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
  public $breadcrumbs = array();
  public $menu = array();
  public $layout='/layouts/_inside';
}