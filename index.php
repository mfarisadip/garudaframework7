<?php

/**
 * Garuda Framework
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2018, Muhammad Faris Adi Prabowo
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package Garuda Framework
 * @author  Muhammad Faris Adi Prabowo
 * @copyright Copyright (c) 2018, Muhammad Faris Adi Prabowo
 * @copyright Copyright (c) 2017, Lamhot Simamora
 * @license https://opensource.org/licenses/MIT MIT License
 * @link  https://dokumentasi.mfaris16.com.com
 * @since Version 1.0.0
 * @filesource
 */

( session_status() == PHP_SESSION_NONE) ? session_start() : false;

defined('sys_run_app') or define('sys_run_app','a2b3c4d5e6d7f8g9hivvf2dasdasd') ;


if (! function_exists("_phpVersion"))
{
	function _phpVersion($t=null)
	{
		return ($t==null) ? (float) phpversion() : phpversion();
	}
}
if (! function_exists("_checkPHP"))
{
	function _checkPHP()
	{
		if (_phpVersion() < 7.0)
		{
		    exit("Minimum <font color='red'> PHP Version 7.0</font>");
		}
	}
}
_checkPHP();

defined('__APP_PATH__') or define('__APP_PATH__',  __DIR__."/") ;

class ConfigEnv
{ 
	private static $data,$filename = '.config-garuda',$path,$db_mysql,$db_postgre;

	public static function set($path){
		self::$path = $path;
	}

	public static function extract(){
		(file_exists(self::$path.self::$filename)) ? self::do() : exit('File ".config-garuda" is not found !');
	}

	public static function do(){
		$file   = fopen(self::$path.self::$filename, "r");
		$data   = fread($file,filesize(self::$path.self::$filename));
		fclose($file);
		$obj = json_decode($data);
		if (!$obj)
		{
			trigger_error('<strong> File configuration ['.self::$filename.']</strong> 
						   is not valid ! Configuration should be as a JSON ! 
						   If you want to get new configuration file, 
						   visit this link <a href="https://goo.gl/Qot2FY">https://goo.gl/Qot2FY</a>');
			exit;
		}
		try {
			//=======================================
			$GLOBALS['dir_name'] = $obj->{'dir_name'};
			//=======================================
			$image_base64       = $obj->{'image_base64'};
			$GLOBALS['error']   = $image_base64->{'error'};
			$GLOBALS['warning'] = $image_base64->{'warning'};
			$GLOBALS['notice']  = $image_base64->{'notice'};
			// =============================================
			$msg  = $obj->{'message_upload'};

			$GLOBALS['file_empty']     = $msg->{'file_empty'};
			$GLOBALS['upload_max']     = $msg->{'upload_max'};
			$GLOBALS['upload_exist']   = $msg->{'upload_exist'};
			$GLOBALS['upload_success'] = $msg->{'upload_success'};
			$GLOBALS['upload_failed']  = $msg->{'upload_failed'};
			$GLOBALS['upload_ignore']  = $msg->{'upload_ignore'};
			$GLOBALS['upload_image']   = $msg->{'upload_image'};
			// =============================================
			$add        = $obj->{'additional'};
			// =============================================
			$GLOBALS['maintenance']          = $add->{'maintenance'};
			$GLOBALS['start_benchmark']      = $add->{'start_benchmark'};
			$GLOBALS['error_handling']       = $add->{'error_handling'};
			$GLOBALS['max_execution_time']   = $add->{'max_execution_time'};
			$GLOBALS['log_framework']        = $add->{'log_framework'};
			$GLOBALS['cookie_name']          = $add->{'cookie_name'};
			$GLOBALS['file_maintenance']     = $add->{'file_maintenance'};
			$GLOBALS['time_zone']            = $add->{'time_zone'};
			$GLOBALS['notice_error']         = $add->{'notice_error'};
			$GLOBALS['multi_language']       = $add->{'multi_language'};
			$GLOBALS['cookie_multi_language']= $add->{'cookie_multi_language'};
			// =============================================
			$email        = $obj->{'email'};
			$GLOBALS['_email_config_a2makas0di2emnkajd9mnh2232mo2jm22jem21e2e']  = array(
				'host'		=>	$email->{'host'},
				'username'	=>	$email->{'username'},
				'password'	=>	$email->{'password'},
				'port'		=>	$email->{'port'},
				'secure'	=>	$email->{'secure'}
			);
			// =============================================
			self::$db_mysql     = $obj->{'database_mysql'};
			self::$db_postgre   = $obj->{'database_postgresql'};
		} 
		catch (Exception $e) 
		{
			trigger_error('Uppzz ! Something is wrong with file configuration ! ',$e);
			exit;
		}
	}
	public static function getDbMySQL()
	{
		return self::$db_mysql;
	}
	public static function getDbPostGre()
	{
		return self::$db_postgre;
	}
}

ConfigEnv::set(__APP_PATH__);
ConfigEnv::extract();

$path 		= array(
/*
*  File Name
*/	
'GF_System'			=> 'GF_System',
'GF_Text'           => 'GF_Text',
'GF_Production'		=> 'GF_Production',
'GF_Helper'			=> 'GF_Helper',
'GF_Image_Error'	=> 'GF_error',
'GF_Anonymous' 		=> 'GF_Anonymous',
'GF_Html' 			=> 'GF_HTML',
'GF_Index'          => 'index',
'GF_Interface'      => 'GF_Interface',
'GF_404'			=> '404',
'GF_401'            => '401',
'GF_Query'         	=> 'GF_Query',
'GF_Error'			=> 'GF_Error',
'GF_Config' 		=> 'config',
'GF_Validation'	    => 'validation',

/*
*  Directory Name
*/
'GF_Config_DIR'		=> 'config/',
'GF_System_DIR'     => 'system/',
'GF_Storage_DIR'	=> 'storage/',
'GF_APP_DIR'    	=> 'app/',
'GF_Router_DIR' 	=> 'router/',
'GF_Controler_DIR'  => 'controller/',
'GF_Helper_DIR'		=> 'helper/',
'GF_Library_DIR'	=> 'library/',
'GF_Model_DIR'      => 'model/',
'GF_DB_DIR'         => 'driver-db/',
'GF_Language_DIR'   => 'language/',
'GF_View_DIR'       => 'view/',
'GF_External_DIR'	=> 'external/',
'GF_Log_DIR'        => 'log/',
'GF_Migration_DIR' 	=> 'migration/', 
'GF_Error_View'     => '_system/error/',
'GF_Image_Base64'	=> 'image-base-64/',
'GF_Cache_DIR'    	=> 'cache/',
'GF_View_T_DIR'    	=> 'view-template/',
'GF_Validation_DIR'	=> 'validation/'
);


$ext  = array(	
'PHP' 	=> ".php",
'HTML' 	=> ".html",
);

$index  = 'index.php';

defined('__ext_php__') or define('__ext_php__', $ext['PHP']);

$err = $path['GF_System_DIR'].$path['GF_Error'].__ext_php__;

if (file_exists($err))
{
	require_once $err;

	$sys = $path['GF_System_DIR'].$path['GF_Helper'].__ext_php__;
	if (file_exists($sys))
	{
		
		if (! function_exists("_def"))
		{
			function _def($key=null,$value=null)
			{
				  if (is_array($key) && is_array($value)) {if (count($key)==count($value)) {for ($i=0; $i < count($key) ; $i++) {defined($key[$i]) or define($key[$i], $value[$i]); } }else{return false; } }else{defined($key) or define($key, $value); } 
			}
		}
		_def('_RTC_','=>');
		isset($_SERVER['PATH_INFO']) ? _def('_____STR_URL_____',$_SERVER['PATH_INFO']) : _def('_____STR_URL_____',false);
	
		_def('__GARUDA_FRAMEWORK_ERROR_HANDLING__',
			$GLOBALS['error_handling']
		);

		$GLOBALS['_validation_file_'] = $path['GF_Validation'];
		_def("__GF_Version__",'7.0');

		_def('__ext_html__', $ext['HTML']);

		_def('__STORAGE_DIR__', __APP_PATH__.$path['GF_APP_DIR'].$path['GF_Storage_DIR']) ;

		_def('__LOG_DIR__', __APP_PATH__.$path['GF_System_DIR'].$path['GF_Log_DIR']) ;

		_def('__MIGRATION_DIR__', __APP_PATH__.$path['GF_APP_DIR'].$path['GF_Migration_DIR']) ;

		_def('__SYSTEM_DIR__', __APP_PATH__.$path['GF_System_DIR']) ;

		_def('__VIEW_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_View_DIR']) ;

		_def('__CACHE_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Cache_DIR']) ;

		_def('__VIEW_TEMPLATE_DIR__',__CACHE_DIR__.$path['GF_View_T_DIR']) ;

		_def('__ROUTER_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Router_DIR']) ;

		_def('__CONTROLLER_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Controler_DIR']) ;

		_def('__VALIDATION_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Controler_DIR'].$path['GF_Validation_DIR']) ;

		_def('__LIBRARY_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Library_DIR']) ;

		_def('__MODEL_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Model_DIR']) ;

		_def('__HELPER_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Helper_DIR']) ;

		_def('__DB_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Config_DIR'].$path['GF_DB_DIR']) ;

		_def('__LANGUAGE_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Config_DIR'].$path['GF_Language_DIR']) ;

		_def('__ERROR_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_View_DIR'].$path['GF_Error_View']) ;

		_def('__CONFIG_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_Config_DIR']) ;

		_def('__EXTERNAL_DIR__',__APP_PATH__.$path['GF_APP_DIR'].$path['GF_External_DIR']);

		_def('__404_Page__',$path['GF_404']) ;

		_def('__401_Page__',$path['GF_401']) ;

		_def('__DIR_NAME__',$GLOBALS['dir_name']) ;

		_def("__img64_error__",$path['GF_Image_Base64'].$GLOBALS['error']);
		_def("__img64_warning__",$path['GF_Image_Base64'].$GLOBALS['warning']);
		_def("__img64_notice__",$path['GF_Image_Base64'].$GLOBALS['notice']);

		_def("_upload_empty_",$GLOBALS['file_empty']);
		_def("_upload_max_",$GLOBALS['upload_max']);
		_def("_upload_exist_",$GLOBALS['upload_exist']);
		_def("_upload_success_",$GLOBALS['upload_success']);
		_def("_upload_failed_",$GLOBALS['upload_failed']);
		_def("_upload_ignore_",$GLOBALS['upload_ignore']);
		_def("__upload_image__",$GLOBALS['upload_image']);

		require_once $sys;
		$sys = $path['GF_System_DIR'].$index;

		function setHead($file='',$data_1=null,$data_2=null)
		{
			return \System\GF_Router::setHead($file,$data_1,$data_2);
		}
		function setView($name=null,$data1=null,$data2=null)
		{
		    return \System\GF_Router::setView($name,$data1,$data2);
		}
		function directTo($val)
		{
			return \System\GF_Router::directTo($val);
		}
		function model($model)
		{
			return \System\GF_Router::importModel($model);
		}
		function library($library)
		{
			return \System\GF_Router::importLibrary($library);
		}
		function controller($val)
		{
			return \System\GF_Router::importController($val);
		}
		if (file_exists($sys))
		{
			/**
			 * Here we go !
			 */
			_generateToken();		
			require_once $sys;
		}
	}
}

