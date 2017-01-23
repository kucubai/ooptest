<?php

namespace core;

/**
 * Description of Sams
 *
 * @author kucubai
 */
class Application {

	public $base_dir;
	public $config;
	protected static $classMap = array();
	protected static $instance;

	protected function __construct($base_dir) {
		$this->base_dir = $base_dir;
		//$this->config = new Config($base_dir . '/configs');

	}

	static function getInstance($base_dir = '') {
		if (empty(self::$instance)) {
			self::$instance = new self($base_dir);
		}
		return self::$instance;
	}

	public static function run() {

		new Route();
		echo 'start';
	}

	public static function autoload($class) {

		var_dump($class); echo '<hr>';
		if (isset(self::$classMap[$class])) {
			return true;
		} else {
			$class_file = BASE_DIR
				. DIRECTORY_SEPARATOR
				. str_replace('\\', DIRECTORY_SEPARATOR, $class)
				. ".php";
			if (is_file($class_file)) {
				require $class_file;
			} else {
				// My Excetpion
				throw new Exception('Can not load');
				return false;
			}

			self::$classMap[$class] = $class_file;
			return true;
		}
	}
	protected function __clone() { }

}

