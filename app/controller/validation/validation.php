<?php 
defined('sys_run_app') OR exit('403 You dont have permission to access / on this server...');

namespace Garuda\Validation;

use System\GF_Router;

class Base_Validation extends GF_Router
{
	private $result;
	
	public function __construct()
	{
		$this->result =  $this->run();
		return $this;
	}

	public function getResult()
	{
		return $this->result;
	}
}