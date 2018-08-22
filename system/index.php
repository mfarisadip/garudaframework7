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
defined('sys_run_app') OR exit('403 - Access Forbidden');

_def('_GF_COOKIE_',$GLOBALS['cookie_name']);

if ($GLOBALS['notice_error'])
{
	error_reporting(E_ALL);
	set_error_handler("_errorHandleGF");
	set_exception_handler("_execptionHandleGF");
}else{
	error_reporting(0);
}

_importFile([
	$path['GF_Text'],
	$path['GF_Query'],
	$path['GF_System']
]);
// MYSQL Encrypt 

$lock_db  = new \System\GF_Encrypt_Decrypt;
$db_mysql = ConfigEnv::getDbMySQL();

$server = $db_mysql->{'server'};
$server = $lock_db->setValue($server)->encrypt();

$username = $db_mysql->{'username'};
$username = $lock_db->setValue($username)->encrypt();

$database = $db_mysql->{'database'};
$database = $lock_db->setValue($database)->encrypt();

$password = $db_mysql->{'password'};
$password = $lock_db->setValue($password)->encrypt();

$port = $db_mysql->{'port'};
$port = $lock_db->setValue($port)->encrypt();

$GLOBALS['_USERNAME_a1b2c312k312n23123k123n123_']  = $username;
$GLOBALS['_SERVER_a1b2c312k312n23123k123n123_']    = $server;
$GLOBALS['_DB_a1b2c312k312n23123k123n123_']        = $database;
$GLOBALS['_PASSWORD_a1b2c312k312n23123k123n123_']  = $password;
$GLOBALS['_PORT_a1b2c312k312n23123k123n123_']      = $port;

// MYSQL Encrypt 

$db_mysql  = $lock_db->setValue($GLOBALS['_DB_a1b2c312k312n23123k123n123_'])->decrypt();

$server    = $lock_db->setValue($GLOBALS['_SERVER_a1b2c312k312n23123k123n123_'])->decrypt();

// PDO Setting (Default MySQL)
$config_database['options']     =   array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$config_database['DSN']         =   'mysql:host='.$server .';dbname='.$db_mysql; 
// PDO Setting

$dsn  = $lock_db->setValue($config_database['DSN'])->encrypt();
$GLOBALS['_DSN_a1b2c312k312n23123k123n123_']       = $dsn;
$GLOBALS['_OPTION_a1b2c312k312n23123k123n123_']    = $config_database['options'];

unset($server,$db,$dsn,$lock_db,$config_database);

// POSTGRESQL Encrypt 
$lock_db  = new \System\GF_Encrypt_Decrypt;

$db_postgre = ConfigEnv::getDbPostGre();

$server   = $db_postgre->{'server'};
$server   = $lock_db->setValue($server)->encrypt();

$username = $db_postgre->{'username'};
$username = $lock_db->setValue($username)->encrypt();

$database = $db_postgre->{'database'};
$database = $lock_db->setValue($database)->encrypt();

$password = $db_postgre->{'password'};
$password = $lock_db->setValue($password)->encrypt();

$port    = $db_postgre->{'port'};
$port    = $lock_db->setValue($port)->encrypt();

$GLOBALS['_USERNAME_a1opwm2os0wn2msndi202jdmnasd3_']  = $username;
$GLOBALS['_SERVER_glaksi022jsmasdnasd02mlslslsl02_']  = $server;
$GLOBALS['_DB_kfo22nasns202n3msksodk22nikdjwjwo2m_']  = $database;
$GLOBALS['_PASSWORD_fk2o22nsd2j24bnsko22m3k2sj2io_']  = $password;
$GLOBALS['_PORT_pwk2j2n4nshifn3bekejmdndffkfdndfn_']  = $port;

// POSTGRESQL Encrypt 

\System\GF_Prepare::defineAllUrl(
	$path
);

_importFile(
	[$path['GF_System_DIR'].$path['GF_Html']]
);

_def('__production__',
	$GLOBALS['maintenance']
);

_def('__GF_Image_Error__',
	$path['GF_Image_Base64'].$path['GF_Image_Error'].__ext_php__
);

_def('__Time_Zone__',
	$GLOBALS['time_zone']
);

$GLOBALS['start_benchmark'] ? _def('__Time_Start__',_startMicroTime()) : '';

ini_set('max_execution_time', $GLOBALS['max_execution_time']);

_def('__GF_LOG__',
	$GLOBALS['log_framework']
);

! _checkCookie('_GF_COOKIE_') ? _createCookie('_GF_COOKIE_',_randomStr(35),2) : '';

unset($config_database);

\System\GF_Prepare::ready(
	array(
	    $GLOBALS['maintenance'],
	    $GLOBALS['file_maintenance']
	)
);
