<?php

namespace Garuda\Controller;

defined('sys_run_app') OR exit('403 - Access Forbidden');

use System\GF_Router as Garuda;

class my_controller extends Garuda
{
	public function index(){
		self::setView('home');
	}
}

