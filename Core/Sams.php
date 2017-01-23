<?php

namespace Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sams
 *
 * @author kucubai
 */
class Sams {

	protected static $classMap = array();

	public static function run() {

		new Route();
		echo 'start';
	}

	public static function load($class) {

		if (isset($class[$class])) {
			return true;
		} else {
			$class_file = BASE_DIR 
				. DIRECTORY_SEPARATOR 
				. str_replace('\\', DIRECTORY_SEPARATOR, $class) 
				. ".php";
			if (is_file($class_file)) {
				require $class_file;
			} else {
				return false;
			}

			self::$classMap[$class] = $class_file;
			return true;
		}
	}

}
