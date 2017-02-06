<?php

namespace core;

/**
 * Description of Sams
 *
 * @author kucubai
 */
class Application {

	public $config;

	public $base_dir = '';
	public $app_dir = '';
	public $config_dir = '';
	
	protected static $classMap = array();
	protected static $instance;

	protected function __construct($base_dir) {
		$this->base_dir = $base_dir;
		//$this->config = new Config();
		//$db = $this->config['database'];
	}

	static public function init($base_dir = ''){
		if (empty(self::$instance)) {
			self::$instance = new self($base_dir);
		}
		return new self($base_dir);
	}

	static function getInstance() {
		return self::$instance;
	}

	static public function run() {

		self::dispacher();
	}

	static public function dispacher(){
		//dump($_SERVER);
		$request_url = $_SERVER['REQUEST_URI'];

		$parse_url = parse_url($request_url);

		/*
		array:2 [
			  "path" => "/home/abc/index/aaa/bbb"
			  "query" => "abc=test&t=1"
		]
		 */

		$url = ltrim($parse_url['path'], '/');
		$param = $parse_url['query'];

		list ($controller_name, $action_name) = explode('/', $url);
		parse_str($param, $params);

		$app = self::getInstance();
		$controller_class_name = ucfirst($controller_name);

		$controller_file = "$app->base_dir/app/controllers/" . $controller_class_name . '.php';

		if(is_file($controller_file)){
			$controller_class = 'app\\controllers\\' . $controller_class_name;
			$controller = new $controller_class;
			return $controller->$action_name();
		}else{
			dump($controller_file);
		}

	}

	static public function autoload($class) {

		$app = self::getInstance();

		if (isset(self::$classMap[$class])) {
			return true;
		} else {
			$class_file = $app->base_dir  
				. DIRECTORY_SEPARATOR
				. str_replace('\\', DIRECTORY_SEPARATOR, $class)
				. ".php";
			if (is_file($class_file)) {
				require $class_file;
			} else {
				// My Excetpion
				dump($class_file);
				throw new Exception('Can not load '. $class_file);
				return false;
			}

			self::$classMap[$class] = $class_file;
			return true;
		}
	}
	protected function __clone() { }

}

