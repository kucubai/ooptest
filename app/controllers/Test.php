<?php

namespace app\controllers;
use core\Controller;

/**
 * Description of Home
 *
 * @author kucubai
 */
class Test extends Controller{

	//put your code here
	public function index(){

		$this->assign('name', 'sam');
		echo "<h1>".__FILE__."</h1>";
		//$this->display();
	}
}
