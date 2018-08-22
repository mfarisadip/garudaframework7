<?php
defined('sys_run_app') OR exit('403 - Access Forbidden');

namespace Garuda\Controller;

use System\GF_Router as Garuda;

class my_controller extends Garuda
{
	public function index(){
		self::setView('home');
	}
}

