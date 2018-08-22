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
namespace GF_Text;
defined('sys_run_app') OR exit('403 - Access Forbidden');

abstract class Text
{ 
    protected $text,$obj;
    protected $data = array();
    private   $danger_text = array("<!--");

    public function __construct($text='')
    {
       if (is_array($text))
       {
           $str = str_replace($this->danger_text[0], "",$text);
           $this->data = $str;
       }
       else if (is_string($text))
       { 
           $_text = str_replace($this->danger_text[0], "", $text);
           $_text = _replaceHtml($_text);
           $this->text = trim($_text);
       }
       else if (is_object($text))
       {
           $this->obj = $text;
       }
    }
}

class JSON_Generator extends Text
{
  protected $obj_json;

  public function createJson()
  {
     return json_encode($this->data);
  }
  public function parseJson()
  {
      $obj = json_decode($this->text);
      return json_last_error() === JSON_ERROR_NONE ? $this->obj_json = $obj : false;
  }

  public function getValue($key)
  {
    try 
    {
      return $this->obj_json->{$key} ? $this->obj_json->{$key} : false;
    } 
    catch (Throwable $e) 
    {
       return false;
    }
   
  }

  public function getValByObj($key)
  {
      try 
      {
        return $this->obj->{$key} ? $this->obj->{$key} : false;
      } 
      catch (Throwable $e) 
      {
          return false;
      }
  }
}
        
class HTML_Generator extends Text
{
    public function decodeHtml()
    {
      return htmlentities($this->text);
    }
    public function getText()
    {
    	return $this->text;
    }
    public function renderHtml()
    {
      return htmlspecialchars_decode($this->text);
    }
}

  class File_Generator
  {
    private $content_data,
            $file_name, 
            $message_die = "Unable to open file !",
            $length_file = false,
            $path_file=null;

    public function setData($content)
    {
        if ($content)
        {
          $this->content_data = $content;
        }
    }

    public function setMessageDie($value = "")
    {
        $this->message_die = $value;
    }

    public function setFile($value = 'default.txt')
    {
        $this->file_name = $value;
    }

    public function setPath($v=null){
        $this->path_file = $v;
    }

    public function create()
    {
      if (is_array($this->file_name))
        {
          for ($i=0; $i < count($this->file_name) ; $i++) 
          {   
                if ($this->path_file==null)
                {
                     $fn =  __STORAGE_DIR__.$this->file_name[$i] ;
                }else{
                     $fn =  $this->path_file.$this->file_name[$i] ;
                }
               
                if (strpos($fn, '/') !== false)
                {
                    if (! is_dir(dirname($fn,1)))
                    {
                      mkdir(dirname($fn,1), 0777, true); 
                    }
                }
                $file   = fopen($fn, "w") or die($this->message_die." : ".$this->file_name);
                fwrite($file, $this->content_data);
                fclose($file);
                return true;
          }
        }
        else
        {
            if ($this->path_file==null)
            {
                $file   = fopen(__STORAGE_DIR__.$this->file_name, "w") or die($this->message_die);
            }else{
                $file   = fopen($this->path_file.$this->file_name, "w") or die($this->message_die);
            }
            fwrite($file, $this->content_data);
            fclose($file);
            return true;
        } 
    }

    public function read()
    {
        if (file_exists(__STORAGE_DIR__.$this->file_name))
        {
            $file = fopen(__STORAGE_DIR__.$this->file_name, "r") or die($this->message_die." : ".$this->file_name);
            if ( ($this->length_file != false ) && is_numeric($this->length_file))
            {
              return fgets($file,$this->length_file);
            }
            else
            {
              return fgets($file);
            }
            fclose($file);
        }
        else
        {
          return false;
        }
    }

    public function setLength($value)
    {
      if (is_numeric($value))
      {
        $this->length_file = $value;
      }
    }
}
class Captcha_Generator_Simple
{
      protected $text,$bg_colour,$font_colour;
      protected $lebar  = 100,$tinggi = 50;
      protected $session_name_c;

      private $rgb_bg = array(44, 62, 80 ),$rgb_fc = array(236, 240, 241);


      public function setCaptchaSession($str=false)
      {
          if ($str==false)
          {
              $this->session_name_c = "GF_Captcha";
          }else{
              $this->session_name_c = $str;
          }
          return $this;
      }

      public function __construct()
      {
          $this->setText();
          $this->setBackgroundColour();
          $this->setFontColour();
      }

      protected function setText()
      {
           $this->text = strtoupper(_randomStr(8));
           return $this;
      }

      public function setBackgroundColour($data=null)
      { 
          $ar = $this->rgb_bg;
          if ($data==null)
          {
              $this->bg_colour = $ar;
          }else{
              if (is_array($data))
              {
                  if (count($data)==3)
                  {
                      $this->bg_colour = $data;
                  }else{
                      $this->bg_colour = $ar;
                  }
              }else{
                  $this->bg_colour = $ar;
              }
          }
          return $this;
      }

      public function setFontColour($data=null)
      { 
          $ar = $this->rgb_fc;
           if ($data==null)
          {
              $this->font_colour = $ar ;
          }else{
              if (is_array($data))
              {
                  if (count($data)==3)
                  {
                      $this->font_colour = $data;
                  }else{
                      $this->font_colour = $ar ;
                  }
              }else{
                  $this->font_colour =  $ar ;
              }
          }
          return $this;
      }


      public function render()
      {
            header("Content-type: image/png");

            $img = imagecreate($this->lebar,$this->tinggi);

            $bg_colour  = imagecolorallocate($img,$this->bg_colour[0], $this->bg_colour[1], $this->bg_colour[2]);

            $font_color = imagecolorallocate($img,$this->font_colour[0], $this->font_colour[1], $this->font_colour[2]);

            imagefill($img, 5, 5, 15);

            imagestring($img,65,15,17 ,$this->text,$font_color);

            imagerectangle($img,1,1,98,48,55);
            
            _createSession($this->session_name_c,$this->text);
            imagepng($img);
            
            imagedestroy($img);
      }

}
   
class Captcha_Generator_Sum extends Captcha_Generator_Simple
{
      protected $lebar = 120,$tinggi = 50;
      private $rgb_bg = array(44, 62, 80),$rgb_fc = array(236, 240, 241);

      public function render()
      {
          header("Content-type: image/png");
          $img = imagecreate($this->lebar,$this->tinggi);

          $warna = imagecolorallocate($img,$this->bg_colour[0], $this->bg_colour[1], $this->bg_colour[2]);

          $font_color = imagecolorallocate($img,$this->font_colour[0], $this->font_colour[1], $this->font_colour[2]);

          imagefill($img, 5, 5, 15);

          $aA = rand(1, 52);
          $bB = rand(1, 52);
          $rs = $aA + $bB;
          $t = $aA." + ".$bB." = ? ";
          imagestring($img,16,15,15,$t ,$font_color);

          imagerectangle($img,1,1,118,48,151);

          _createSession($this->session_name_c,$rs);
          imagepng($img);
         
          imagedestroy($img);
      }
  
}

class Captcha_Generator_Perkalian extends Captcha_Generator_Simple
{
      protected $lebar = 120,$tinggi = 50;
      private $rgb_bg = array(212, 60, 60),$rgb_fc = array(236, 240, 241);
      public function render()
      {
          header("Content-type: image/png");
          $img = imagecreate($this->lebar,$this->tinggi);

          $warna = imagecolorallocate($img,$this->bg_colour[0], $this->bg_colour[1], $this->bg_colour[2]);

          $font_color = imagecolorallocate($img,$this->font_colour[0], $this->font_colour[1], $this->font_colour[2]);

          imagefill($img, 5, 5, 15);

          $aA = rand(1, 10);
          $bB = rand(1, 10);
          $rs = $aA * $bB;
          $t = $aA." x ".$bB." = ? ";
          imagestring($img,16,15,15,$t ,$font_color);
          imagerectangle($img,1,1,118,48,151);
          _createSession($this->session_name_c,$rs);
          imagepng($img);
          imagedestroy($img);
      }
}
  
class GF_Xml 
{
    private $path,$content,$obj,$type;

    public function setXml($v)
    {
          if (_isUrl($v))
          {
            $this->type = true;
            $this->path = $v;
          }
          else
          {
              if (file_exists($v))
              {
                $this->path = $v; 
                $this->type = false;
              }
              else
              {
                $this->type = null;
              }
          }
          return $this;
    }

    private function setContent()
    {
        $this->content = file_get_contents($this->path);
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function parseXml()
    {
        if ($this->path != false)
        {
          $this->setContent();
          $this->obj  = simplexml_load_string($this->content);
        }
        return $this;
    }

    public function getXml()
    {
      return $this->obj;
    }

    public function getJson()
    {
      return json_encode($this->obj);
    }
}


class GF_Log 
{
  public  $content_log,$name_file,$log;

  public  function __construct(){
       $this->log =  new File_Generator;
       $d = _getDate("d-m-Y");
       $t = _getTime('h-i');
       $url = defined('__THIS_URL__') ? __THIS_URL__ : '';
       $file_name = "Log_".$d."#".$t."#"._randomStr(5).'.txt';
       $this->setFileName($file_name);
       $this->log->setPath(__LOG_DIR__.$file_name);

  }

  public  function setFileName($v=null){
       ($v!=null) ? $this->name_file = $v : false;
       return $this;
  }

  public  function setContent($v=null){
      ($v!=null) ? $this->content_log = "["._getDate().'-'._getTime()."] ".$v : false;
      return $this;
  }

  public  function create(){
      $this->log->setData($this->content_log);
      $this->log->create();
      return $this;
  }
}

