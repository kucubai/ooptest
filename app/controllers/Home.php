<?php

namespace app\controllers;
use core\Controller;

/**
 * Description of Home
 *
 * @author kucubai
 */
class Home extends Controller{

	//put your code here
	public function index(){

		$this->assign('name', 'sam');
		$this->display();
		dump(__FILE__);
	}
}
