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

namespace GF\DB;
defined('sys_run_app') OR exit('403 - Access Forbidden');
use System\GF_Message as GF;
use GF_Database\Data_Table as DT;
use Query\GF_Query as Query;
use \System\GF_Encrypt_Decrypt as LockDB;
use GF_Database\Query_Builder;

class pdo extends Query
{
  private $conn;
  private $error;
  private $queryError;
  private $obj;
  private $queryUser;

  use Query_Builder;

  function __construct()
  { 
        $options = array(
                \PDO::ATTR_PERSISTENT    => true,
                \PDO::ATTR_ERRMODE       => \PDO::ERRMODE_EXCEPTION
        );
        try
        {
          $options = array(
            $GLOBALS['_OPTION_a1b2c312k312n23123k123n123_']
          ); 
          $unlock_db  = new LockDB;
          $username = $unlock_db->setValue($GLOBALS['_USERNAME_a1b2c312k312n23123k123n123_'])->decrypt();
          $password = $unlock_db->setValue($GLOBALS['_PASSWORD_a1b2c312k312n23123k123n123_'])->decrypt();
          $dsn   = $unlock_db->setValue($GLOBALS['_DSN_a1b2c312k312n23123k123n123_'])->decrypt();

          $this->obj= $this->conn = new \PDO( 
                        $dsn,
                        $username,
                        $password,
                        $options
                        );
            $this->data_table     = new DT();
            unset($username, $password ,$dsn);
        } 
        catch (PDOException $e)
        {
            trigger_error("Upzz Something Is Wrong , Database Connection !",E_USER_ERROR,$e);
             exit;
        }
  }
  protected function getQuery(){
      return $this->queryUser;
  }
  protected function bind($prm, $v, $type = null)
  {
      if(is_null($type)){
          switch (true){
              case is_int($v):
                $type = \PDO::PARAM_INT;
                break;
              case is_bool($v):
                  $type = \PDO::PARAM_BOOL;
                  break;
              case is_null($v):
                  $type = \PDO::PARAM_NULL;
                  break;
              default:
                  $type = \PDO::PARAM_STR;
          }
      }
     $this->obj->bindValue($prm, $v, $type);
     return $this;
  }
  protected function setQuery($query)
  {
      $this->obj = $this->conn->prepare($query);
      return $this;
  }

  protected function execute(){
      return $this->obj->execute() ? TRUE : FALSE;
  }
  protected function getAllData(){
      $this->execute();
      return $this->obj->fetchAll(\PDO::FETCH_ASSOC);
  }
  protected function getData(){
      $this->execute();
      return $this->obj->fetch(\PDO::FETCH_ASSOC);
  }
  protected function getCount(){
      $this->execute();
      return $this->obj->rowCount();
  }
  protected function getLastId(){
      return $this->conn->lastInsertId();
  }

}
