<?php

define('BASE_DIR', __DIR__);
define('DEBUG', true);


require BASE_DIR . "/core/Application.php";
spl_autoload_register(['core\Application', 'autoload'], TRUE, TRUE);

require BASE_DIR . "/vendor/autoload.php";

if (DEBUG) {
	//error_reporting();
	ini_set('display_errors', 'On');
	/*
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	 * 
	 */
} else {
	ini_set('display_errors', 'Off');
}


core\Application::getInstance(BASE_DIR)->run();

