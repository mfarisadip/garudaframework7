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

use Query\GF_Query;
use GF_Database\Data_Table as DT;
use \System\GF_Encrypt_Decrypt as LockDB;
use GF_Database\Query_Builder;

class Postgresql
{
	protected $conn,$query,$db_execute,$store_data = array(),$count_data=null,$obj_gf_query;
	private   $server_information=null,$data_table  = null;

	use Query_Builder;

	public function __construct(){
		 $this->data_table = new DT;
		 $this->setConnection();
		 $this->connect();
	}

	private function setConnection()
	{
		$unlock_db  = new LockDB;
		$server = $unlock_db->setValue($GLOBALS['_SERVER_glaksi022jsmasdnasd02mlslslsl02_'])->decrypt();
		$username = $unlock_db->setValue($GLOBALS['_USERNAME_a1opwm2os0wn2msndi202jdmnasd3_'])->decrypt();
		$password = $unlock_db->setValue($GLOBALS['_PASSWORD_fk2o22nsd2j24bnsko22m3k2sj2io_'])->decrypt();
		$db = $unlock_db->setValue($GLOBALS['_DB_kfo22nasns202n3msksodk22nikdjwjwo2m_'])->decrypt();
		$port = $unlock_db->setValue($GLOBALS['_PORT_pwk2j2n4nshifn3bekejmdndffkfdndfn_'])->decrypt();

		$this->server_information =  "host=".$server 
									." port=".$port
									." dbname=".$db
									." user=".$username
									." password=".$password."";

		unset($server,$db,$port,$username,$password);
	}

	public function __destruct(){
	    //$this->close();
	}

	public function connect()
	{
		if (function_exists('pg_connect'))
		{
			if ($this->server_information != null)
			{
				$this->conn = pg_connect($this->server_information);
				$this->obj_gf_query = new GF_Query;
				return $this->conn;
			}else{
				return false;
			}
		}else{
			trigger_error("Upzz ! Sorry ! System can't found the function of 'pg_connect', maybe the extension of postgreSql is disabled !",E_USER_ERROR);
	        exit;		
		}
	}

	public function insert($tblname=null,$column1=null,$value1=null,
	                                $column2=false,$value2=false,
	                                $column3=false,$value3=false,
	                                $column4=false,$value4=false,
	                                $column5=false,$value5=false,
	                                $column6=false,$value6=false,
	                                $column7=false,$value7=false,
	                                $column8=false,$value8=false,
	                                $column9=false,$value9=false )
	{
		$query_result = $this->obj_gf_query->queryInsert($tblname,$column1,$value1,
				                                    $column2,$value2,
				                                    $column3,$value3,
				                                    $column4,$value4,
				                                    $column5,$value5,
				                                    $column6,$value6,
				                                    $column7,$value7,
				                                    $column8,$value8,
				                                    $column9,$value9);
		$this->query = $query_result;
		return $this->execute();
	}

	public function update($tblname=null,$parameter1=null,$value_parameter1=null,
	                            $column1=null,$value1=null,
	                            $column2=false,$value2=false,
	                            $column3=false,$value3=false,
	                            $column4=false,$value4=false,
	                            $column5=false,$value5=false,
	                            $column6=false,$value6=false,
	                            $column7=false,$value7=false,
	                            $column8=false,$value8=false,
	                            $column9=false,$value9=false)
	{
			$query_result = $this->obj_gf_query->queryUpdate($tblname,$parameter1,$value_parameter1,
										                                $column1,$value1,
										                                $column2,$value2,
										                                $column3,$value3,
										                                $column4,$value4,
										                                $column5,$value5,
										                                $column6,$value6,
										                                $column7,$value7,
										                                $column8,$value8,
										                                $column9,$value9);
			$this->query = $query_result;
		    return $this->execute();
	}

	public function delete($tblname=null,$column1=null,$value1=null,
	                                $column2=false,$value2=false,
	                                $column3=false,$value3=false,
	                                $column4=false,$value4=false)
	{
			$query_result = $this->obj_gf_query->queryDelete($tblname,$column1,$value1,
									                                    $column2,$value2,
									                                    $column3,$value3,
									                                    $column4,$value4);

			$this->query = $query_result;
		    return $this->execute();
	}

	public function getCount()
	{
		if (function_exists("pg_num_rows"))
		{
			$this->count_data = pg_numrows($this->db_execute);
			
			return $this->count_data;
		}
	}

	public function getData()
	{
		if ($this->query==null)
		{
			return false;
		}
		$r = $this->execute();
		return ($this->getCount()>0) ? pg_fetch_array($r, 0, PGSQL_NUM) : false;
	}

	public function setQuery($v)
	{
		$this->query = $v;
		return $this;
	}

	public function checkId($column=null, $tblname=null,
	                            $column1 =null , $value1=null,
	                            $column2 = false, $value2 = false,
	                            $column3 = false, $value3 = false
	                            )
	{
			$query_result = $this->obj_gf_query->queryCheckId($column, $tblname,
									                                $column1 , $value1,
									                                $column2,$value2,
									                                $column3,$value3 );
			$this->setQuery($query_result);
			$this->execute();
			return ($this->getCount()>0) ? true : false;
	}

	public function execute($query=null)
	{
		if (function_exists("pg_exec"))
		{
			$this->db_execute = ($query==null) ?  pg_exec($this->conn,$this->query) : pg_exec($this->conn,$query);
			return $this;
		}
	}

	public function getAllData()
	{

		if (function_exists("pg_fetch_array"))
		{
			$this->execute();
			$data = array();
			$count = pg_numrows($this->db_execute);
			
			for($i = 0; $i < $count; $i++) 
			{
			    $row = pg_fetch_array($this->db_execute, $i);
			   
			    $data[] = $row;
			 }
			 return $data;
		}else{
			return false;
		}
		
	}


	public function close()
	{
		if (function_exists("pg_close"))
		{
			pg_close($this->conn);
		}
	}
}

