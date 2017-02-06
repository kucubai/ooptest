<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

/**
 * Description of Controller
 *
 * @author kucubai
 */
abstract class Controller {

	const DEFAULT_ACTION = "index";
	//const DEFAULT_VIEW_FOLDER = '';

	protected $controller_name;
	protected $action_name;
	protected $data = array();

	public function __construct($action_name = self::DEFAULT_ACTION, $controller_name = '') {

		$this->action_name = $action_name;

		//$controller_name = get_called_class();
		$controller_name = $controller_name ? $controller_name : get_called_class();
		$controller_names = explode("\\", $controller_name);
		$controller_name = array_pop($controller_names);
		$this->controller_name = strtolower($controller_name);

	}

	public function assign($key, $value) {

		$this->data[$key] = $value;
	}

	public function display($file = '') {

		$view_file = '';
		if(empty($file)){
			// home/index.php
			$app = Application::getInstance();
			//dump($this->controller_name);
			$view_file = "$app->base_dir/app/views/" . $this->controller_name . '/' . $this->action_name . '.php';
			$view_file = str_replace('\\', DIRECTORY_SEPARATOR, $view_file);
		}
		if(is_file($view_file)){
			extract($this->data);
			require $view_file;
			return true;
		}else{
			throw new Exception("Can not found view file: $view_name");
		}
	}

}
