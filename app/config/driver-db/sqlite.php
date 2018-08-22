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
use System\GF_Message as GF;
use GF_Database\Data_Table as DT;
use GF_Database\Query_Builder;

class Sqlite extends SQLite3 
{ 
    private   $query,$obj_gf_query;
    private   $store_data = array();
    public    $data_table  = null;

    use Query_Builder;

    public function __construct($path=null) 
    {
        $this->obj_gf_query = new GF_Query;
        $this->data_table   = new DT();
        if ($path != null)
        {
            $this->connect();
        }
    }
    public function connect($path=null){
        try 
        {
           if (file_exists($path))
           {
                $this->open($path);
                return true; 
           }else{
                return false;
           }
        }catch (Exception $e) {
             trigger_error("Upzz Something Is Wrong (Sqlite)",E_USER_ERROR,$e);
             exit;
        }
    }

    public function setQuery($q=null)
    {
        $this->query = $q;
        return $this;
    }

    public function __destruct(){
        $this->close();
    }

    public function getAllData()
    {
        $o = self::query($this->query);
        $data = array();
        while($row = $o->fetchArray(SQLITE3_ASSOC) ) 
        {
            $data[] = $row;
        }
         return $data;
    }

    public function getData()
    {
        if ($this->getCount()>0)
        {
            $o = self::query($this->query);
            return $o->fetchArray(SQLITE3_ASSOC) ;
        }else{
            return false;
        }
    }

    public function execute($q=null)
    {
        if ($q==null)
        {
            $r = self::exec($this->query);
        }else{
            $r = self::exec($q);
        }
        return $r;
    }

    public function checkId($column=null, $tblname=null,
                                    $column1 =null , $value1=null,
                                    $column2 = false, $value2 = false,
                                    $column3 = false, $value3 = false
                                  )
    {
    $query_result = $this->obj_gf_query->queryCheckId($column, $tblname,
                                                    $column1, $value1,
                                                    $column2,$value2,
                                                    $column3,$value3
                                                   );

    $this->query = $query_result;
    return ($this->getCount()>0) ? true : false;
    }

    public function getCount()
    {
        $o = self::query($this->query);
        $i=0;
        while($r = $o->fetchArray(SQLITE3_ASSOC) ) 
        {
            $i++;
        }
        return $i;
    }

    public function insert($tblname=null,$column1=null,$value1=null,
            $column2=false,$value2=false,
            $column3=false,$value3=false,
            $column4=false,$value4=false,
            $column5=false,$value5=false,
            $column6=false,$value6=false,
            $column7=false,$value7=false,
            $column8=false,$value8=false,
            $column9=false,$value9=false  )
    {
    $query =  $this->obj_gf_query->queryInsert($tblname,$column1,$value1,
                                                    $column2,$value2,
                                                    $column3,$value3,
                                                    $column4,$value4,
                                                    $column5,$value5,
                                                    $column6,$value6,
                                                    $column7,$value7,
                                                    $column8,$value8,
                                                    $column9,$value9 );

    return self::exec($query);
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
                        $column9=false,$value9=false )
    {
    if (is_int($value_parameter1))
    {   
        $value_parameter1_result = (int) $value_parameter1;
    }
    else
    {
        $value_parameter1_result = $value_parameter1;
    }

    $query = $this->obj_gf_query->queryUpdate($tblname,$parameter1,$value_parameter1_result,
                                                    $column1,$value1,
                                                    $column2,$value2,
                                                    $column3,$value3,
                                                    $column4,$value4,
                                                    $column5,$value5,
                                                    $column6,$value6,
                                                    $column7,$value7,
                                                    $column8,$value8,
                                                    $column9,$value9 );

    return self::exec($query);
    }

    public function delete($tblname=null,$column1=null,$value1=null,
                                $column2=false,$value2=false,
                                $column3=false,$value3=false,
                                $column4=false,$value4=false )
    {

    $query = $this->obj_gf_query->queryDelete($tblname,$column1,$value1,
                                $column2,$value2,
                                $column3,$value3,
                                $column4,$value4);
    return self::exec($query);
    }
}