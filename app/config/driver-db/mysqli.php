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
use Query\GF_Query as Query;
use GF_Database\Data_Table as DT;
use \System\GF_Encrypt_Decrypt as LockDB;
use GF_Database\Query_Builder;


class mysqli extends Query 
{
    protected $conn =   false;
    private $last_id = "";
    protected $store_data    = array();
    protected $data_table  = null;

    use Query_Builder;

    function __construct()
    {
         try {
           
            $this->data_table     = new DT();
             $this->connect() ? '' : exit(GF::showError('ConnectDBError'));
            
         } catch (Throwable $e) {
             trigger_error("Upzz Something Is Wrong , Database Connection !",E_USER_ERROR,$e);
             exit;
         }
   
    }
    protected function setQuery($q)
    {
        $this->query  = $q;
        return $this;
    }

    protected function getQuery()
    {
        return $this->query ;
    }

    protected function connect()
    {
        $boolean = false;
        try
        {
            $unlock_db  = new LockDB;
            $server = $unlock_db->setValue($GLOBALS['_SERVER_a1b2c312k312n23123k123n123_'])->decrypt();
            $username = $unlock_db->setValue($GLOBALS['_USERNAME_a1b2c312k312n23123k123n123_'])->decrypt();
            $password = $unlock_db->setValue($GLOBALS['_PASSWORD_a1b2c312k312n23123k123n123_'])->decrypt();
            $db = $unlock_db->setValue($GLOBALS['_DB_a1b2c312k312n23123k123n123_'])->decrypt();
            $port = $unlock_db->setValue($GLOBALS['_PORT_a1b2c312k312n23123k123n123_'])->decrypt();

            $this->conn = new \mysqli( $server,
                             $username,
                            $password ,
                            $db,
                            $port);
             $boolean = true;
            unset($server,$username, $password ,$db, $port);
        }
        catch (Throwable $e)
        {
             $boolean = false;
             $this->conn = false;
            exit(GF::showError('ConnectDBError',$e)); return false;
        }
        return $boolean ? true : false;
    }
  
    protected function getData()
    {
       if (  $this->conn != false &&  $this->query != false)
        {
              try
              {
                  $r = $this->conn->query(( $this->query));
              }
              catch (Throwable $e)
              {
                  exit( $this->showErrorQuery($e));
              }

              if ($r)
              {
                 return mysqli_fetch_array($r,MYSQLI_ASSOC);
              }
              else
              {
                   exit( $this->showErrorQuery("Terjadi kesalahan !"));
              }
        }
        else { return false; }
    }

     protected function getAllData($function_user=null)
     {
       if (  $this->conn != false )
        {
             if ( $this->query != false)
            {
                $r =  $this->conn->query( $this->query);
                if ($r)
                {
                    $data=array();
                    while ($row = $r->fetch_assoc())
                    {
                       $data[] = $row;
                    }
                    return $data;
                }
                else
                {
                   exit( $this->showErrorQuery()) && exit();
                }
            }
            else
            {
                exit( $this->emptyQuery());
            }

       }else { return false; }
   }

    protected function execute()
    {
        if ( $this->conn != false )
        {
            if ( $this->query != false)
            {
                $r =  $this->conn->query( $this->query);
                return ! $r  ?  $this->showErrorQuery() && exit() : $r;
            }
            else
            {
                exit( $this->emptyQuery());
            }

        }else { return false; }
    }

    protected function getCount()
    {
        if ( $this->conn != false &&  $this->query != false )
        {
            $r =  $this->conn->query( $this->query);
            return ! $r  ?  $this->showErrorQuery() && exit() : $r->num_rows;
        }else { return false; }
    }



    protected function resetIdAuto($tblname)
    {
        $tbl = addslashes($tblname);
        $query = "ALTER TABLE $tbl AUTO_INCREMENT = 1";

        if (self::$conn != false )
        {
            $result = self::$conn->query($query);
            return $result ? true : false;
        }
    }

    protected function checkId($column=null, $tblname=null,
                                $column1 =null, $value1=null,
                                $column2 = false, $value2 = false,
                                $column3 = false, $value3 = false
                              )
    {
       
        $query_result = self::queryCheckId($column, $tblname,
                                            $column1 , $value1,
                                            $column2, $value2,
                                            $column3, $value3
                                          );
      
        if (self::$conn != false)
        {     
              self::$query = $query_result;
              return ( self::getCount() > 0 ) ? true : false ;
        }
    }


    protected function getId(){
        return self::$last_id;
    }

    private function setId($value){
        self::$last_id = $value;
    }


    protected function insert($tblname=null,$column1=null,$value1=null,
                                    $column2=false,$value2=false,
                                    $column3=false,$value3=false,
                                    $column4=false,$value4=false,
                                    $column5=false,$value5=false,
                                    $column6=false,$value6=false,
                                    $column7=false,$value7=false,
                                    $column8=false,$value8=false,
                                    $column9=false,$value9=false 
                                  )
    {
       

       $query_result =  $this->queryInsert($tblname,$column1,$value1,
                                                  $column2,$value2,
                                                  $column3,$value3,
                                                  $column4,$value4,
                                                  $column5,$value5,
                                                  $column6,$value6,
                                                  $column7,$value7,
                                                  $column8,$value8,
                                                  $column9,$value9 
                                           );

    

        if (self::$conn != false)
        {
            $r = self::$conn->query($query_result);
            return ! $r  ? self::showErrorQuery() && exit() : true;
        }
        else
        {
            return false;
        }

    }

   

    protected function delete($tblname=null,$column1=null,$value1=null,
                                    $column2=false,$value2=false,
                                    $column3=false,$value3=false,
                                    $column4=false,$value4=false )
    {

       $query_result = self::queryDelete($tblname,$column1,$value1,
                                    $column2=false,$value2=false,
                                    $column3=false,$value3=false,
                                    $column4=false,$value4=false
                                );

      
        if (self::$conn != false)
        {
              $r = self::$conn->query($query_result);
              return ! $r  ? self::showErrorQuery() && exit() : true;
        }

    }

     protected function update($tblname=null,$parameter1=null,$value_parameter1=null,
                                $column1=null,$value1=null,
                                $column2=false,$value2=false,
                                $column3=false,$value3=false,
                                $column4=false,$value4=false,
                                $column5=false,$value5=false,
                                $column6=false,$value6=false,
                                $column7=false,$value7=false,
                                $column8=false,$value8=false,
                                $column9=false,$value9=false )
     {

        $query_result = self::queryUpdate($tblname,$parameter1,$value_parameter1,
                                                                $column1,$value1,
                                                                $column2,$value2,
                                                                $column3,$value3,
                                                                $column4,$value4,
                                                                $column5,$value5,
                                                                $column6,$value6,
                                                                $column7,$value7,
                                                                $column8,$value8,
                                                                $column9,$value9);
       
        
         if (self::$conn != false)
        {
            $r = self::$conn->query($query_result);
            return ! $r  ? self::showErrorQuery() && exit() : true;
        }
        else
        {
            return false;
        }

    }

   
    protected function selectWhere($tblname=null,$column_data=array(),
                                   $whereColumn=null,$value=null,$limit="",$like=false){
        if (self::$conn != false)
        {
            if ($tblname != null && count($column_data)>0 && $whereColumn != null && $value != null )
            {
                if (is_string($value))
                {
                    $value = "'".addslashes($value)."'";
                }

                $column_select = '';
                for ($i=0; $i < count($column_data) ; $i++)
                 { 
                    if ($i==0)
                    {
                         $column_select .= $column_data[$i];
                    }
                    else
                    {
                         $column_select .= ','.$column_data[$i];
                    }
                }
                if (! empty($limit))
                {
                    if (! is_int($limit))
                    {
                         exit(self::showErrorSelectWhere($limit)) && exit();
                    }else
                    {
                        if ($like==true)
                        {
                             $value = str_replace("'","",$value);
                             $value = "%$value%";
                             if (is_int($value))
                             {
                                   $query_master = 'select '.$column_select.' from '.
                                            $tblname.' where '
                                            .$whereColumn." like $value limit ".$limit;   
                             }
                             else if (is_string($value))
                             {
                                 $query_master = 'select '.$column_select.' from '.
                                            $tblname.' where '
                                            .$whereColumn." like '$value' limit ".$limit;   
                             }
                          
                        }
                        else
                        {
                            if (is_int($value))
                             {
                                     $query_master = 'select '.$column_select.' from '.
                                             $tblname.' where '
                                            .$whereColumn.' = '.$value." limit ".$limit;   
                             }
                             else if (is_string($value))
                             {
                                 $query_master = "select $column_select from $tblname where $whereColumn = $value limit ".$limit;   
                             }
                           
                        }
                    }
                    
                }
                else
                {
                    if ($like==true)
                        {
                         $value = str_replace("'","",$value);
                         $value = "%$value%";
                           $query_master = 'select '.$column_select.' from '.
                                            $tblname.' where '.$whereColumn." like $value limit ";
                        }
                        else
                        {
                             $query_master = 'select '.$column_select.' from '.
                                                $tblname.' where '.$whereColumn.' = '.$value;
                        }
                   
                }
              
                $r = self::$conn->query($query_master);
                if ($r)
                {
                    while ($row_data = $r->fetch_assoc())
                    {
                        self::$store_data[] = $row_data;
                    }
                }
                else
                {
                   exit(self::showErrorQuery($query_master)) && exit();
                }
            }
            else
            {
                return false;
            }
        }
    }
}
