<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('BASE_DIR', realpath('./'));

define('CORE', BASE_DIR . '/Core');
define('APP', BASE_DIR . '/App');

define('DEBUG', true);

if (DEBUG) {
	//error_reporting();
	ini_set('display_errors', 'On');
} else {
	ini_set('display_errors', 'Off');
}

require CORE . "/Sams.php";


spl_autoload_register('\Core\Sams::load');


core\Sams::run();
