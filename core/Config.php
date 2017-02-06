<?php

namespace core;

/**
 * Description of Config
 *
 * @author kucubai
 */
class Config implements \ArrayAccess {

	const DEFAULT_CONFIG_DIR = BASE_DIR . '/configs';

	protected $path = '';
	protected $configs = array();

	public function __construct($path = self::DEFAULT_CONFIG_DIR) {
		$this->path = $path;
	}

	public function offsetExists($key) {
		return isset($this->configs[$key]);
	}

	public function offsetGet($key) {

		if (empty($this->configs[$key])) {

			$config_file = $this->path . '/' . $key . '.php';
			if (is_file($config_file)) {
				$this->configs[$key] = require $config_file;
			}
		}
		return $this->configs[$key];
	}

	public function offsetSet($key, $value) {

		return $this->configs[$key] = $value;
	}

	public function offsetUnset($key) {
		unset($this->configs[$key]);
	}

}
