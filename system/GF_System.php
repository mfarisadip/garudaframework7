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
namespace System;
defined('sys_run_app') OR exit('403 - Access Forbidden');

use GF_Text\HTML_Generator;
use GF_Text\GF_Log as Log;

class GF_Message
 {
   public static function showError($type, $parameter = null, $parameter1 = null)
  {
     if (__GARUDA_FRAMEWORK_ERROR_HANDLING__)
    {
          if ($type==null)
          {
             return self::template($parameter);
             exit;
          }
          $parameter = str_replace("/", "\\", $parameter);
          $gf_41 = "GF tidak menemukan ";
          $gf_12 = $gf_41.' file ini ->';
          $gf_83 = ' . Periksa kembali file tersebut ! ';
          $gf_23 = "<font color='red'>'$parameter' </font> </br></br> ".$gf_83;
          $gf_45 = "Upzz, anda harus memasukkan <font color='red'> nama file";
          $gf_78 = $gf_12 . $gf_23 ;
          $gf_66 = "Parameter ini -> <font color='red'>'$parameter'</font> haruslah sebuah ";
          $gf_92 = 'Class <font color="red">' . $parameter . '</font> untuk <font color="#0984e3">';
          $gf_93 = '</font> tidak ditemukan ! Periksa kembali <font color="#636e72">nama class</font> tersebut !';
          switch ($type) 
          {
            case '1':
                $message = $gf_12 . "<font color='red'>'$parameter' </font> ".$gf_83;
                break;
            case '1a':
               $message = $gf_12 . " <font color='red'>'$parameter' </font> atau <font color='red'>'$parameter1' </font> ".$gf_83;
                break;
            case '1b':
                $message =  $gf_45 . " untuk tampilan/view  </font>";
                break; 
            case 'RU':
                $message =  $gf_78 . " {Router}";
                break;
            case 'CU':
                $message =  $gf_78 . " {Controller}";
                break;  
            case 'MU':
                $message =  $gf_78 . " {Model}";
                break;  
            case 'HU':
                $message = $gf_78 . " {Helper}";
                break;  
             case 'LU':
                $message = $gf_78 . " {Library}";
                break;  
             case '2':
                $message = "GF Tidak dapat membuat VIEW";
                break; 
            case '3':
                $message = $gf_66." <font color='green'>function()</font> bukan STRING atau Integer atau Array";
                break;
            case '3a':
                $message = $gf_66." nama dari <font color='green'>CLASS</font> bukan Integer atau Array";
                break;
            case '3b':
                $message = $gf_66." function atau nama dari view ";
                break;
            case 'MODELNOTFOUND':
                $message = "Anda harus membuat model terlebih dahulu !</font>";
                break;
            case '4':
                $message =  "<font color='red'>CLASS</font> tidak ditemukan !, Anda harus membuat nama class <font color='red'>'$parameter'</font> terlebih dahulu di dalam controller ! Secara otomatis maka GF akan menjalankan Constructor class <font color='red'>'$parameter'</font> !";
                break;
            case '5':
                $message = $gf_41 . " CLASS -> <font color='red'>'$parameter'</font> Buat CLASS tersebut didalam <font color='green'>CONTROLLER</font> atau periksa nama CLASS";
                break;    
            case '5A':
                $message = $gf_41 . " -> <font color='red'>CLASS  '$parameter'</font> Buat CLASS tersebut didalam <font color='green'>MODEL</font> atau periksa nama CLASS";
                break;    
            case '6':
                $message = $gf_41 . " halaman error ini -> <font color='red'>'$parameter'</font>";
                break;    
            case '7':
                $message = $gf_41 . " function ini -> <font color='red'>'$parameter'</font>";
                break;    
            case '8':
                $message = "";
                break;    
            case 'any':
                $message = $gf_41 . " <font color='red'>callback function</font> atau halaman <font color='red'>view</font>";
                break;    
            case 'GF':
                $message = "Maaf Data GET dengan Parameter Tidak Tepat !";
                break; 
            case 'any1':
                $message = $gf_41 . " function -> <font color='red'>$parameter</font> di dalam CLASS -> <font color='green'>$parameter1</font> , Periksa function tersebut ! ";
                break;  
            case '9':
                $message = "Anda harus memasukkan parameter Pretty GET pada -> <font color='red'>'$parameter'</font> Dengan menggunakan karakter pemisah <font color='green'>'/'</font> {Tanpa Tanda Petik 1} ";
                break;  
            case 'ConnectDBError':
                $message = "GF tidak dapat terhubung  Ke<font color='red'> Database Server</font>, Periksa kembali koneksi dan informasi database anda ! -> <hr><hr><font color='red'>'$parameter'</font>";
                break;  
            case 'PDO_DNS':
                $message = "Maaf untuk class <font color='green'>PDO</font> hanya support DSN database <font color='red'>MySQl</font>, Silahkan anda tambahkan sendiri jika ingin menggunakan database lainnya.";
                break;  
            case 'CLASS_WRONG':
                $message = "Maaf anda lupa mengganti class <font color='green'>database</font> yang digunakan, silahkan periksa kembali";
                break;     
             case 'QueryError':
                $message = "Terjadi Kesalahan Pada Saat Menjalankan Query -> <font color='red'>'$parameter'</font> atau Periksa Koneksi Database Anda ! <hr><hr><font color='red'>'$parameter1'</font>";
                break;     
             case 'selectWhere':
                $message = "Pada Query Select Where, Nilai limit-> <font color='red'>'$parameter'</font> haruslah bernilai integer <hr><hr>";
                break; 
             case 'QueryEmpty':
                $message = "<font color='red'>Query tidak ditemukan !</font> Masukkan Query terlebih dahulu !";
                break; 
             case 'MaxPrettyGEt':
                $message =  "Maximum Pretty GET hanya <font color='red'>12</font> ! Request parameter -> <font color='green'>$parameter</font>";
                break; 
             case 'ME':
                $message = "<font color='red'>Anda harus memasukkan nama class didalam parameter model </font>";
                break;  
             case 'CE':
                $message = "<font color='red'>Anda harus memasukkan nama class didalam parameter controller </font>";
                break;  
             case 'MaxPost':
                $message = "Maximum POST dari form input hanya <font color='red'>13</font> ! <font color='green'>$parameter</font>";
                break;  
             case 'FILES_NOT_SET':
                $message =  '<font color="red"> $_FILES[' . $parameter . ']</font> is not set ! Check in your FORM !';
                break;  
             case 'VALUE_COMPRESS_IMAGE':
                $message =  'Value compress image -> <font color="red">' . $parameter . '</font> should be an integer !';
                break; 
            case 'DB_MAX_CHECK_ID':
                $message = 'Maximum parameter function checkId() only -> <font color="red">5 column </font>';
                break;
            case 'ROUTER_NULL':
                $message = 'File <font color="red">Router</font> tidak ditemukan ! Buat Terlebih Dahulu File Router ! Lokasi -> <font color="green">"app/config/config.php"</font>';
                break; 
            case 'Route_One_Empty':
                $message =  'Anda harus memasukkan nama <font color="red">View</font> atau membuat <font color="red">function callback</font>';
                break; 
            case 'Route_One_Int':
                $message = 'Parameter ini <font color="red">' . $parameter . '</font> haruslah sebuah <font color="green">View</font> atau <font color="green">Function Callback</font>';
                break; 
           case 'CLS_N_FOUND':
                $message = 'Class <font color="red">' . $parameter . '</font> tidak ditemukan ! Anda harus membuat nama class sama dengan <font color="red">nama file</font> !';
                break; 
           case 'C_N_F_C':
                $message = $gf_92.' CONTROLLER '.$gf_93;
                break;
           case 'C_N_F_M':
                $message = $gf_92.' MODEL '.$gf_93;
                break;  
           case 'C_N_F_F_R':
                $message = 'Method <font color="red">'.$parameter.'</font> tidak dapat ditemukan pada CONTROLLER <font color="red">'.$parameter1.'</font>';
                break;
           case 'Route_One_Last_Empty':
                $message = 'You must <font color="red">insert variabel name as a string or empty string </font> to <font color="blue">RouteOneLast</font> !';
                break;     
            default:
              $message = "";
              break;
          }
          return self::template($message);
        }
    }
    private  static function template($value)
    {
        $engine = new \GF_Error; 
        $engine->setTitle('');
        $image = _setImageBase64(__SYSTEM_DIR__.__GF_Image_Error__);
        $engine->setContent([
              'number'=> null,
              'string'=> $value,
              'file'  => '',
              'line'  => '',
              'image' => $image
        ]);
        echo $engine->render();exit;
    }

 }


 class GF_File
  {
    protected static $path_file = false;
    protected static $empty_file_content = '<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <title>404 Page Not Found</title> <meta name="viewport" content="width=device-width, initial-scale=1"></head> <body><center><h2>404 Page Not Found</h2> </center> </body> </html>';

    public static function setPath($val='')
    {
        if (self::checkFile(__STORAGE_DIR__.$val))
        {
            self::$path_file = __STORAGE_DIR__.$val;
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function setEmptyContentFile($v=''){
        self::$empty_file_content = $v;
    }

    public function deleteDir($path='')
    {
        if (! empty($path))
        {
             $path = __STORAGE_DIR__.$path;
              if(is_dir($path) == TRUE)
              {
                $rootFolder = scandir($path);
                if(sizeof($rootFolder) > 2)
                {
                  foreach($rootFolder as $folder)
                  {
                    if($folder != "." && $folder != "..")
                    {
                      $this->deleteDir($path."/".$folder);
                    }
                  }
                  rmdir($path);
                }
              }
              else
              {
                (file_exists($path) == TRUE) ? unlink($path) : "" ;
              }
        }
    }

    public static function checkFile($path)
    {
        return file_exists($path) ? true  : false;
    }

    public static function deleteFile($filename=null)
    {
        if (is_array($filename) && $filename != null)
        {
            $collect = [];
            for ($i=0; $i < count($filename); $i++) 
            { 
                $result = file_exists($filename[$i]) ? unlink($filename[$i]) : false;
                $collect[$i] = array($filename[$i]=>$result);
            }
            return $collect;
        }
        else if (file_exists(self::$path_file))
        {
             return unlink(self::$path_file);
        }
    }

    public static function download($file=null)
    {
      if ($file != null)
      {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($file).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
      }
      else
      {
            if (self::$path_file == false)
            {
                return false;
            }
            $r = str_replace("/", "\\", self::$path_file);
            if (file_exists($r))
            {
              header('Content-Description: File Transfer');
              header('Content-Type: application/octet-stream');
              header('Content-Disposition: attachment; filename="'.basename($r).'"');
              header('Expires: 0');
              header('Cache-Control: must-revalidate');
              header('Pragma: public');
              header('Content-Length: ' . filesize($r));
              readfile($r);
            }
             else
            {
              return false;
            }
      }

    }

    public static function createDirOnStorage($path='')
    {
        if (! empty($path))
        {
            return (mkdir(__STORAGE_DIR__.$path,0700, true)) ? true : false;
        }
        else
        {
           return false;
        }
    }
    public static function createDirOnPublic($path='')
    {
        if (! empty($path))
        {
            return (mkdir($path,0700, true)) ? true : false;
        }
        else
        {
           return false;
        }
    }
}

class PrettyGET
{
  private $uri,$count_line,$first_line;
  private $data = array(),$user_param = true;

  function __construct($str, $type, $replaceType = null)
    {
          if ($type == true)
          {
            $this->uri = (strtolower(trim($str)));
            $this->user_param = false;
          }
          else if ($type == false)
          {
            $p = new HTML_Generator($str);
            $this->uri = $p->getText();
          }

          if ($replaceType == true)
          {
            $this->uri = str_replace("#", "", $this->uri);
            $this->uri = str_replace("{", "", $this->uri);
            $this->uri = str_replace("}", "", $this->uri);
          }
          $this->uri = ($this->checkLastLine($this->uri)) ? rtrim($this->uri, "/") : $this->uri;
          $this->countLine();
          $this->setFirstLine();
    }

    public function getCountLine()
    {
      return $this->count_line;
    }

    private function countLine()
    {
      $this->count_line = substr_count($this->uri, '/');
      return $this->count_line;
    }

    private function checkLastLine($uri)
    {
      if (empty($uri))
      {
        return false;
      }
      else
      {
          $check_last_line = $uri[strlen($uri) - 1];
          return $check_last_line == '/' ? true : false;
      }
    }

     protected function getUri()
    {
        return $this->uri;
    }

    private function checkLength()
    {
        return strlen($this->uri);
    }

     protected function setFirstLine()
    {
        $r = explode('/', $this->uri);
        ($this->user_param == false) ?  $this->first_line = rtrim($r[0]) : $this->first_line = $r[0];
    }

    public function getFirstLine()
    {
      return $this->first_line;
    }

    public function getData()
    {
      return array_map('trim', $this->data);
    }

    public function parseUri()
    {
        $result_uri = explode('/', $this->uri);
        $count_uri  = count($result_uri);
        if ($count_uri > 1)
        {
              $start_slice = $count_uri;
              for ($i=1; $i < 13 ; $i++) 
              {  
                  if ($this->count_line = $i)
                  {
                       $this->data =  array_slice($result_uri,0,$start_slice);
                       return true;
                       break;
                  }
                  $start_slice = $start_slice + 1;
              }
        }
        else
        {
           return false;
        }
    }
  }


class GF_Router extends GF_File
{
      use \GF_Controller;

      private static $modeAPI = false;
      private static $_GET_Request,$data_session,$data_cookie;
      private static $header         = array("Access-Control-Allow-Origin: "
                                            ,"Access-Control-Allow-Credentials: "
                                            ,"Access-Control-Allow-Methods: "
                                            ,"Access-Control-Max-Age: "
                                            ,"Access-Control-Allow-Headers: "
                                            ,"Content-Length: 0"
                                            ,"Content-Type: "
                                            ,"HTTP/1.1 403 Access Forbidden"
                                            ,"Access-Control-Request-Headers: ");
      protected static $defaultHeader = array();

      private static $api_header = 'Content-Type: application/json';

      private static $isPrivate = false;

       // ==============================
      private static function countLine($s)
      {
           return substr_count($s, '/');
      }

      private static function checkLastLine($uri)
      {
          if (empty($uri)) 
          {
            return $uri; 
          }
          else{
             $last_line = $uri[strlen($uri) - 1];
            return ($last_line=='/') ? rtrim($uri,"/") : $uri;
          }
      }

      public static function setPrivate()
      {
          self::$isPrivate = true;
      }

      public function setPublic()
      {
          self::$isPrivate = false;
      }

      private static function cleanUrl($url)
      {
        return strtolower(trim($url));
      }

       private static function Model($class='',$data=array())
     {
         if (! empty($class))
         {
              if (class_exists($class))
             {
                 if (count($data>0))
                 {
                     $class = new $class($data);
                 }
                 else if (count($data==0))
                 {
                    $class = new $class;
                 }
                 return $class;
             }
             else
             {
                 GF_Message::showError('5A',$class); exit;
             }
         }
         else
         {
             GF_Message::showError('ME'); exit;
         }
     }
     private static function setLibrary($file='',$data=null)
     {
        if (! empty($file))
        {
            $path = __LIBRARY_DIR__.$file.__ext_php__;
            ! isset($check) ? $check = new GF_File() : false ;

            if ($check->checkFile($path))
            {
                  if (__GF_LOG__)
                  {
                    $log = new Log;
                    $log->setContent('run static function setLibrary() - File .'.$path)->create();
                  }
                include $path;
                if ($data != null)
                {
                    $namespace = isset($data['namespace']) ? $data['namespace'] : null;
                    $class     = isset($data['class']) ? $data['class'] : null;

                    if ($namespace != null && $class != null)
                    {
                        $obj = $namespace.'\\'.$class;
                        return new $obj();
                    }
                }
            }
             else
            {
               GF_Message::showError('LU',$path); exit;
            }
        }
     }
      private static function setModel($file='',$class_name='')
     {
      if (! empty($file))
        {
          $path = __MODEL_DIR__.$file.__ext_php__;
          ! isset($check) ? $check = new GF_File() : false ;

          if ($check->checkFile($path))
          {
              if (__GF_LOG__)
              {
                  $log = new Log;
                  $log->setContent('run static function setModel() - File .'.$path)->create();
              }
              if (defined('__include_sys__'.$file)==false)
              {
                  include $path;
                  define('__include_sys__'.$file,true);
              }
              if (empty($class_name))
              {
                  $class = "Garuda\Model\\".$file;
                  if (class_exists($class))
                  {
                      return new $class();
                  }else{
                      GF_Message::showError('CLS_N_FOUND',$file) ; 
                      exit;
                  }
              }
              else 
              {
                  $class = "Garuda\Model\\".$class_name;
                  if (class_exists($class))
                  {
                      return new $class();
                  }else{
                      GF_Message::showError('C_N_F_M',$class_name) ; 
                      exit;
                  }
              }
          }
           else
          {
             GF_Message::showError('MU',$path);exit;
          }
        }
     }
    private static function defaultHeader()
    {
        if (self::$isPrivate)
        {
            header(self::$header[0].__full_url__);
        }else{
            header(self::$header[0].' *');
        }

        if (self::$modeAPI==true)
        {
           header(self::$header[6].' application/json');
        }else{
           header(self::$header[6].' text/html');
        }
    }
     // ==============================

      // ==============================
     public static function setHeader($i=false)
     {
          ($i==false) ?? $i=1;
          return ($i >= count(self::$header)) ? false : header(self::$header[$i]);
     }

     public static function enabledApi()
    {
        self::$modeAPI = true;
    }

    public static function disabledApi()
    {
         self::$modeAPI = false;
    }
    
    public static function setupHeader($header=null)
    {
         if (is_array($header))
         {
              for ($i=0; $i < count($header) ; $i++) 
              { 
                  header($header[$i]);
              }
         }
         else
        {
            self::defaultHeader();
        }
    }

      public static function getAllHeader()
      {
        return self::$header;
      }

     public static function directTo($val)
     {
        defined('__full_url__') ? header('Location: '.__full_url__.$val) : '';
     }

    public static function RouteOneLast($user_uri,$function_user=null)
    {
       if (is_callable($user_uri) && ! is_string($user_uri))
      {
          GF_Message::showError('Route_One_Last_Empty');exit;
      }
      self::setupHeader();
      if (! __production__)
      {
          if (_parameter() != false)
          {
                $get_uri_ori   = _replaceHtml(trim(_parameter()));

                if (! defined("__THIS_URL__"))
                {
                   _def("__THIS_URL__",__full_url__.$get_uri_ori);
                }
                
                if (is_string($function_user))
                {
                   $user_uri = str_replace("-","_",$user_uri);
                   if (__GF_LOG__)
                    {
                        $log = new Log;
                        $log->setContent('run static function RouteOneLast() - Parameter user {'.$user_uri."}, Paramater URL {".$get_uri_ori."}")
                        ->create();
                    }
                    $obj = new \GF_Router_To_Controller;

                    $obj->set(['function_user'=>$function_user]); 
                    
                    $array_data = array($user_uri => $get_uri_ori);
                    if (! $obj->run())
                    {
                        self::setView($function_user,$array_data);
                        exit;
                    }else{
                       self::callController($obj->getController(),null,
                                            $obj->getMethod(),
                                            $array_data);
                       exit;
                    }
                  
                }
               else if ($function_user != null && ! is_string($function_user) && ! is_int($function_user))
                {
                    if (__GF_LOG__)
                    {
                        $log = new Log;
                        $log->setContent('run static function RouteOneLast() with Callback function - Parameter user {'.$user_uri."}, Paramater URL {".$get_uri_ori."}")->create();
                    }
                    call_user_func($function_user,$get_uri_ori);
                   exit;
                }
                else if ($function_user==null)
                {
                    if (__GF_LOG__)
                    {
                        $log = new Log;
                        $log->setContent('Error while run static function RouteOneLast()')->create();
                    }
                     GF_Message::showError('Route_One_Empty');exit;
                }
                else if (is_int($function_user))
                {
                     if (__GF_LOG__)
                    {
                        $log = new Log;
                        $log->setContent('Error while run static function RouteOneLast()')->create();
                    }
                    GF_Message::showError('Route_One_Int');exit;
                }
                else
                {
                    return;
                }
          }
          else
          {

              return;
          }
      }
      else
      {
           if (__file_maintenance__ != null)
          {
              self::errorPage(__file_maintenance__);
              exit();
          }
      }
    }

    private static function importValidation($filename='')
    {
        if (file_exists(__VALIDATION_DIR__.$filename.__ext_php__))
        {
            include __VALIDATION_DIR__.$filename.__ext_php__;
        }else{
            \System\GF_Message::showError(null,'Upzz, File controller auth <font 
                   color="red"> { '.$filename.' } </font> is not found !');exit;
        }
    }

    public static function Validation($class='',$callback)
    {
        self::importValidation($class);

        $class = 'Garuda\Validation\\'.$class;
        $stop  = $class.'::stop()';

        if (class_exists($class))
        {
            try {
                $obj    = new $class();
            
                if ($obj->getResult())
                {
                    if (is_callable($callback))
                    {
                        call_user_func($callback); 
                    }
                }else{

                    if (method_exists($obj,'stop'))
                    {
                        $obj->stop();
                        exit;
                    }
                }
            } catch (Exception $e) {
               \System\GF_Message::showError(null,'Upzz something is wrong with controller Auth !');
            }
        }else{
           \System\GF_Message::showError(null,'Uppzz class auth <font color="red">{ '.$class.' }
           </font> is not found !');
        }
        
    }

    public static function Route($user_uri=null,$function_user=null,$controller=null)
    {
          if (is_callable($user_uri) && ! is_string($user_uri))
          {
              trigger_error("Upzz, the first parameter in this route should be a string !",E_USER_ERROR);
              exit;
          }
         try {
            self::setupHeader();
            if (! __production__)
            {
              if (_parameter() != false)
              {
                  $get_uri_ori   = _parameter();
                  $user_uri_ori  = $user_uri;

                  $user_parameter   = new PrettyGET($user_uri_ori,true,true);
                  $get_parameter    = new PrettyGET($get_uri_ori,false);

                  $count_user = $user_parameter->getCountLine();
                  $count_get  = $get_parameter->getCountLine();

                  $first_line_user = $user_parameter->getFirstLine();
                  $first_line_get = $get_parameter->getFirstLine();

                  $get_parameter->parseUri();
                  $result = $user_parameter->parseUri();

                  $data_parameter = $get_parameter->getData();
                  $data_request   = $user_parameter->getData();

                  $count_data1  = count($data_parameter);
                  $count_data2  = count($data_request);
                  $result_array = array();

                   _def("__THIS_URL__",__full_url__.$first_line_get);

                  if ($count_user > 0 && $count_get > 0 )
                  {
                       if ($first_line_user==$first_line_get)
                       {
                            if ($result==false)
                            {
                                GF_Message::showError('MaxPrettyGEt',$user_uri_ori);
                                if (__GF_LOG__)
                                {
                                    $log = new Log;
                                    $log->setContent('run static function Route() - error while use maximum parameter')->create();
                                }
                                exit;
                            }
                            for ($i=0; $i < $count_data2 ; $i++) {
                                $res = $data_parameter[$i] ?? false ;
                                $result_array[$data_request[$i]] = $res;
                            }
                            if ($function_user != null && ! is_string($function_user) && ! is_int($function_user) && $controller == null)
                            {
                                  if (__GF_LOG__)
                                  {
                                      $log = new Log;
                                      $log->setContent('run static function Route() with Callback - Parameter From User {'
                                                       .$first_line_user.'}, Parameter From URL {'
                                                       .$first_line_get.'}. Result : '.json_encode($result_array))->create();
                                  }
                                   call_user_func($function_user,$result_array);
                                  exit;
                            }
                            else if ($function_user != null && ! is_string($function_user) && ! is_int($function_user) && $controller != null)
                            {

                                if (class_exists($controller))
                                {
                                    $controller = new $controller();
                                    if (__GF_LOG__)
                                    {
                                        $log = new Log;
                                        $log->setContent('run static function Route() with Callback and Controller {'
                                                           .json_encode($controller).'} - Parameter From User {'.$first_line_user.'}, Parameter From URL {'
                                                            .$first_line_get.'}. Result : '.json_encode($result_array))->create();
                                    }

                                    call_user_func($function_user,$result_array,$controller);
                                    exit;
                                }
                                else
                                {
                                    if (__GF_LOG__)
                                    {
                                        $log = new Log;
                                        $log->setContent('Error while run static function Route()')->create();
                                    }
                                     GF_Message::showError('5',$controller);
                                     exit;
                                }
                            }
                            else if (is_string($function_user) && $function_user != null)
                            {
                                 if (__GF_LOG__)
                                  {
                                      $log = new Log;
                                      $log->setContent('run static function Route() with View {'
                                        .toString($function_user).'} - Parameter From User {'
                                        .$first_line_user.'}, Parameter From URL {'.$first_line_get.'}. Result : '.json_encode($result_array))->create();
                                  }

                                 // Direct to controller if it has symbol =>
                              $obj = new \GF_Router_To_Controller;

                              $obj->set(['function_user'=>$function_user]); 
                              
                              if (! $obj->run())
                              {
                                self::setView($function_user,$result_array);
                                 exit;
                              }else{
                                 self::callController($obj->getController(),null,$obj->getMethod(),$result_array);
                                 exit;
                              }
                            }
                       }
                }
                else
                {

                    $first_line_user = $user_parameter->getFirstLine();
                    $first_line_get = $get_parameter->getFirstLine();
                    $result_array = array();
                    for ($i=0; $i < $count_data2 ; $i++)
                    {
                      $res = $data_parameter[$i] ?? false ;
                      $result_array[$data_request[$i]] = $res;
                    }

                    if ($first_line_user == $first_line_get)
                    {

                          if ($function_user==null)
                          {
                              if (__GF_LOG__)
                              {
                                  $log = new Log;
                                  $log->setContent('run static function Route() with View {'
                                                        .$first_line_user.'}. Parameter From User {'
                                                        .$first_line_user.'}, Parameter From URL {'.$first_line_get.'}.')->create();
                              }
                              self::setView($first_line_user);
                              exit;
                          }
                          else if (is_string($function_user) && $function_user != null)
                          {
                              // Create Logic To Controller with Symbol =>
                              
                              if (__GF_LOG__)
                              {
                                  $log = new Log;
                                  $log->setContent('run static function Route() with View {'
                                                       .toString($function_user).'}. Parameter From User {'
                                                       .$first_line_user.'}, Parameter From URL {'.$first_line_get.'}.')->create();
                              }
                              $obj = new \GF_Router_To_Controller;

                              $obj->set(['function_user'=>$function_user]); 
                              
                              if (! $obj->run())
                              {
                                 self::setView($function_user);
                                 exit;
                              }else{
                                 self::callController($obj->getController(),null,$obj->getMethod());
                                 exit;
                              }
                          }
                          else if ($function_user != null && ! is_string($function_user) && ! is_int($function_user) && ! is_array($function_user))
                          {
                            
                              if (__GF_LOG__)
                              {
                                  $log = new Log;
                                  $log->setContent('run static function Route() with Callback - Parameter From User {'
                                                          .$first_line_user.'}, Parameter From URL {'
                                                          .$first_line_get.'}. Result : '.json_encode($result_array))->create();
                              }

                              call_user_func($function_user,$result_array); exit;
                          }
                          else
                          {
                            GF_Message::showError('3b',$function_user);exit;
                          }
                    }
                }

              }
                else
                {

                   $user_parameter = $user_uri;
                    _def("__THIS_URL__",__full_url__.$user_parameter);
                   if ($user_parameter=='/' && $function_user==null || $user_parameter=='')
                   {
                        if (is_string($function_user))
                        {
                          if (__GF_LOG__)
                          {
                              $log = new Log;
                              $log->setContent('run static function Route() with View {'
                                                        .toString($function_user).'}. Parameter From User {'
                                                        .toString($user_parameter).'}')->create();
                          }
                           self::setView($function_user);
                           exit();
                        }
                        else
                        {
                            if ($function_user==null)
                            {
                                GF_Message::showError('any',$function_user);exit;
                            }
                            else
                            {
                                if (__GF_LOG__)
                                {
                                    $log = new Log;
                                    $log->setContent('run static function Route() with View {'
                                                         .toString($function_user).'}. Parameter From User {'
                                                         .toString($user_parameter).'}')->create();
                                }
                               call_user_func($function_user); exit;
                            }
                        }
                   }
                }

            }
             else
            {
                _def("__THIS_URL__",__full_url__.'#maintenance');
                if (__file_maintenance__ != null)
                {
                    if (__GF_LOG__)
                    {
                        $log = new Log;
                        $log->setContent('Website is maintenance')->create();
                    }
                    self::errorPage(__file_maintenance__);
                    exit();
                }
            }
       }catch (Exception $e) {
            trigger_error("Upzz, something is wrong with your Route !",E_USER_ERROR);
       }
  }

     public static function Controller($class='',$data=array())
     {
        if (! empty($class))
         {
              if (class_exists($class))
             {
                 if (count($data>0))
                 {
                     $class = new $class($data);
                 }
                 else if (count($data==0))
                 {
                    $class = new $class;
                 }
                 return $class;
             }
             else
             {
                GF_Message::showError('5',$class);exit;
             }
         }
         else
         {
             GF_Message::showError('CE');exit;
         }
     }

    public static function importModel($filename='',$class_name=null)
    {
      
        try {
          return ($class_name==null) ? 
                self::setModel($filename) : 
                self::setModel($filename,$class_name);
        } catch (Exception $e) 
        {
          trigger_error('Upzz, Something is wrong with the model !',$e);
          exit;
        }
    }

    
     public static function importLibrary($filename='',$data=null)
     {
         self::setLibrary($filename,$data);
     }

     public static function importController($filename='',$any=null)
     {
         return self::callController($filename,$any);
     }

     protected static function setHelper($file='')
     {
        try {
            if (! empty($file))
            {
                $path = __HELPER_DIR__.$file.__ext_php__;
                ! isset($check) ? $check = new GF_File() : false ;

                if ($check->checkFile($path))
                {
                     if (__GF_LOG__)
                      {
                          $log = new Log;
                          $log->setContent('run static function setHelper() - Include File .'.$path)->create();
                      }
                    include $path;
                }
                else
                {
                  GF_Message::showError('HU',$path);exit;
                }
            }
        } catch (Exception $e) {

        }
     }
     protected static function setDatabase($file='',$data1=null,$data2=null)
     {
          if (! empty($file))
          {
               $path = __DB_DIR__.$file.__ext_php__;
              ! isset($check) ? $check = new GF_File() : false ;

              if ($check->checkFile($path))
              {
                  if ($data1 != null )
                  {
                      is_array($data1) ? extract($data1,EXTR_OVERWRITE) : '';

                  }
                  if ($data2 != null)
                  {
                     is_array($data2) ? extract($data2,EXTR_OVERWRITE) : '';

                  }
                  if (__GF_LOG__)
                  {
                      $log = new Log;
                      $log->setContent('run static function setDatabase() - File .'.$path)->create();
                  }
                  include $path;
              }

          }

      }
      public static function setLanguage($file='')
      {
        if (! empty($file))
        {
            $path = __LANGUAGE_DIR__.$file.__ext_php__;
            $check = new GF_File();
             if (__GF_LOG__)
              {
                  $log = new Log;
                  $log->setContent('run static function setLanguage() - File .'.$path)->create();
              }
            if ($check->checkFile($path))
            {
               $t =  include $path;
               foreach ($t as $k => $v) 
               {
                  $k = isset($k) ? $k : '';
                  $v = isset($v) ? $v : '';
                  _def($k,$v);
               }
            }else{
                \System\GF_Message::showError(null,'Uppzz, File language <font color="red">{ '.$file.' }</font> is not found !');
            }
        }
      }

      public static function setHead($file='',$data_1=null,$data_2=null)
      {
          if (! empty($file))
          {
            if (! self::templateView($file,$data_1,$data_2))
            {
              
              $path_php  =  __VIEW_DIR__.strtolower($file).__ext_php__;
              $path_html =  __VIEW_DIR__.strtolower($file).__ext_html__;

              if (file_exists($path_php))
              {
                  is_array($data_1) ? extract($data_1,EXTR_OVERWRITE) : '';
                  is_array($data_2) ? extract($data_2,EXTR_OVERWRITE) : '';
                   if (__GF_LOG__)
                  {
                      $log = new Log;
                      $log->setContent('run static function setHead(), with File '.$path_php)
                          ->create();
                  }
                  include $path_php;
              }
              else if (file_exists($path_html))
              {
                is_array($data_1) ? extract($data_1,EXTR_OVERWRITE) : '';
                is_array($data_2) ? extract($data_2,EXTR_OVERWRITE) : '';
                if (__GF_LOG__)
                  {
                      $log = new Log;
                      $log->setContent('run static function setHead(), with File '.$path_html)
                          ->create();
                  }
                include $path_html;
              }
              else
              {
                 $msg_error = new GF_Message();
                 exit($msg_error->showError('1a',$path_php,$path_html));
              }
            }  
          }
      }
     
      private static function templateView($file='',$data_1=null,$data_2=null)
      {
          $path_php  = _getViewTemplatePath($file);
          if (file_exists($path_php))
          {
              is_array($data_1) ? extract($data_1,EXTR_OVERWRITE) : '';
              is_array($data_2) ? extract($data_2,EXTR_OVERWRITE) : '';
              if (__GF_LOG__)
              {
                  $log = new Log;
                  $log->setContent('run static function templateView() - Include File .'
                                      .$path_php.'. With extract data {'.json_encode($data_1).'}')->create();
              }
              
              $obj = new \GF_Template_View;

              $obj->setFile($path_php)
                  ->setFilename($file)
                  ->read()
                  ->render();
               
              try
              {

                return (! $obj->isReady()) ? include $obj->getFile() : exit;
               
              }catch(Exception $er)
              {
                 trigger_error("Upzz, something is wrong with View Template ! ",E_USER_ERROR);
                 exit;
              }
          }else{
              return false;
          }
      }

      public static function setView($file='',$data_1=null,$data_2=null)
      {
        if (! empty($file))
        {

            if (! self::templateView($file,$data_1,$data_2))
            {
                $path_php  = _getViewPath($file)[0];
                $path_html = _getViewPath($file)[1];

                if (file_exists($path_php))
                {
                  is_array($data_1) ? extract($data_1,EXTR_OVERWRITE) : '';
                  is_array($data_2) ? extract($data_2,EXTR_OVERWRITE) : '';
                  if (__GF_LOG__)
                  {
                      $log = new Log;
                      $log->setContent('run static function setView() - Include File .'
                                          .$path_php.'. With extract data {'.json_encode($data_1).'}')->create();
                  }
                  return include $path_php;
                }
                else if (file_exists($path_html))
                {
                  is_array($data_1) ? extract($data_1,EXTR_OVERWRITE) : '';
                  is_array($data_2) ? extract($data_2,EXTR_OVERWRITE) : '';
                  if (__GF_LOG__)
                  {
                      $log = new Log;
                      $log->setContent('run static function setView() - Include File .'
                                         .$path_html.'. With extract data {'.json_encode($data_1).'}')->create();
                  }
                  return include $path_html;
                }
                $msg_error = new GF_Message();
                exit($msg_error->showError('1a',$path_php,$path_html));
              } 
        }
         else
         {
             $msg_error = new GF_Message();
             exit($msg_error->showError('1b',$file));
         }
        
      }

      protected static function setRouter($file='')
      {
          if (! empty($file))
          {
             $path = __ROUTER_DIR__.$file.__ext_php__;
            ! isset($check) ? $check = new GF_File() : false ;

            if ($check->checkFile($path))
            {
                 if (__GF_LOG__)
                {
                    $log = new Log;
                    $log->setContent('run static function setRouter() - Include File .'.$path.'')->create();
                }
                include $path;
            }
            else
            {
              $msg_error = new GF_Message();
              exit($msg_error->showError('RU',$path));
            }
          }
          else
           {
               $msg_error = new GF_Message();
               exit($msg_error->showError('1r',$file));
           }

      }
     public static function errorPage($file=null)
     {
          $path = is_null($file) ? __ERROR_DIR__.__404_Page__ : __ERROR_DIR__.$file;

          if (file_exists($path.__ext_php__))
          {
              include $path.__ext_php__;
              if (__GF_LOG__)
              {
                  $log = new Log;
                  $log->setContent('run function errorPage() - Include File '.$path.__ext_php__)->create();
              }
              exit();
          }
          else if (file_exists($path.__ext_html__))
          {
             include $path.__ext_html__;
              if (__GF_LOG__)
              {
                  $log = new Log;
                  $log->setContent('run function errorPage() - Include File '.$path.__ext_html__)->create();
              }
             exit();
          }
          else
          {
              GF_Message::showError("6",$file.__ext_html__." or ".$file.__ext_php__); exit;
          }
      }

      public static function getHost()
      {
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
      }

      // ========================

      protected static function importFile($file)
      {
          $file = $file.__ext_php__;
          if (file_exists($file))
          {
              include $file;
          }
      }

      // ========================
  }

 class GF_Upload extends GF_File
 {
      private static $file_upload, $extension_file, $maximum_size, $path_upload, $original_name;

      private static $compress_image = 50;

      private static $file_name_upload  = false, $allow_upload = true, $type_file   = false;

      private static $image_only    = array(".png", ".gif", ".jpg", ".bmp",".jpeg");
      private static $danger_file   = array('.html','.php','.js','.exe','.php5','.php7','.htaccess');

      private static $file_multiple=array();

      private static $upload_multiple = false;

      public static function setImageOnly($file_format=array())
      {
         self::$type_file = true;
         if (count($file_format)>0 && is_array($file_format))
         {
            self::$image_only = $file_format;
         }
      }

      public static function setDangerFile($file_format = array())
      {
          if (count($file_format) > 0 && is_array($file_format))
          {
            self::$danger_file = $file_format;
          }
      }

      private static function setOriginalFileName()
      {
          if (isset($_FILES[self::$file_upload]["name"]))
          {
               self::$original_name =  $_FILES[self::$file_upload]["name"] ;
          }
      }
      public static function getOriginalFileName()
      {
         return self::$original_name;
      }

      public static function setCompressImage($value=50)
      {
          if (is_int($value))
          {
              self::$compress_image = $value;
          }
          else
          {
               GF_Message::showError("VALUE_COMPRESS_IMAGE",$value); exit;
          }
      }

      public static function setFileUpload($value)
      {
         if (is_array($value))
         {
             self::$file_upload = $value;
         }else{
            if (isset($_FILES[$value]))
            {
               self::$file_upload = $value;
               self::setOriginalFileName();
               self::setExtensionFile();
    
               if (self::$type_file)
               {
                   self::checkExtension() ? false : self::$allow_upload = false;
               }
            }
            else
            {
              self::$allow_upload = false;
              return false;
            }    
         }
      }

      public static function isImage()
      {
         if (self::$type_file)
         {
            if (in_array(self::$extension_file, self::$image_only))
            {
                 self::$allow_upload = true;
                 return true;
            }
            else
            {
                self::$allow_upload = false;
                return false;
            }
         }
         return true;
      }

      public static function isEmpty()
      {
          if (empty($_FILES[self::$file_upload]["name"]))
          {
             self::$allow_upload = false;
             return false;
          }
          else
          {
             return true;
          }
      }

      public  static function setMaxSize($value)
      {
        self::$maximum_size = $value;
      }

      public static function checkSize()
      {
        return ($_FILES[self::$file_upload]["size"] >= self::$maximum_size) ? true : false ;
      }


      public static function setFileName($value)
      {
           if (self::$allow_upload)
           {
                self::$file_name_upload = $value;
                return self::$file_name_upload;
           }
           else
           {
               return false;
           }
      }
      private static function setExtensionFile()
      {
         return (self::$allow_upload) ? self::$extension_file = strtolower(".".pathinfo(basename($_FILES[self::$file_upload]["name"]),PATHINFO_EXTENSION)) : false;
      }
      public static function getExtension(){
         return self::$extension_file;
      }
      private static function checkTypeFile()
      {
          return (self::$type_file==false) ? true : false;
      }
      public static function setMultipleUpload(){
          self::$upload_multiple = true;
      }

      public static function setPath($dirname='', $type=null )
      {
            if (self::$upload_multiple==false)
            {
                if (self::$allow_upload)
                {
                    if ($type==null)
                    {
                        $dirname = $dirname."/";
                        $_STORAGE_PATH_UPLOAD  = __STORAGE_DIR__.$dirname; 
                    }else{
                        $_STORAGE_PATH_UPLOAD = $dirname;
                    }
                   
                    if (! is_dir($_STORAGE_PATH_UPLOAD))
                    {
                       if (parent::createDirOnStorage($dirname));
                       {
                            if (! file_exists($_STORAGE_PATH_UPLOAD."index.html"))
                            {
                                $files  = fopen($_STORAGE_PATH_UPLOAD."index.html","w");
                                fwrite($files,self::$empty_file_content);
                                fclose($files);
                            }
                            if (self::$file_name_upload != false )
                            {
                                 self::$path_upload = $_STORAGE_PATH_UPLOAD.self::$file_name_upload.self::$extension_file;
                            }
                            else
                            {
                                self::$path_upload = $_STORAGE_PATH_UPLOAD.basename($_FILES[self::$file_upload]["name"]);
                            }
                       }
                    }
                    else
                    {
                      if (self::$file_name_upload != false)
                      {
                          self::$path_upload = $_STORAGE_PATH_UPLOAD.self::$file_name_upload.self::$extension_file;
                      }
                      else
                      {
                          self::$path_upload = $_STORAGE_PATH_UPLOAD.basename($_FILES[self::$file_upload]["name"]);
                      }
                    }
                }
            }else{
              
                if ($type==null)
                {
                    $dirname = $dirname."/";
                    $_STORAGE_PATH_UPLOAD  = __STORAGE_DIR__.$dirname; 
                }else{
                    $_STORAGE_PATH_UPLOAD = $dirname;
                }
                if (! is_dir($_STORAGE_PATH_UPLOAD))
                {   
                    if (parent::createDirOnStorage($dirname));
                    {
                         if (! file_exists($_STORAGE_PATH_UPLOAD."index.html"))
                         {
                             $files  = fopen($_STORAGE_PATH_UPLOAD."index.html","w");
                             fwrite($files,self::$empty_file_content);
                             fclose($files);
                         }
                         self::$path_upload = $_STORAGE_PATH_UPLOAD;
                    }
                }else{
                    self::$path_upload =$_STORAGE_PATH_UPLOAD;
                }
            }
      }
      public static function checkFileUpload()
      {
         return file_exists(self::$path_upload) ? true : false;
      }
      private static function checkExtension()
      {
         return (in_array(self::$extension_file, self::$image_only)) ? true : false ;
      }

      public static function do($function=null)
      {
           if (self::$upload_multiple)
           {
                $result=array();
                for ($i=0; $i < count(self::$file_upload) ; $i++) 
                { 
                    $file      =    $_FILES[self::$file_upload[$i]]["name"];
                    
                    $file_tmp  = empty($_FILES[self::$file_upload[$i]]["name"]) ? null : $_FILES[self::$file_upload[$i]]["tmp_name"];
                   
                    $result[$i]['name']              = self::$file_upload[$i];
                    $result[$i]['original_filename'] = $file;
                    $result[$i]['result']            = false;
                   
                    if ($file_tmp != null)
                    {
                        $extension = strtolower(".".pathinfo(basename($file),PATHINFO_EXTENSION));
                        $size = $_FILES[self::$file_upload[$i]]["size"];
                        $result[$i]['size'] = $size;
                        $result[$i]['extension'] =  $extension;
                         $file_name = self::$file_name_upload[$i] ? self::$file_name_upload[$i].$extension  : $file;
                        if ($size >= self::$maximum_size)
                        {
                            $result[$i]['result'] = false;
                            $S_M = round(self::$maximum_size / 1000);
                            $result[$i]['message'] = _upload_max_." ".$S_M." KB";
                            continue;
                        }

                        if (! self::$type_file)
                        {     
                               if (! in_array($extension,self::$danger_file))
                              {
                                    if (! file_exists(self::$path_upload.$file))
                                    {
                                       
                                        if (move_uploaded_file($file_tmp, self::$path_upload.$file_name))
                                        {
                                             $result[$i]['result']  = true;
                                             $result[$i]['message'] = _upload_success_." ".$file;
                                        }else{
                                             $result[$i]['result'] = false;
                                        }
                                   }else{
                                       $result[$i]['message'] = _upload_exist_." ".$file;
                                       $result[$i]['result'] = false;
                                   }
                              }else{
                                    $result[$i]['message'] = _upload_ignore_." ".$file;
                                    $result[$i]['result'] = false;
                                    continue;
                              }
                        }
                        else
                        {   
                              if (in_array($extension, self::$image_only))
                              {
                                  if (! file_exists(self::$path_upload.$file))
                                  {   
                                   
                                      $res = _compressImage($file_tmp, self::$path_upload.$file_name, self::$compress_image);
                                      if ($res)
                                      {
                                           $result[$i]['result'] = true;
                                           $result[$i]['message'] = _upload_success_." ".$file;
                                      }
                                  }else{
                                      $result[$i]['message'] = _upload_exist_." ".$file;
                                      $result[$i]['result'] = false;
                                  }
                              }else{
                                   $result[$i]['message'] = __upload_image__." ".$file;
                                   $result[$i]['result'] = false;
                              } 
                        }
                    }
                    else{
                        $result[$i]['result'] = false;
                    }
                }
                return $result;
           }
           else{
                    $file_name_temp;
                    if (self::$file_name_upload != false)
                    {
                        $file_name_temp = self::$file_name_upload.self::$extension_file;
                    }
                    else
                    {
                        $file_name_temp = $_FILES[self::$file_upload]['name'];
                    }
            
                    if (self::$allow_upload==false)
                    {
                        return false;
                    }
                    else if(empty(self::$path_upload))
                    {
                        return ($function != null ) ? call_user_func($function,_upload_empty_) : _upload_empty_;
                        
                    }
                    else if (! self::checkFileUpload())
                    {
                        if (! self::checkSize())
                        {
                            if (in_array(self::$extension_file, self::$danger_file))
                            {
                                return ($function != null ) ?  call_user_func($function,_upload_ignore_.self::$original_name) : _upload_ignore_.self::$original_name;
                            }
                            else
                            {
                                if (self::$type_file)
                                {
                                    $compress = _compressImage($_FILES[self::$file_upload]['tmp_name'], self::$path_upload, self::$compress_image);
                                    if ($compress)
                                    {
                                        return ($function != null ) ?  call_user_func($function,_upload_success_.$file_name_temp) : _upload_success_.$file_name_temp;
                                    }
                                    else
                                    {
                                        return ($function!=null) ? call_user_func($function,_upload_failed_) : _upload_failed_;   
                                    
                                  }
                                }
                                else
                                {
                                    if (move_uploaded_file($_FILES[self::$file_upload]['tmp_name'], self::$path_upload))
                                    {
                                        return ($function != null) ? call_user_func($function,_upload_success_.$file_name_temp) : _upload_success_.$file_name_temp;
            
                                    }
                                    else
                                    {
                                         return ($function != null) ? call_user_func($function,_upload_failed_) : _upload_failed_;
                                    }
                                }
                            }
                        }
                        else
                        {
                        $size_maxium = round(self::$maximum_size / 1000);
                         return ($function != null) ? call_user_func($function,_upload_max_.$size_maxium." KB") : _upload_max_.$size_maxium." KB";
                        }
                    }
                    else
                    {
                        if ($function!=null)
                        {
                            return call_user_func($function,_upload_exist_.$file_name_temp);
                        }
                        else
                        {
                            return _upload_exist_.$file_name_temp;
                        }
                    }
           }
      }
  }

  class prettyPost
  {
      private $post, $first_line, $count_line;
      private $data = array();

      function __construct($str = '')
      {
          $p = new HTML_Generator($str);
          $text = $p->getText();
          $str =  ($this->checkLastHastag($text)) ? rtrim($str, "#") : $str; 
          $this->post = (trim($str));
          $this->countHastag();
          if ($this->count_line > 0)
            {
                $this->setFirstLine();
                if ($this->parsePost() == false)
                  {
                    GF_Message::showError("MaxPost",$str); exit;
                  }
                }
                else
                {
                $this->data = array(
                  $str
                );
            }
      }

    private function checkLastHastag($str)
    {
        if (empty($str))
        {
          return false;
        }
        else
        {
          $last_str = $str[strlen($str) - 1];
          return $last_str == '#' ? true : false;
        }
    }

      public function setFirstLine()
      {
          $result_first_line = explode('#', $this->post);
          $this->first_line = $result_first_line[0];
      }

      public function getFirstLine()
      {
           return $this->first_line;
      }

    private function countHastag()
    {
        $this->count_line = substr_count($this->post, '#');
        return $this->count_line;
    }

    public function parsePost()
    {
        $result_uri = explode('#', $this->post);
        $count_uri = count($result_uri);
        if ($this->count_line == 0)
        {
          return false;
        }
        else
        {
            $start_slice = $count_uri;
            for ($i=1; $i < 13 ; $i++) 
            {  
                if ($this->count_line = $i)
                {
                     $this->data =  array_slice($result_uri,0,$start_slice);
                     return true;
                     break;
                }
                $start_slice = $start_slice + 1;
            } 
        }
                
    }

    public function getData()
    {
        return array_map('trim', $this->data);
    }
}


class GF_Request
{
    private static $request_post     = array();
    private static $request_get      = array();
    private static $token_name       = '_TOKEN_';

    public static function everythingPost()
    {
        return (isset($_POST)) ? self::$request_post = array_map('trim', $_POST) : false;
    }

    public static function clean($key=null)
    {
        if ($key != null)
        {
            unset($_POST[$key]);
            return true;
        }
        else
        {
            unset($_POST);
            return false;
        }
    }

    public static function get($val='')
      {
          if (is_array($val))
          {
              for ($i=0; $i < count($val) ; $i++) 
              {
                self::$request_get[$val[$i]]= isset($_GET[$val[$i]]) ? _replaceHtml(trim($_GET[$val[$i]])) : false;
              }
          }
          else if (is_string($val))
          {
              $v = isset($_GET[$val]) ? _replaceHtml(trim($_GET[$val])) : false;
              self::$request_get = array($val=>$v);
          }
      }

    public static function post($str='')
    {
          $result_hastag = substr_count($str, '#');
          $xsrf = isset($_POST[self::$token_name]) ? $_POST[self::$token_name] : false;

          ($xsrf==_TOKEN_) 
          ? self::$request_post[self::$token_name] = $xsrf 
          : self::$request_post[self::$token_name] = false;
          
          if ( $result_hastag > 0 )
          {
              $p    = new prettyPost($str);
              $data = $p->getData();

              $count_post = count($data);
              for ($i=0; $i < $count_post; $i++)
              {
                  if (isset($_POST[$data[$i]]) && _requestMethod())
                  {
                     if (! empty(trim($_POST[$data[$i]])))
                     {
                         self::$request_post[$data[$i]] = ($_POST[$data[$i]]);
                     }
                     else
                     {
                         self::$request_post[$data[$i]] = false ;
                     }
                  }
                  else
                  {
                    self::$request_post[$data[$i]] = false ;
                  }
              }
          }
          else if ($result_hastag == 0)
          {
             if (isset($_POST[$str]))
             {
                self::$request_post[$str] = $_POST[$str];
             }
             return true;
          }
    }

    public static function getPost($key)
    {
        return array_search($key, self::$request_post);
    }

    public static function getGet($key)
    {
        return array_search($key, self::$request_get);
    }

    public static function getAllPost()
    {
      return (count(self::$request_post)>0) ? self::$request_post : false;
    }

    public static function getAllget()
    {
       return (count(self::$request_get)>0) ? self::$request_get : false;
    }

    public static function checkPost()
    {
      if (array_search(false,self::$request_post)) {return false; } else {return true; }
    }

    public static function checkGet()
    {
       if (array_search(false,self::$request_get)) {return false; } else {return true; }
    }

}

class GF_Encrypt_Decrypt
{
    private $secret_key = 'A1B2MKSASKASO202KAMNNASDAMBAJASD2O1232JSD',$secret_iv  = 'GASGK2312NBASDMAS12B1323KASD';
    private $encrypt_method = 'AES-256-CBC',$hash_type  ='snefru';
    private $value;

    private $key,$iv;
    
    private $allHash = array( 'md2', 'md4', 'md5', 'sha1', 'sha256', 'sha384', 'sha512', 'ripemd128', 'ripemd160', 'ripemd256', 'ripemd320', 'whirlpool', 'tiger128,3', 'tiger160,3', 'tiger192,3', 'tiger128,4', 'tiger160,4', 'tiger192,4', 'snefru', 'gost', 'adler32', 'crc32', 'crc32b', 'haval128,3', 'haval160,3', 'haval192,3', 'haval224,3', 'haval256,3', 'haval128,4', 'haval160,4', 'haval192,4', 'haval224,4', 'haval256,4', 'haval128,5', 'haval160,5', 'haval192,5', 'haval224,5', 'haval256,5'
    );

    public function getAllHash(){
        return $this->allHash;
    }

    public function setKey($v){
      $this->secret_key = $v;
    }

    public function setValue($v){
      $this->value = $v;
      return $this;
    }

    public function setHasType($v){
       $this->hash_type = $v;
    }

    public function getHashType(){
       return $this->hash_type;
    }

    public function setIv($v){
      $this->secret_iv;
    }

    public function setEncryptMethod($v){
        $this->encrypt_method = $v;
    }

    public function encrypt(){
      $this->calculate();
      return base64_encode(openssl_encrypt($this->value, $this->encrypt_method, $this->key, 0, $this->iv));
    }

    private function calculate(){
      $this->key = hash($this->hash_type, $this->secret_key);
      $this->iv  = substr(hash($this->hash_type, $this->secret_iv), 0, 16);
    }

    public function decrypt(){
      $this->calculate();
      return openssl_decrypt(base64_decode($this->value), $this->encrypt_method, $this->key, 0, $this->iv);
    }
}


 class GF_Thumbnail extends GF_File
 {
      private $path = false;
      private $url  = false;
      private $type_image = 'image/jpeg';
      private $extension_file = false;

      // Path false, URL true
      private $is_path_or_url=null;


      private $path_url = false;

      public function __construct($v = false)
      {
          $this->setPathUrl($v);
      }

      private function setPathUrl($v)
      {
          $this->path_url = $v;
      }

      private function setImage()
      {
          try {
             if (file_exists($this->path_url))
            {
                $this->path = $this->path_url;
                $type_file = _getFileType($this->path);
                $this->extension_file = $type_file;
                $this->setType($type_file);
                $this->is_path_or_url = false;
                return $this;
            }else if (file_get_contents($this->path_url)){
                $this->url = $this->path_url;
                $this->extension_file = 'png';
                $this->setType($this->extension_file);
                $this->is_path_or_url = true;
                return $this;
            }
            else{
                $this->is_path_or_url = null;
            }
          } catch (Exception $e) {
            trigger_error('Uppzz ! Something is wrong while try to load image !',$e);
            exit;
          }
           
      }

      public function isReady()
      {
         if ($this->path != false)
         {
            return file_exists($this->path) ? true : false;
         }else{
            return file_get_contents($this->url) ? true : false;
         }
      }

      public function getExtensionFile(){
          return $this->extension_file;
      }

      protected function setType($v)
      {
            switch ($v) {
              case 'jpg':
                $this->type_image = 'image/jpeg';
                break;
              case 'png':
                $this->type_image = 'image/png';
              case 'gif':
                $this->type_image = 'image/gif';
              default:
                $this->type_image = 'image/jpeg';
                break;
            }
            return $this;
      }

      public function render()
      {
           $this->setImage();
           if ($this->is_path_or_url==false || $this->is_path_or_url==true)
           { 
                  header('Content-Type: '.$this->type_image);
                  if ($this->is_path_or_url)
                  {
                        $set = 
                        [
                            "ssl" => 
                            [
                                "verify_peer"      => false,
                                "verify_peer_name" => false,
                            ]
                        ];  
                        echo file_get_contents($this->url,false,stream_context_create($set));
                  }else{
                     
                      $img;
                      switch ($this->extension_file) 
                      {
                          case 'jpg':
                            $img = imagecreatefromjpeg( $this->path );
                            imagejpeg($img);
                            break;
                          case 'png':
                            $img = imagecreatefrompng( $this->path );
                            imagepng($img);
                          case 'gif':
                            $img = imagecreatefromgif( $this->path );
                            imagegif($img);
                          default:
                            return;
                            break;
                      }
                      imagedestroy($img);
                  }
           }
           return $this;
      }
 }

class GF_IP_Address 
{
    private  $IP_Address,$blok_IP;
    private  $dataBlokIP  = array(),$page401     = true;
    private  $file_name = false;
  
    private  $api_url = 'https://api.ipify.org';

    public function setApiUrl($v=null){
         $this->api_url = $v;
          return $this;
    }

     public function setBlokIPAddress($v){
        $this->dataBlokIP = $v;
         return $this;
    }


    public  function getIPAddress()
    {
         if (_checkInternet())
         {
             return $this->IP_Address = file_get_contents($this->api_url);
         }else{
             $this->IP_Address = null;
             return false;
         }
    }

    public function enabledPage401(){
    	 $this->page401 = true;
        return $this;
    }

    public function disabledPage401(){
    	 $this->page401 = false;
        return $this;
    }

    public function blokIPAddress(){
        if (is_array($this->dataBlokIP))
        {
        	$status = array_search($this->IP_Address,$this->dataBlokIP,true);
            $status = ($status!=false) ? $status=true : $status = false;
            if ($status)
            {
      				GF_Router::errorPage(__401_Page__);
      				exit;
            }else{
            	return false;
            }
        }else{
        	return false;
        }
    }

    public function setFileName($v){
    	$this->file_name = $v;
       return $this;
    }

    public function saveIPAddress(){
         if ($this->IP_Address != null && $this->dataBlokIP != false){
			 	      $file   = new \GF_Text\File_Generator;
	            $status = array_search($this->IP_Address,$this->dataBlokIP,true);
	            $status = ($status!=false) ? $status=true : $status = false;
	           
	            $result = array(
                  'IP_Address'     => $this->IP_Address,
                  'Date_Created'   => _getDate('d/m/Y'),
                  'Time_Created'   => _getTime('h:i:s'),
                  'API_URL'        => $this->api_url,
                  'Data_IP_Block'  => $this->dataBlokIP,
                  'Status_Blocked' => $status
              );
	            $result = json_encode($result);
	            $file->setData($result);
	            $file->setPath(__LOG_DIR__);

              $filename = ($this->file_name==false) ? 'LOG_BLOCKED_IP_ADDRESS-'._getDate('Y-m-d')."#"._getTime('h-i')."#"._randomStr(6).".txt" : $this->file_name.".txt";
	            $file->setFile($filename);
	            $file->create();
               return $this;
          }else{
              return false;
          }
    }
}

class GF_Prepare extends GF_Router
{

    private static function callAuth()
    {
        include __VALIDATION_DIR__.$GLOBALS['_validation_file_'].__ext_php__;
    }

    protected static function callAny(array $data)
    {
        \System\GF_Prepare::callDriver(
          [
            'index',
            'sqlite',
            'postgresql',
            'mysqli',
            'pdo'
          ]
        );
        $count_helper = count($data['helper']);

        for ($i=0; $i < $count_helper ; $i++) 
        {
          self::setHelper($data['helper'][$i]);
        }

        self::callAuth();

        $count_router = count($data['router']);

        if ($count_router==0)
        {
           GF_Message::showError('ROUTER_NULL'); exit;
        }
        else
        {
            self::enabledApi();

            self::callApi($data['api']);

            self::disabledApi();

            for ($i=0; $i < $count_router ; $i++) 
            {
                self::setRouter($data['router'][$i]);
            }
        }
    }

    private static function callApi($file=null)
    {
        if ($file != null)
        {
           $path = __ROUTER_DIR__.'api/';
           for ($i=0; $i < count($file) ; $i++) 
           { 
              _importFile($path.$file[$i]);
           }
        }
    }

    protected static function multiLanguage($multi_language)
    {
        $index      = array_search(_getCookie(__COOKIE_KEY_LANGUAGE__),$multi_language['language_name']);
        $index ? self::setLanguage($multi_language['language_file'][$index]) : self::setLanguage($multi_language['language_file'][0]);
    }

    public static function callMultiLanguage($multi_language){
          if ($GLOBALS['multi_language'])
          {
              _def(
                '__COOKIE_KEY_LANGUAGE__',
                $GLOBALS['cookie_multi_language']
              );
            
            if (_checkCookie(__COOKIE_KEY_LANGUAGE__))
            {
                \System\GF_Prepare::multiLanguage($multi_language);
            }
            else
            {
               _createCookie(
                  $GLOBALS['cookie_multi_language'], 
                  $multi_language['language_name'][0]
               );
              _refreshAndExit();
            }
          }
          unset($GLOBALS['cookie_multi_language'],$GLOBALS['default_language']);
    }

    protected static function callDriver($data,$filename='')
    {
         if (is_array($data))
         {
            for ($i=0; $i < count($data) ; $i++) 
            { 
              self::setDatabase($data[$i]);
            }
         }
    }

    public static function defineAllUrl(array $GF_PATH)
    {
          _def('__full_url__',_fullUrl());
          _def('__app_url__',__full_url__.$GF_PATH['GF_APP_DIR']);
          _def('__storage_url__',__app_url__.$GF_PATH['GF_Storage_DIR']);
          _def('__view_url__',__app_url__.$GF_PATH['GF_View_DIR']);
          _def('__external_url__',__app_url__.$GF_PATH['GF_External_DIR']);
          _def('__library_url__',__app_url__.$GF_PATH['GF_Library_DIR']);
          _def('__model_url__',__app_url__.$GF_PATH['GF_Model_DIR']);
          _def('__helper_url__',__app_url__.$GF_PATH['GF_Helper_DIR']);
          _def('__router_url__',__app_url__.$GF_PATH['GF_Router_DIR']);
          _def('__controller_url__',__app_url__.$GF_PATH['GF_Controler_DIR']);
          _def('__migration_url__',__app_url__.$GF_PATH['GF_Migration_DIR']);
          _def('_____CONFIG_____',$GF_PATH['GF_Config']);
    }

    public static function ready(array $setup)
    {
        register_shutdown_function('_shutdownGF');
        ($setup[0]) ?  self::errorPage($setup[1]) : self::importFile(__CONFIG_DIR__.'config');
    }

}
