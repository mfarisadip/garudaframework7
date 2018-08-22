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
namespace GF_Database;

defined('sys_run_app') OR exit('403 - Access Forbidden');


trait Query_Builder
{
	public $table=null,$field,$cache_store_data;
	public $query_builder;

	public function table($v)
	{
		$this->table = $v;
		$this->query_builder .= 'from '.$v;
		return $this;
	}

	public function get($data=null)
	{
		if ($data==null)
		{
			$this->field = '*';
		}else{
			$last = count($data)-1;
			for ($i=0; $i < count($data) ; $i++) 
			{ 
				if ($i==$last)
				{
					$this->field .= $data[$i];
				}else{
					$this->field .= $data[$i].',';
				}
				
			}
		}
		$this->query_builder    = 'select '.$this->field.' '.$this->query_builder;
		return  $this->cache_store_data = $this->setQuery($this->query_builder)->getAllData();
	}

	public function where($data='',$like=null)
	{
		$_like =  ($like==null) ? "='" : " LIKE '%";
		$_endlike = ($like==null) ? "'" : "%'";
		if (is_array($data))
		{
			$where = '';
			$inc = 0;
			$last = count($data)-1;
			foreach ($data as $key => $value) 
			{
				if ($inc==$last)
				{
					$where .= $key.$_like.$this->casting($value).$_endlike;
				}else{
					$where .= $key.$_like.$this->casting($value).$_endlike.' and ';
				}
				$inc++;
			}
			$this->query_builder    = $this->query_builder.' where '.$where;
		}

		return $this;
	}

	private function casting($value)
	{
		return (is_int($value)) ?  $this->ifInteger($value) :  $this->ifString($value);
	}

	private function ifInteger($value)
	{
		return (int) $value;
	}

	private function ifString($value)
	{
		return (string) addslashes($value);
	}

	public function __toString()
	{
		return $this->cache_store_data;
	}

	public function json()
	{
		return json_encode($this->cache_store_data);
	}
}

class Data_Table
{
	use Query_Builder;
	
	protected $column=null;
	protected $fields=null;
	protected $database=null;
	protected $query=null;
	
	protected $primary_key;

	protected $username=null;

	protected function setUsername($v){
		$this->username = $v;
		return $this;
	}

	protected function setDatabaseName($v){
		$this->database = $v;
		return $this;
	}

	protected function setTableName($v){
		$this->table = $v;
		return $this;
	}

	

	protected function setQuery($v){
		$this->query = $v;
		return $this;
	}

	protected function setPrimaryKey($v){
		$this->primary_key = $v;
	}

	protected function getDatabase(){
		return $this->database;
	}

	protected function getTables(){
		return $this->table;
	}

	protected function getColumns(){
		return $this->column;
	}

	protected function getFields(){
		return $this->fields;
	}

	protected function _attachSqlite($v){
		return "ATTACH '".$v."' AS my_db;";
	}

	protected function _createDatabase($v){
		switch ($type) {
			case 'mysql':
				$q ="CREATE DATABASE ".$this->database."";
				break;
			case 'postgresql':
				$q = "CREATE DATABASE ".$this->database." WITH  OWNER = ".$this->username." ENCODING = 'UTF8'LC_COLLATE = 'English_United States.1252'LC_CTYPE = 'English_United States.1252' TABLESPACE = pg_default CONNECTION LIMIT = -1;"; 
				break;
			default:
				return null;
				break;
		}
		return $this;
	}
	
	protected function _tableNames($type='mysql'){
		if ($this->database!=null)
		{
			switch ($type) {
				case 'mysql':
					$q = "select TABLE_NAME,TABLE_TYPE,ENGINE 
					      FROM information_schema.tables 
					      WHERE table_schema='".$this->database."'";
					break;
				case 'sqlite':
					$q = 'select name FROM my_db.sqlite_master 
						  WHERE type="table";';
					break;
				case 'postgresql':
					$q = "select tablename FROM pg_catalog.pg_tables where schemaname != 'pg_catalog' and schemaname != 'information_schema'"; 
					break;
				default:
					return null;
					break;
			}
		    return $this;
		}else{
			return false;
		}
	}

	protected function _fieldNames($type='mysql'){
		if ($this->database !=null && $this->table != null)
		{
			switch ($type) {
				case 'mysql':
					$q = "select COLUMN_NAME 
						  from information_schema.COLUMNS 
						  WHERE TABLE_SCHEMA = '".$this->database."' 
						  and TABLE_NAME = '".$this->table."'";
					break;
				case 'sqlite':
					$q = "PRAGMA table_info(".$this->table.");";
					break;
				case 'postgresql':
					$q = "SELECT column_name FROM information_schema.columns 
					      WHERE table_name = '".$this->table."'";
					break;
				default:
					return null;
					break;
			}
			return $q;
		}else{
			return false;
		}
	}
}


if (! class_exists('GF_Migration'))
{
class GF_Migration extends Data_Table
{
    private $author='';
	private $type_database=null;
	private $export_query=null;

	public function setAuthor($v){
		$this->author = trim(strtoupper($v));
		return $this;
	}

	public function addFields(array $v){
		$this->fields = $v;
		return $this;
	}

	private function createTable()
	{
		    ($this->type_database==null) ? exit('Type of database is not set !') : '';
			switch ($this->type_database) 
			{
				case 'mysql':
					$i=0;
					$result='';
					$unique_enabled = false;
					$unique_result = "\n ALTER TABLE `".$this->table."` ";
					$primary_key_start = 0; 
					foreach ($this->fields as $key => $val) 
					{
						$field_name = $key;
						$type_data  = isset($val['type_data']) ? $val['type_data'] : '';
						$length     = isset($val['length']) ? $val['length'] : false;
						$null       = isset($val['not_null']) ? $val['not_null'] : false;
						$unsigned   = isset($val['unsigned']) ? $val['unsigned'] : false;
						$auto_increment  = isset($val['auto_increment']) ? $val['auto_increment'] : false;
						$primary_key   = isset($val['primary_key']) ? $val['primary_key'] : false;
						$unique      = isset($val['unique']) ? $val['unique'] : false;
						if ($unsigned)
						{
							$unsigned = "UNSIGNED";
						}else{
							$unsigned = str_replace(" ",'',$unsigned);
						}
						if ($null)
						{
							$null = 'NOT NULL';
						}
						else{
							$null = str_replace(" ",'',$null);
						}
						if ($auto_increment)
						{
							$auto_increment = 'AUTO_INCREMENT';
						}else{
							$auto_increment = str_replace(" ",'',$auto_increment);
						}
						if ($primary_key)
						{
							 $primary_key = 'PRIMARY KEY';
							 $primary_key_start = $primary_key_start +1;
						}else{
							$primary_key = str_replace(" ",'',$primary_key);
						}
						if ($length != false)
						{
							 $length = "(".$length.")";
						}else{
							$length = str_replace(" ",'',$length);
						}

						if ($unique)
						{
							$unique_enabled = true;
							if ($i < count($this->fields)-1)
							{
								$unique_result  .=  "\n ADD UNIQUE KEY `".$field_name."` (`".$field_name."`),";
							}else{
								$unique_result  .=  "\n ADD UNIQUE KEY `".$field_name."` (`".$field_name."`)";
							}
							
						}
						if ($primary_key_start!=1)
						{
							$primary_key = '';
						}
						if ($i == count($this->fields)-1)
						{
							$result     .= "\n".$field_name." ".$type_data.$length." ".$unsigned ." ".$null." ".$auto_increment." ".$primary_key;
							
						}else{
							$result     .= "\n".$field_name." ".$type_data.$length." ".$unsigned ." ".$null." ".$auto_increment." ".$primary_key.", ";
						}
						$i++;
					}
					$query = "CREATE TABLE IF NOT EXISTS ".$this->table." ( ".$result." )\n";
					if ($unique_enabled)
					{
						if (substr($unique_result, -1) ==',')
						{
							$unique_result = substr($unique_result, 0, -1);
						}
						$query = $query.';'.$unique_result; 
					}
					$comment_export = '/*
*  Created by '.$this->author.'
*  Migration Table '.$this->table.'
*  Date Created '._getDate().'
*  Time Created '._getTime().'
*  Database Name '.$this->database.'
*  Database Type '.strtoupper($this->type_database).'
*/';
					return $this->export_query = trim($comment_export."\n".$query.";");
					break;
				case 'postgresql':
					$i=0;
					$result='';
					$primary_key_start = 0; 
					$unique_result= false;
					foreach ($this->fields as $key => $val) 
					{
						$field_name = $key;
						$type_data  = isset($val['type_data']) ? strtoupper($val['type_data']) : '';
						$length     = isset($val['length']) ? $val['length'] : false;
						$null       = isset($val['not_null']) ? $val['not_null'] : false;
						
						$auto_increment  = isset($val['auto_increment']) ? $val['auto_increment'] : false;
						$primary_key   = isset($val['primary_key']) ? $val['primary_key'] : false;
						$unique      = isset($val['unique']) ? $val['unique'] : false;
						
						if ($type_data=='INT')
						{
							$type_data = 'INTEGER';
						}
						if ($primary_key)
						{
							 $primary_key = 'PRIMARY KEY';
							 $primary_key_start = $primary_key_start +1;
						}else{
							$primary_key = str_replace(" ",'',$primary_key);
						}
						if ($null)
						{
							$null = 'NOT NULL';
						}
						else{
							$null = str_replace(" ",'',$null);
						}
						if ($unique)
						{
							$unique_result .= 'ALTER TABLE public."'.$this->table.'" ADD CONSTRAINT '.$field_name.' UNIQUE ('.$field_name.'); ';
						}
						if ($length != false)
						{
							 if ($type_data=='INTEGER' || $type_data == 'BIGINT' || $type_data == 'SMALLINT')
							 {
							 	 $length = '';
							 }else{
							 	 $length = "(".$length.")";
							 }
							
						}else{
							 $length = str_replace(" ",'',$length);
						}
						if ($primary_key_start!=1)
						{
							$primary_key = '';
						}
						
						if ($i == count($this->fields)-1)
						{
							$result     .= "\n".$field_name." ".$type_data.$length." ".$null ." ".$primary_key;
							
						}else{
							$result     .= "\n".$field_name." ".$type_data.$length." ".$null." ".$primary_key.", ";
						}
						$i++;
					}
					$query = "CREATE TABLE public.".$this->table."( ".$result." )\n";
					
					$query = $query."; ".$unique_result;

					if ($this->username!= null)
					{	
						$query = $query." ALTER TABLE public.".$this->table." OWNER to ".$this->username.";";
					}
$comment_export = '/*
*  Created by '.$this->author.'
*  Migration Table '.$this->table.'
*  Date Created '._getDate().'
*  Time Created '._getTime().'
*  Database Name '.$this->database.'
*  Database Type '.strtoupper($this->type_database).'
*/';
					return $this->export_query = $comment_export."\n".$query;
					break;
				default:
					return false;
					break;
			}
			return $this;
	}

	public function setTypeDatabase($v='mysql'){
		$this->type_database = strtolower(trim($v));
		return $this;
	}
	public function dropTable(){
		 $q = 'DROP TABLE '.$this->table;
		 $comment_export = '/*
*  Created by '.$this->author.'
*  Migration Table '.$this->table.'
*  Date Created '._getDate().'
*  Time Created '._getTime().'
*  Database Name '.$this->database.'
*  Database Type '.strtoupper($this->type_database).'
*/';
		 $this->export_query = $comment_export."\n".$q;
		 return $this;
	}

	public function export(){
		$this->createTable();
		if ($this->export_query != null)
		{		
			$file = new \GF_Text\File_Generator;
			$extension_file = '.txt';
			$db_name = '';
			switch ($this->type_database) {
				case 'mysql':
					$extension_file = '.sql';
					$db_name = "MYSQL ";
					break;
				case 'postgresql':
					$extension_file = '.sql';
					$db_name = "POSTGRESQL ";
					break;
				default:
					break;
			}
			$file_name = '['.$db_name.'] migration_table #'.$this->table.'# '._getDate('d-m-Y').'#'._getTime('his')."@"._randomStr(3).$extension_file;
			$file->setFile($file_name);
			$file->setPath(__MIGRATION_DIR__);
			$file->setData($this->export_query);
			$file->create();

			return (file_exists(__MIGRATION_DIR__.$file_name)) ? true : false;
			
		}else{
			return false;
		}
	}

	public function default(){
		$this->setAuthor('Unknown')
			 ->setDatabaseName('db_test')
			 ->setTypeDatabase('mysql')
			 ->setTableName('t_user');
		$fields = [
			'id_user' => array(
						 'type_data'      => 'INT',
						 'length'         => 15,
						 'primary_key'    => true,
						 'not_null'       => true,
						 'auto_increment' => true,
						 'unsigned'       => true
					),
			'username' => array(
						 'type_data'      => 'VARCHAR',
						 'length'         => 50,
						 'unique'         => true
					),
			'email' => array(
						 'type_data'      => 'VARCHAR',
						 'length'         => 50,
						 'unique'         => true
					),
			'pass' => array(
						 'type_data'      => 'VARCHAR',
						 'length'         => 70
					),
			'date_register' => array(
						 'type_data'      => 'DATETIME'
					)
		];	

		$this->addFields($fields);
		$this->export();	 
	}

}
}