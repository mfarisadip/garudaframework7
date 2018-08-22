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
namespace Query;
defined('sys_run_app') OR exit('403 - Access Forbidden');

use System\GF_Message as GF;

class GF_Query {

 protected $query_master= null,$query_check= null,$query= false;
 protected function showErrorSelectWhere($str)
{
    return GF::showError('selectWhere',$str);
}
 protected function fontRed($str)
 {
    return '<font color="red"><b> '.$str.' </b></font>';
}

  protected function emptyQuery()
{
    return GF::showError('QueryEmpty');
}
protected function showErrorQuery($error=null)
{
    return GF::showError('QueryError',self::$query,$error);
}


protected function querySelect($primary_key,$tblname,$column,$value)
{
		return is_int($value) ? "select $primary_key from $tblname where $column=$value"
                        :  "select $primary_key from $tblname where $column='$value'";
}

public function queryCheckId($column, $tblname,
                            $column1 , $value1,
                            $column2 = false, $value2 = false,
                            $column3 = false, $value3 = false)
{
	    $query_master= "";

    if (empty($column) || empty($tblname) || empty($column1) || empty($value1))
    {
        exit(self::showErrorQuery("Column PK and Tabel Name & Column 1 & Value 1 Cannot Be Empty"));
    }

    if ($column1 != false && $value1 != false
        && $column2==false && $value2 == false
        && $column3 == false && $value3  == false
     )
    {

        if (is_int($value1))
        {
           $query_master = self::querySelect("$column","$tblname","$column1",$value1)." limit 1";
        }
        else
        {
            $value1 = addslashes($value1);
            $query_master = self::querySelect("$column","$tblname","$column1","$value1")." limit 1";
        }

    }
    else if ($column1 != false && $value1 != false
            && $column2 != false && $value2 != false
            && $column3 == false && $value3  == false
    ){

    if (is_int($value1) && is_int($value2))
    {
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2=$value2 limit 1";
    }
    else if (is_int($value1) && ! is_int($value2))
    {

          $value2 = addslashes($value2);
          $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2='$value2' limit 1";
    }
    else if (! is_int($value1) && is_int($value2))
    {

          $value1 = addslashes($value1);
          $query_master = self::querySelect("$column","$tblname","$column1","$value1")." and $column2=$value2 limit 1";
    }
    else
    {
       $value1 = addslashes($value1);
       $value2 = addslashes($value2);
       $query_master = self::querySelect("$column","$tblname","$column1","$value1")." and $column2='$value2' limit 1";
    }

}
else if ($column1 != false && $value1 != false
        && $column2 != false && $value2 != false
        && $column3 != false && $value3  != false
      ){

    if (is_int($value1) && is_int($value2) && is_int($value3))
    {
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2=$value2 and $column3=$value3 limit 1";
    }
    else if (is_int($value1) && is_int($value2) && ! is_int($value3))
    {
         $value3 = addslashes($value3);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2=$value2 and $column3='$value3' limit 1";
    }
     else if (is_int($value1) && ! is_int($value2) && is_int($value3))
    {
        $value2 = addslashes($value2);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2='$value2' and $column3=$value3 limit 1";
    }
     else if (is_int($value1) && ! is_int($value2) && ! is_int($value3))
    {
        $value2 = addslashes($value2);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2='$value2' and $column3='$value3' limit 1";
    }
     else if (! is_int($value1) && is_int($value2) && is_int($value3))
    {
         $value1 = addslashes($value1);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2=$value2 and $column3=$value3 limit 1";
    }
    else if (! is_int($value1) && is_int($value2) && ! is_int($value3))
    {
         $value1 = addslashes($value1);
         $value3 = addslashes($value3);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2=$value2 and $column3='$value3' limit 1";
    }
    else if (! is_int($value1) && ! is_int($value2) && is_int($value3))
    {
         $value1 = addslashes($value1);
         $value2 = addslashes($value2);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2='$value2' and $column3=$value3 limit 1";
    }
    else if (! is_int($value1) && ! is_int($value2) && ! is_int($value3))
    {
         $value1 = addslashes($value1);
         $value2 = addslashes($value2);
         $value3 = addslashes($value3);
         $query_master = self::querySelect("$column","$tblname","$column1",$value1)." and $column2='$value2' and $column3='$value3' limit 1";
    }
}
return $query_master;

}

public function queryDelete($tblname,$column1,$value1,
                            $column2=false,$value2=false,
                            $column3=false,$value3=false,
                            $column4=false,$value4=false)
{
$column2 != false ?  $column2 = ($column2) : $column2 = false;
$value2 != false ?  $value2 = addslashes(trim($value2)) : $value2 = false;

$column3 != false ?  $column3 = ($column3) : $column3 = false;
$value3 != false ?  $value3 = addslashes(trim($value3)) : $value3 = false;

$column4 != false ?  $column4 = ($column4) : $column4 = false;
$value4 != false ?  $value4 = addslashes(trim($value4)) : $value4 = false;

if (empty($tblname) || empty($column1) || empty($value1))
{
    exit(self::showErrorQuery("Tabel Name & Column 1 &  Value 1  Cannot Be Empty !"));
}

 $query_master = "";

if (is_int($value1))
{
     $query_delete = "delete from $tblname where $column1=$value1";
}else{
     $query_delete = "delete from $tblname where $column1='$value1'";
}

// column 1 Value 1
if ($column2 == false && $value2==false
        && $column3 == false && $value3==false
        && $column4 == false && $value4==false ) {

   $query_master = $query_delete;
 
// column 2 Value 2
}
else if ($column2 != false && $value2 != false
            && $column3 == false && $value3 == false
            && $column4 == false && $value4 == false ) {

    if ($column1 == $column2)
    {
        exit(self::showErrorQuery(("Duplicat Column Name")));
    }

$query_master =  $query_delete." and $column2='$value2'";

}
 else if ($column2 != false && $value2 != false
            && $column3 != false && $value3 != false
            && $column4 == false && $value4 == false ) {

     if ($column1 == $column2 || $column2 == $column3 || $column1 == $column3)
    {
        exit(self::showErrorQuery("Duplicate Column Name"));
    }

    $query_master =  $query_delete." and $column2='$value2' and $column3 ='$value3'";
   
}

else if ($column2 != false && $value2 != false
            && $column3 != false && $value3 != false
            && $column4 != false && $value4 != false) {

     if ($column1 == $column2 || $column2 == $column3 || $column1 == $column3 || $column1 == $column4 || $column2 == $column4 || $column3 == $column4)
    {
        exit(self::showErrorQuery("Duplicate Column Name"));
    }

     $query_master =  $query_delete." and $column2='$value2' and $column3='$value3' and $column4 = '$value4'";
    

}
	return $query_master;

}

public function queryInsert($tblname,$column1,$value1,
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

    if (is_string($value1) && $value1 != false )
{
      $value1  = addslashes(trim($value1));
      $value1  = _replaceHtml($value1);
}

if (is_string($value2) && $value2 != false )
{
     $value2 = addslashes(trim($value2));
     $value2  = _replaceHtml($value2);
}
else
{
     $value2 = false;
}

 if (is_string($value3) && $value3 != false )
{
     $value3 = addslashes(trim($value3)) ;
      $value3  = _replaceHtml($value3);
}
 else
{
     $value3 = false;
}

 if (is_string($value4) && $value4 != false )
{
     $value4 = addslashes(trim($value4)) ;
      $value4  = _replaceHtml($value4);
}
 else
{
     $value4 = false;
}

 if (is_string($value5) && $value5 != false )
{
     $value5 = addslashes(trim($value5)) ;
      $value5  = _replaceHtml($value5);
}
 else
{
     $value5 = false;
}

  if (is_string($value6) && $value6 != false )
{
     $value6 = addslashes(trim($value6)) ;
      $value6  = _replaceHtml($value6);
}
 else
{
     $value6 = false;
}

  if (is_string($value7) && $value7 != false )
{
     $value7 = addslashes(trim($value7)) ;
      $value7  = _replaceHtml($value7);
}
 else
{
     $value7 = false;
}

if (is_string($value8) && $value8 != false )
{
     $value8 = addslashes(trim($value8)) ;
      $value8  = _replaceHtml($value8);
}
 else
{
     $value8 = false;
}

if (is_string($value9) && $value9 != false )
{
     $value9 = addslashes(trim($value9)) ;
      $value9  = _replaceHtml($value9);
}
 else
{
     $value9 = false;
}


 if (empty($tblname) || empty($column1) || empty($value1))
{
    exit(self::showErrorQuery("Tabel Name & Column 1 &  Value 1  Cannot Be Empty !"));
}

$query_master = "";

$query_insert = "insert into $tblname($column1";

// Column 1 Value 1
if ($column2 == false && $value2==false
    && $column3 == false && $value3 == false
    && $column4 == false && $value4 == false
    && $column5 == false && $value5 == false
    && $column6 == false && $value6 == false
    && $column7 == false && $value7 == false
    && $column8 == false && $value8 == false
    && $column9 == false && $value9 == false  ) {

 $query_master = $query_insert.") VALUES ('$value1')";


}
 // Column 2 Value 2
else if ($column2 != false && $value2 != false
        && $column3 == false && $value3 == false
        && $column4 == false && $value4 == false
        && $column5 == false && $value5 == false
        && $column6 == false && $value6 == false
        && $column7 == false && $value7 == false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2) VALUES ('$value1','$value2')";


}
 // Column 3 Value 3
else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 == false && $value4 == false
        && $column5 == false && $value5 == false
        && $column6 == false && $value6 == false
        && $column7 == false && $value7 == false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2,$column3) VALUES ('$value1','$value2','$value3')";


}
// Column 4 Value 4
else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 == false && $value5 == false
        && $column6 == false && $value6 == false
        && $column7 == false && $value7 == false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false) {

$query_master = $query_insert.",$column2,$column3,$column4) VALUES ('$value1','$value2','$value3','$value4')";

}
 // Column 5 Value 5
else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 != false && $value5 != false
        && $column6 == false && $value6 == false
        && $column7 == false && $value7 == false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2,$column3,$column4,$column5)
            VALUES ('$value1','$value2','$value3','$value4','$value5')";

}
 // Column 6 Value 6
else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 != false && $value5 != false
        && $column6 != false && $value6 != false
        && $column7 == false && $value7 == false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2,$column3,$column4,$column5,$column6)
        VALUES ('$value1','$value2','$value3','$value4','$value5','$value6')";

}
 // Column 7 Value 7
 else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 != false && $value5 != false
        && $column6 != false && $value6 != false
        && $column7 != false && $value7 != false
        && $column8 == false && $value8 == false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2,$column3,$column4,$column5,$column6,$column7)
        VALUES ('$value1','$value2','$value3','$value4','$value5','$value6','$value7')";

}
 // Column 8 Value 8
 else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 != false && $value5 != false
        && $column6 != false && $value6 != false
        && $column7 != false && $value7 != false
        && $column8 != false && $value8 != false
        && $column9 == false && $value9 == false ) {


$query_master = $query_insert.",$column2,$column3,$column4,$column5,$column6,$column7,$column8)
        VALUES ('$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8')";

}
 // Column 9 Value 9
 else if ($column2 != false && $value2 != false
        && $column3 != false && $value3 != false
        && $column4 != false && $value4 != false
        && $column5 != false && $value5 != false
        && $column6 != false && $value6 != false
        && $column7 != false && $value7 != false
        && $column8 != false && $value8 != false
        && $column9 !=  false && $value9 != false ) {


$query_master = $query_insert.",$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9)
        VALUES ('$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8','$value9')";

}
return $query_master;

}

public function queryUpdate($tblname,$parameter1,$value_parameter1,
                        $column1,$value1,
                        $column2=false,$value2=false,
                        $column3=false,$value3=false,
                        $column4=false,$value4=false,
                        $column5=false,$value5=false,
                        $column6=false,$value6=false,
                        $column7=false,$value7=false,
                        $column8=false,$value8=false,
                        $column9=false,$value9=false)
{
   
if (is_string($value_parameter1))
{
     $value_parameter1   = _replaceHtml(addslashes(trim($value_parameter1)));
}


$value1  = _replaceHtml(addslashes(trim($value1)));

$column2 != false ?  $column2 = ($column2) : $column2 = false;
$value2 != false ?  $value2 = _replaceHtml(addslashes(trim($value2))) : $value2 = false;

$column3 != false ?  $column3 = ($column3) : $column3 = false;
$value3 != false ?  $value3 = _replaceHtml(addslashes(trim($value3))) : $value3 = false;

$column4 != false ?  $column4 = ($column4) : $column4 = false;
$value4 != false ?  $value4 = _replaceHtml(addslashes(trim($value4))) : $value4 = false;

$column5 != false ?  $column5 = ($column5) : $column5 = false;
$value5 != false ?  $value5 = _replaceHtml(addslashes(trim($value5))) : $value5 = false;

$column6 != false ?  $column6 = ($column6) : $column6 = false;
$value6 != false ?  $value6 = _replaceHtml(addslashes(trim($value6))) : $value6 = false;

$column7 != false ?  $column7 = ($column7) : $column7 = false;
$value7 != false ?  $value7 = _replaceHtml(addslashes(trim($value7))) : $value7 = false;

$column8 != false ?  $column8 = ($column8) : $column8 = false;
$value8 != false ?  $value8 = _replaceHtml(addslashes(trim($value8))) : $value8 = false;

$column9 != false ?  $column9 = ($column9) : $column9 = false;
$value9 != false ?  $value9 = _replaceHtml(addslashes(trim($value9))) : $value9 = false;



 if (empty($tblname) || empty($column1) || empty($value1) || empty($parameter1) || empty($value_parameter1))
{
    exit(self::showErrorQuery("Tabel Name & Column 1 &  Value 1 & Parameter1 & Value Paramater1  Cannot Be Empty !"));
}


$query_master = "";

$query_update ="update $tblname set $column1='$value1'";

$query_last_where;

if (is_int($value_parameter1))
{
   $query_last_where = " where $parameter1=$value_parameter1";
}
else if (is_string($value_parameter1))
{
   $query_last_where = " where $parameter1='$value_parameter1'";   
}
else
{
   return false;
}

if ($column2 == false && $value2==false
    && $column3 == false && $value3== false
    && $column4 == false && $value4 ==false
    && $column5 == false && $value5 ==false
    && $column6 == false && $value6 ==false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false ) {

   
    $query_master = $query_update.$query_last_where;
}
else if ($column2 != false && $value2 !=  false
    && $column3 == false && $value3 == false
    && $column4 == false && $value4 == false
    && $column5 == false && $value5 ==false
    && $column6 == false && $value6 ==false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false ) {

    $query_master = $query_update.",$column2='$value2'".$query_last_where;
}
else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 == false && $value4 == false
    && $column5 == false && $value5 == false
    && $column6 == false && $value6 ==false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false  ) {

     $query_master = $query_update.",$column2='$value2', $column3='$value3'".$query_last_where;
}
else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 == false && $value5 == false
    && $column6 == false && $value6 ==false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4'".$query_last_where;
}
 else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 != false && $value5 != false
    && $column6 == false && $value6 ==false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4',$column5='$value5'".$query_last_where;
}
 else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 != false && $value5 != false
    && $column6 !=  false && $value6 !=  false
    && $column7 == false && $value7 ==false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4',$column5='$value5',$column6='$value6'".$query_last_where;
}
 else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 != false && $value5 != false
    && $column6 !=  false && $value6 !=  false
    && $column7 != false && $value7 != false
    && $column8 == false && $value8 ==false
    && $column9 == false && $value9 ==false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4',$column5='$value5',$column6='$value6',$column7='$value7'".$query_last_where;
}
 else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 != false && $value5 != false
    && $column6 !=  false && $value6 !=  false
    && $column7 != false && $value7 != false
    && $column8 !=  false && $value8 !=  false
    && $column9 == false && $value9 == false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4'
   ,$column5='$value5',$column6='$value6',$column7='$value7',$column8='$value8'".$query_last_where;
}
  else if ($column2 != false && $value2 !=  false
    && $column3 != false && $value3 != false
    && $column4 != false && $value4 != false
    && $column5 != false && $value5 != false
    && $column6 !=  false && $value6 !=  false
    && $column7 != false && $value7 != false
    && $column8 !=  false && $value8 !=  false
    && $column9 != false && $value9 != false  ) {

   $query_master =
   $query_update.",$column2='$value2', $column3='$value3',$column4='$value4'
   ,$column5='$value5',$column6='$value6',$column7='$value7',$column8='$value8',$column9='$value9'".$query_last_where;
}

return $query_master;
}

}


class GF_Paging
{
private $space,$start,$count,$query,$result_final,$url,$null_index = true;
private $string_next = "Next",$string_previous = "Previous";

private $query_limit = null,$custom_link = '&nbsp | &nbsp';

public function setQueryLimit($v){
$this->query_limit = $v;
}

public function setCustomLink($v){
$this->custom_link = $v;
}

public function setConfig(array $setup){
$this->space = (int) $setup['space'];

$start  = (int) $setup['start'] ;

if (empty($start))
{
    $this->null_index = false;
    $this->start = 1;
}
else{
    $this->start = (int) $start - 1;
}
$this->count = (int) $setup['count'];
$this->query = $setup['query'];
$this->url   = isset($setup['url']) ? trim($setup['url']) : ".";

$this->string_previous = isset($setup['previous']) ? trim($setup['previous']) : $this->string_previous;
$this->string_next     = isset($setup['next']) ? trim($setup['next']) : $this->string_next;
$this->job();
}

public function getSpace(){
return $this->space;
}

public function getStart(){
return $this->start;
}

public function getCount(){
return $this->count;
}


public function getQuery(){
// For MySQl, SQLite, dan PostGreSql
if (is_int($this->space)&& is_int($this->start))
{
    if ($this->query_limit==null)
    {
        $my_sql = " limit ".$this->space." OFFSET ".$this->start."";
    }else if (is_string($this->query_limit))
    {
        $my_sql = $this->query_limit;
    }
    return $this->query.$my_sql;
}else{
    exit();
}
}

private function job(){

if ($this->null_index==false)
{
    $this->result_final == false;
    return false;
}
else
{
    $queue        = array();
    $result_final = array();
    $queue['start'] = $this->start;
    $queue['end']   = $this->count;

    if (($queue['start']) < 0)
    {
        $this->result_final == false;
        return false;
    }
    if ($queue['end'] < $this->start+1)
    {
        $this->result_final == false;
        return false;
    }

   
    if (! isset($queue['middle']))
    {
       if ($this->start >= 0  && $this->start < 8)
       {
         $queue['middle']  = 5;
       }
       else{
           $queue['middle'] = $this->start  + 1;
        }
    }else{
        exit();
    }

    // Dari middle ke kiri
    $left_queue = array();
    $left_middle = $queue['middle']-1;
    for ($i=0; $i < $this->space; $i++) { 
        $left_queue[$i] =  $left_middle ;
        $left_middle--;
    }
    // Urutkan array kiri
    sort($left_queue);
     // Dari middle ke kanan
    $right_queue = array();
        

    $right_middle = $queue['middle']+1;
    for ($i=0; $i < $this->space ; $i++) { 
        if ($right_middle==$queue['end']+1)
        {
            break;
        }else{
             $right_queue[$i] =  $right_middle ;
        }
        $right_middle++;
    }
    $result_final =  array_merge($left_queue,array($queue['middle']), $right_queue);

    for ($i=0; $i < count($result_final); $i++) { 
         $previous = false;
         $next = false;
         if ($i==0)
         {      
               if ($this->start==0)
               {
                   $show = "";
                   $previous = false;
                    $next = false;
               }else{

                    $show = $this->string_previous;
                    $previous = true;
                    $next = false;
               }
         }
         else if ($i==count($result_final)-1)
         {  
                if ($queue['end']==$this->start+1)
                {
                    $show = $queue['end'];
                }else{
                    $show = $this->string_next;
                }
                
                $previous = false;
                $next = true;
         }
         else {
              $show = $result_final[$i];
              $previous = false;
              $next = false;
         }
         // Check apakah string url ada \
         
         $url = $this->url;
         if (substr($url, -1)!='/')
         {
             $url = $url.'/';
         }
      
         // Check apakah start sama dengan array
         if ($this->start+1==$result_final[$i])
         {
             $link = "";
         }
         else{
              $final_url =  $url.$result_final[$i];
              $link = "href='".$final_url."'";
         }

         if ($previous)
         {
                $rx = $this->start;
                $final_url =  $url.$rx;
                $link = "href='".$final_url."'";
         }

         if ($next)
        {
            if ($queue['end']==$this->start+1)
            {

                $final_url =  $url.$queue['end'];
                $link = "";
            }else{
                $rx = $this->start+1+1;
                $final_url =  $url.$rx;
                $link = "href='".$final_url."'";
            }
        }

        $this->result_final[$i] =  "<a ".$link.">".$show."</a>";
    }

    return $this->result_final;
}
}

public function getLink(){
$end_link = '';
for ($i=0; $i < count($this->result_final) ; $i++) 
{ 
    if ($i == count($this->result_final)-1)
    {
         $end_link .= $this->result_final[$i];    
    }else{
         $end_link .= $this->result_final[$i].$this->custom_link;
    }

}
return $end_link;
}
}