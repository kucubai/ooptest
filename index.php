<?php

define('BASE_DIR', __DIR__);
define('DEBUG', true);


// framework autoload
require BASE_DIR . "/core/Application.php";
spl_autoload_register('core\Application::autoload');

// composer autoload
require BASE_DIR . "/vendor/autoload.php";

// Debug mode setting
if (DEBUG) {
	//error_reporting();
	ini_set('display_errors', 'On');
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
} else {
	ini_set('display_errors', 'Off');
}

core\Application::init(BASE_DIR)->run();
