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

$GLOBALS['cmd_list'] = array(
	"lock_computer"			=> "rundll32.exe user32.dll, LockWorkStation",
	"shutdown_computer"		=> "shutdown /s /t 0",
	"open_registry_editor"	=> "regedit",
	"open_notepad"			=> "notepad",
	"open_explorer"			=> "explorer",
	"open_gpedit"			=> "gpedit.msc",
	"open_calculator" 		=> "calc"
);

if (! function_exists('_refreshAndExit'))
{
	function _refreshAndExit(){
	    header("refresh:0");
	    exit();
	}
}


if (! function_exists('_PHPMailer'))
{
	function _PHPMailer()
	{
		\System\GF_Router::importLibrary('PHPMailer/index');
		return new \Garuda\Library\Email;
	}
}

if (! function_exists('_importFile'))
{
	function _importFile($filename=''){
		if (is_array($filename))
		{
			for ($i=0; $i < count($filename) ; $i++) { 
				if (file_exists($filename[$i]).__ext_php__){
					require_once $filename[$i].__ext_php__;
				}
			}
		}else{
			if (file_exists($filename.__ext_php__))
			{
				require_once $filename.__ext_php__;
			}
		}
	}
}

if (! function_exists('_generateToken'))
{
	function _generateToken()
	{
		$token = _randomStr(15).'-'._md5(_randomStr(5)).'-'.sha1(_randomStr(5));
		if (! _checkSession('_TOKEN_'))
		{
			_def("_TOKEN_",$token);
			_createSession('_TOKEN_',_TOKEN_);
		}else{
			_def("_TOKEN_",$_SESSION['_TOKEN_']);
		}
	}
}


if (! function_exists('_getViewPath'))
{
	function _getViewPath($file)
	{
		return [__VIEW_DIR__.strtolower($file).__ext_php__,
				__VIEW_DIR__.strtolower($file).__ext_html__];
	}
}

if (! function_exists('_getViewTemplatePath'))
{
	function _getViewTemplatePath($file)
	{
		$const = '.garuda';
		return __VIEW_DIR__.strtolower($file).$const.__ext_php__;
	}
}


if (! function_exists('_importClass'))
{
	function _importClass($data='',$callback='')
	{
		$path = isset($data['path']) ? $data['path'] : null;
		$file = isset($data['filename']) ? $data['filename'] : null;
		if ($path != null && $file != null)
		{
			if (file_exists($path.$file.__ext_php__)){
				require_once $path.$file.__ext_php__;
				if (class_exists($file))
				{
					return (is_callable($callback)) ? 
							call_user_func($callback,new $file()) :
							new $file();
				}else{
					System\GF_Message::showError(null,'_importClass - Class 
							<font color="red"> '.$file.' </font> not found !'); 
					exit;
				}
			}
			else
			{
				System\GF_Message::showError(null,'_importClass - File  
							<font color="red"> '.$path.$file.__ext_php__.' </font> not found !'); 
				exit;
			}
		}
	}
}

if (! function_exists('_e'))
{
	function _e($v)
	{
		echo $v;
	}
}

if (! function_exists('toString'))
{		
	function toString($o=''){
		return (is_object($o)) ? '' : (string) $o;
	}
}

if (! function_exists('_fullUrl'))
{
	function _fullUrl()
	{
		(__DIR_NAME__=='') ? $_dir = '/' : $_dir = '/'.__DIR_NAME__."/";
		return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$_dir;
	}
}

if (! function_exists('_parameter'))
{
	function _parameter(){
		return substr(_____STR_URL_____,1,strlen(_____STR_URL_____));
	}
}

if (! function_exists("_CMD"))
{
	function _CMD($command=null)
	{
		 if ($command==null)
		 {
		 	return json_encode($GLOBALS['cmd_list']);
		 }else
		 {
		 	if (_searchKeyArray($GLOBALS['cmd_list'],$command))
		 	{
		 		echo exec($GLOBALS['cmd_list'][$command]);
		 	}else
		 	{
		 		echo exec($command);
		 	}
		 }
	}
}

if (! function_exists("_searchKeyArray"))
{
	function _searchKeyArray($arr, $keyS)
	{
	    foreach ($arr as $key => $item) {
	        if ($key == $keyS) {
	            return true;
	        }
	        else {
	            if (is_array($item) && findKey($item, $keyS)) {
	               return true;
	            }
	        }
	    }
	    return false;
	}
}

if (! function_exists("_curl"))
{
	function _curl($url)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
}

if (! function_exists("_startMicroTime"))
{
	function _startMicroTime()
	{
		list($u, $sc) = explode(" ", microtime());
		return ((float)$u + (float)$sc);
	}
}

if (! function_exists("_compressImage"))
{
	function _compressImage($source_url=false, $destination_url=false, $quality=50)
	{
		if ($source_url != false && $destination_url != false )
		{
			$info = getimagesize($source_url);
			switch ($info['mime']) {
				case 'image/jpeg':
					$image = imagecreatefromjpeg($source_url);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($source_url);
					break;
				case 'image/png':
					$image = imagecreatefrompng($source_url);
					break;
				default:
					$image = imagecreatefromjpeg($source_url);
					break;
			}
			imagejpeg($image, $destination_url, $quality);
			return true;
		}
	}
}

if (! function_exists("_sha1"))
{
	function _sha1($str=null)
	{
	  $result = trim($str);
	  return base64_encode(sha1($result));
	}
}

if (! function_exists("_requestMethod"))
{
	function _requestMethod($custom=null)
	{
		if ($custom==null)
		{
			return ($_SERVER["REQUEST_METHOD"] == "POST") ? true : false;
		}
		else
		{
			return ($_SERVER["REQUEST_METHOD"] == "GET") ? true : false;
		}
	}
}

if (! function_exists("_filterStrASCII"))
{
	function _filterStrASCII($str=null)
	{
	  return filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	}
}


if (! function_exists("_replaceSq"))
{
	function _replaceSq($val=null)
	{
		return str_replace("'", "", trim($val));
	}
}

if (! function_exists("_fixString"))
{
	function _fixString($str=null)
	{
	  $res = addslashes(trim($str));
	  $res = str_replace("%HASTAG%", "#",$res);
	  return $res;
	}
}

if (! function_exists("_replaceHtml"))
{
	function _replaceHtml($str=null){
		$remove_chr = array("</",">","<!--",'="',"='","<","<body bgcolor=");
		for ($i=0; $i < count($remove_chr) ; $i++)
		{
			$str = str_replace($remove_chr[$i]," ",$str);
		}
		return $str;
	}
}

if (! function_exists("_outputHTML"))
{
	function _outputHTML($str=null)
	{
	    $s  = Array("--", "*", "\*", "^", "\^");
	    $r  = Array("<\hr>", "<b>", "<\b>", "<sup>", "<\sup>");
	    echo str_replace($s, $r , $str);
	 }
}

if (! function_exists("_replaceMaster"))
{
	function _replaceMaster($str=null)
	{
		$res = str_replace("#", "%HASTAG%",$str);
		return str_replace("<?php", "tag php",$res);
	}
}

if (! function_exists("_md5"))
{
	function _md5($str=null)
	{
		$tot = strlen(trim($str));
		return md5($tot.$str.$tot);
	}
}

if (! function_exists("_unparseUrl"))
{
	function _unparseUrl($parsed_url=null)
	{
	  $sc   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
	  $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
	  $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
	  $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
	  $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
	  $pass     = ($user || $pass) ? "$pass@" : '';
	  $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
	  $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
	  $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
	  return "$sc$user$pass$host$port$path$query$fragment";
	}
}

if (! function_exists("_randomStr"))
{
	function _randomStr($length=10)
	{
		$c = '0123456789abcdefghijklmnopqrstuvwxyz';
		$cL = strlen($c);
		$rS = '';
		for ($i = 0; $i < $length; $i++) {
			$rS .= $c[rand(0, $cL - 1)];
		}
		return $rS;
	}
}
if (! function_exists("_randomInt"))
{
	function _randomInt($length=10)
	{
		$c = '123456789';
		$cL = strlen($c);
		$rS = '';
		for ($i = 0; $i < $length; $i++) {
			$rS .= $c[rand(0, $cL - 1)];
		}
		return $rS;
	}
}
if (! function_exists("_encode"))
{
	function _encode($str=null)
	{
		return base64_encode(trim($str));
	}
}

if (! function_exists("_decode"))
{
	function _decode($str=null)
	{
		return base64_decode(trim($str));
	}
}

if (! function_exists('_token'))
{		
	function _token()
	{
		return '<input value="'._TOKEN_.'" name="_TOKEN_" hidden="" type="text">';
	}	
}

if (! function_exists("_createSession"))
{
	function _createSession($key=null,$val=null)
	{
		if (is_array($key) && (is_array($val)))
		{
			$_SESSION[$key[0]] = array();
			$z=0;
			if (count($key) == count($val))
			{
				for ($i=0; $i < count($key) ; $i++) 
				{ 
					$_SESSION[$key[$z]][$key[$i]] = $val[$i];
				}
				return true;
			}else{
				return false;
			}	
		}
		else if (is_array($key) && (! is_array($val)))
		{
			$_SESSION[$key[0]] = array();
			$z=0;
			for ($i=0; $i < count($key) ; $i++) 
			{ 
				$_SESSION[$key[$z]][$key[$i]] = $val;
			}
			return true;
		}
		else{
			$_SESSION[$key] = $val;
			return true;
		}
		
	}
}

if (! function_exists("_checkSession"))
{
	function _checkSession($key=null)
	{
		return isset($_SESSION[$key]) ? true : false;
	}
}
if (! function_exists("_getSession"))
{
	function _getSession($key=null)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
	}
}

if (! function_exists("_checkCookie"))
{
	function _checkCookie($key=null)
	{
	    return isset($_COOKIE[$key]) ? true : false ;
	}
}
if (! function_exists("_getCookie"))
{
	function _getCookie($key=null)
	{
		return _checkCookie($key) ? $_COOKIE[$key] : false;
	}
}
if (! function_exists("_createCookie"))
{
	function _createCookie($var=null,$val=null,$lT=null)
	{
		$oH = 3600;
		if ($lT==null)
		{
			$lT = $oH * 24;
		}
		else
		{
			$oD = $oH * 24;
			$lT = $lT * $oD;
		}
		return setcookie("$var", "$val", time() + $lT, "/") ? true && $lT : false;
	}
}


if (! function_exists("_destroyCookie"))
{
	function _destroyCookie($var=null)
	{
		return setcookie("$var", "", -1, "/") ? true : false;
	}
}



if (! function_exists("_checkInternet"))
{
	function _checkInternet()
	{
		$connected = @fsockopen("www.google.com", 80);
		if ($connected) {$is_conn = true; fclose($connected); } else {$is_conn = false; } return $is_conn;
	}
}

if (! function_exists("_getFileType"))
{
	function _getFileType($val=null)
	{
		$ft = pathinfo(($val),PATHINFO_EXTENSION);
		return strtolower($ft);
	}
}

if (! function_exists("e"))
{
	function e($v=null)
	{echo $v; }
}

if (! function_exists("_bin2hex"))
{
	function _bin2hex(int $val=null)
	{
		$b = random_bytes($val);
	    return (bin2hex($b));
	}
}

if (! function_exists("_emoji"))
{
		/**
		 * Method Untuk Emoji PHP * Silahkan kustom sendiri sesuai kebutuhan
		 * @param  [type] $val []
		 * @return [type]      [string]
		 */
		function _emoji($val=null)
		{
			$_COPYRIGHT_SIGN = "\u{00A9}";
			$_OFFICE_BUILDING = "\u{1F3E2}";
			$_MENS_SYMBOL = "\u{1F6B9}";
			$_WOMENS_SYMBOL = "\u{1F6BA}";
			$_TOILET = "\u{1F6BD}";
			$_SHOWER = "\u{1F6BF}";
			$_BICYCLE = "\u{1F6B2}";
			$_WATER_CLOSET = "\u{1F6BE}";
			/*
			$_REGISTERED_SIGN = "\u{00AE}";
			$_MAHJONG_TILE_RED_DRAGON = "\u{1F004}";
			$_PLAYING_CARD_BLACK_JOKER = "\u{1F0CF}";
			$_NEGATIVE_SQUARED_LATIN_CAPITAL_LETTER_A = "\u{1F170}";
			$_NEGATIVE_SQUARED_LATIN_CAPITAL_LETTER_B = "\u{1F171}";
			$_NEGATIVE_SQUARED_LATIN_CAPITAL_LETTER_O = "\u{1F17E}";
			$_NEGATIVE_SQUARED_LATIN_CAPITAL_LETTER_P = "\u{1F17F}";
			$_NEGATIVE_SQUARED_AB = "\u{1F18E}";
			$_SQUARED_CL = "\u{1F191}";
			$_SQUARED_COOL = "\u{1F192}";
			$_SQUARED_FREE = "\u{1F193}";
			$_SQUARED_ID = "\u{1F194}";
			$_SQUARED_NEW = "\u{1F195}";
			$_SQUARED_NG = "\u{1F196}";
			$_SQUARED_OK = "\u{1F197}";
			$_SQUARED_SOS = "\u{1F198}";
			$_SQUARED_UP_WITH_EXCLAMATION_MARK = "\u{1F199}";
			$_SQUARED_VS = "\u{1F19A}";
			$_FLAG_FOR_ASCENSION_ISLAND = "\u{1F1E6}\u{1F1E8}";
			$_FLAG_FOR_ANDORRA = "\u{1F1E6}\u{1F1E9}";
			$_FLAG_FOR_UNITED_ARAB_EMIRATES = "\u{1F1E6}\u{1F1EA}";
			$_FLAG_FOR_AFGHANISTAN = "\u{1F1E6}\u{1F1EB}";
			$_FLAG_FOR_ANTIGUA_AND_BARBUDA = "\u{1F1E6}\u{1F1EC}";
			$_FLAG_FOR_ANGUILLA = "\u{1F1E6}\u{1F1EE}";
			$_FLAG_FOR_ALBANIA = "\u{1F1E6}\u{1F1F1}";
			$_FLAG_FOR_ARMENIA = "\u{1F1E6}\u{1F1F2}";
			$_FLAG_FOR_ANGOLA = "\u{1F1E6}\u{1F1F4}";
			$_TENNIS_RACQUET_AND_BALL = "\u{1F3BE}";
			$_SKI_AND_SKI_BOOT = "\u{1F3BF}";
			$_BASKETBALL_AND_HOOP = "\u{1F3C0}";
			$_CHEQUERED_FLAG = "\u{1F3C1}";
			$_SNOWBOARDER = "\u{1F3C2}";
			$_RUNNER = "\u{1F3C3}";
			$_SURFER = "\u{1F3C4}";
			$_SPORTS_MEDAL = "\u{1F3C5}";
			$_TROPHY = "\u{1F3C6}";
			$_HORSE_RACING = "\u{1F3C7}";
			$_AMERICAN_FOOTBALL = "\u{1F3C8}";
			$_RUGBY_FOOTBALL = "\u{1F3C9}";
			$_SWIMMER = "\u{1F3CA}";
			$_WEIGHT_LIFTER = "\u{1F3CB}";
			$_GOLFER = "\u{1F3CC}";
			$_RACING_MOTORCYCLE = "\u{1F3CD}";
			$_RACING_CAR = "\u{1F3CE}";
			$_CRICKET_BAT_AND_BALL = "\u{1F3CF}";
			$_VOLLEYBALL = "\u{1F3D0}";
			$_FIELD_HOCKEY_STICK_AND_BALL = "\u{1F3D1}";
			$_ICE_HOCKEY_STICK_AND_PUCK = "\u{1F3D2}";
			$_TABLE_TENNIS_PADDLE_AND_BALL = "\u{1F3D3}";
			$_SNOW_CAPPED_MOUNTAIN = "\u{1F3D4}";
			$_CAMPING = "\u{1F3D5}";
			$_BEACH_WITH_UMBRELLA = "\u{1F3D6}";
			$_BUILDING_RUCTION = "\u{1F3D7}";
			$_HOUSE_BUILDINGS = "\u{1F3D8}";
			$_CITYSCAPE = "\u{1F3D9}";
			$_DERELICT_HOUSE_BUILDING = "\u{1F3DA}";
			$_CLASSICAL_BUILDING = "\u{1F3DB}";
			$_DESERT = "\u{1F3DC}";
			$_DESERT_ISLAND = "\u{1F3DD}";
			$_NATIONAL_PARK = "\u{1F3DE}";
			$_STADIUM = "\u{1F3DF}";
			$_HOUSE_BUILDING = "\u{1F3E0}";
			$_HOUSE_WITH_GARDEN = "\u{1F3E1}";
			$_JAPANESE_POST_OFFICE = "\u{1F3E3}";
			$_EUROPEAN_POST_OFFICE = "\u{1F3E4}";
			$_HOSPITAL = "\u{1F3E5}";
			$_BANK = "\u{1F3E6}";
			$_AUTOMATED_TELLER_MACHINE = "\u{1F3E7}";
			$_HOTEL = "\u{1F3E8}";
			$_LOVE_HOTEL = "\u{1F3E9}";
			$_CONVENIENCE_STORE = "\u{1F3EA}";
			$_SCHOOL = "\u{1F3EB}";
			$_DEPARTMENT_STORE = "\u{1F3EC}";
			$_NO_ENTRY_SIGN = "\u{1F6AB}";
			$_SMOKING_SYMBOL = "\u{1F6AC}";
			$_NO_SMOKING_SYMBOL = "\u{1F6AD}";
			$_PUT_LITTER_IN_ITS_PLACE_SYMBOL = "\u{1F6AE}";
			$_DO_NOT_LITTER_SYMBOL = "\u{1F6AF}";
			$_POTABLE_WATER_SYMBOL = "\u{1F6B0}";
			$_NON_POTABLE_WATER_SYMBOL = "\u{1F6B1}";
			$_NO_BICYCLES = "\u{1F6B3}";
			$_BICYCLIST = "\u{1F6B4}";
			$_MOUNTAIN_BICYCLIST = "\u{1F6B5}";
			$_PEDESTRIAN = "\u{1F6B6}";
			$_NO_PEDESTRIANS = "\u{1F6B7}";
			$_CHILDREN_CROSSING = "\u{1F6B8}";
			$_RESTROOM = "\u{1F6BB}";
			$_BABY_SYMBOL = "\u{1F6BC}";
			$_BATH = "\u{1F6C0}";
			$_BATHTUB = "\u{1F6C1}";
			$_SPEAK_NO_EVIL_MONKEY = "\u{1F64A}";
			$_HAPPY_PERSON_RAISING_ONE_HAND = "\u{1F64B}";
			$_PERSON_RAISING_BOTH_HANDS_IN_CELEBRATION = "\u{1F64C}";
			$_PERSON_FROWNING = "\u{1F64D}";
			$_PERSON_WITH_POUTING_FACE = "\u{1F64E}";
			$_PERSON_WITH_FOLDED_HANDS = "\u{1F64F}";
			$_ROCKET = "\u{1F680}";
			$_HELICOPTER = "\u{1F681}";
			$_STEAM_LOCOMOTIVE = "\u{1F682}";
			$_RAILWAY_CAR = "\u{1F683}";
			$_HIGH_SPEED_TRAIN = "\u{1F684}";
			$_HIGH_SPEED_TRAIN_WITH_BULLET_NOSE = "\u{1F685}";
			$_TRAIN = "\u{1F686}";
			$_METRO = "\u{1F687}";
			$_LIGHT_RAIL = "\u{1F688}";
			$_STATION = "\u{1F689}";
			$_TRAM = "\u{1F68A}";
			$_TRAM_CAR = "\u{1F68B}";
			$_BUS = "\u{1F68C}";
			$_ONCOMING_BUS = "\u{1F68D}";
			$_TROLLEYBUS = "\u{1F68E}";
			$_BUS_STOP = "\u{1F68F}";
			$_MINIBUS = "\u{1F690}";
			$_AMBULANCE = "\u{1F691}";
			$_FIRE_ENGINE = "\u{1F692}";
			$_POLICE_CAR = "\u{1F693}";
			$_ONCOMING_POLICE_CAR = "\u{1F694}";
			$_TAXI = "\u{1F695}";
			$_FACE_SCREAMING_IN_FEAR = "\u{1F631}";
			$_ASTONISHED_FACE = "\u{1F632}";
			$_FLUSHED_FACE = "\u{1F633}";
			$_SLEEPING_FACE = "\u{1F634}";
			$_DIZZY_FACE = "\u{1F635}";
			$_FACE_WITHOUT_MOUTH = "\u{1F636}";
			$_FACE_WITH_MEDICAL_MASK = "\u{1F637}";
			$_GRINNING_CAT_FACE_WITH_SMILING_EYES = "\u{1F638}";
			$_CAT_FACE_WITH_TEARS_OF_JOY = "\u{1F639}";
			$_SMILING_CAT_FACE_WITH_OPEN_MOUTH = "\u{1F63A}";
			$_SMILING_CAT_FACE_WITH_HEART_SHAPED_EYES = "\u{1F63B}";
			$_CAT_FACE_WITH_WRY_SMILE = "\u{1F63C}";
			$_KISSING_CAT_FACE_WITH_CLOSED_EYES = "\u{1F63D}";
			$_POUTING_CAT_FACE = "\u{1F63E}";
			$_CRYING_CAT_FACE = "\u{1F63F}";
			$_WEARY_CAT_FACE = "\u{1F640}";
			$_SLIGHTLY_FROWNING_FACE = "\u{1F641}";
			$_SLIGHTLY_SMILING_FACE = "\u{1F642}";
			$_UPSIDE_DOWN_FACE = "\u{1F643}";
			$_FACE_WITH_ROLLING_EYES = "\u{1F644}";
			$_FACE_WITH_NO_GOOD_GESTURE = "\u{1F645}";
			$_FACE_WITH_OK_GESTURE = "\u{1F646}";
			$_PERSON_BOWING_DEEPLY = "\u{1F647}";
			$_SEE_NO_EVIL_MONKEY = "\u{1F648}";
			$_HEAR_NO_EVIL_MONKEY = "\u{1F649}";
			$_SPEAK_NO_EVIL_MONKEY = "\u{1F64A}";
			$_UNAMUSED_FACE = "\u{1F612}";
			$_FACE_WITH_COLD_SWEAT = "\u{1F613}";
			$_PENSIVE_FACE = "\u{1F614}";
			$_CONFUSED_FACE = "\u{1F615}";
			$_CONFOUNDED_FACE = "\u{1F616}";
			$_KISSING_FACE = "\u{1F617}";
			$_FACE_THROWING_A_KISS = "\u{1F618}";
			$_KISSING_FACE_WITH_SMILING_EYES = "\u{1F619}";
			$_KISSING_FACE_WITH_CLOSED_EYES = "\u{1F61A}";
			$_FACE_WITH_STUCK_OUT_TONGUE = "\u{1F61B}";
			$_FACE_WITH_STUCK_OUT_TONGUE_AND_WINKING_EYE = "\u{1F61C}";
			$_FACE_WITH_STUCK_OUT_TONGUE_AND_TIGHTLY_CLOSED_EYES = "\u{1F61D}";
			$_DISAPPOINTED_FACE = "\u{1F61E}";
			$_WORRIED_FACE = "\u{1F61F}";
			$_ANGRY_FACE = "\u{1F620}";
			$_POUTING_FACE = "\u{1F621}";
			$_CRYING_FACE = "\u{1F622}";
			$_PERSEVERING_FACE = "\u{1F623}";
			$_FACE_WITH_LOOK_OF_TRIUMPH = "\u{1F624}";
			$_DISAPPOINTED_BUT_RELIEVED_FACE = "\u{1F625}";
			$_FROWNING_FACE_WITH_OPEN_MOUTH = "\u{1F626}";
			$_ANGUISHED_FACE = "\u{1F627}";
			$_FEARFUL_FACE = "\u{1F628}";
			$_WEARY_FACE = "\u{1F629}";
			$_SLEEPY_FACE = "\u{1F62A}";
			$_TIRED_FACE = "\u{1F62B}";
			$_GRIMACING_FACE = "\u{1F62C}";
			$_LOUDLY_CRYING_FACE = "\u{1F62D}";
			$_FACE_WITH_OPEN_MOUTH = "\u{1F62E}";
			$_HUSHED_FACE = "\u{1F62F}";
			$_FACE_WITH_OPEN_MOUTH_AND_COLD_SWEAT = "\u{1F630}";
			$_FACE_SCREAMING_IN_FEAR = "\u{1F631}";
			*/
			$val = strtolower($val);

			switch ($val) {
				case 'copyright':
					return $_COPYRIGHT_SIGN;
					break;
				case 'office':
					return $_OFFICE_BUILDING;
					break;
				case 'mens':
					return $_MENS_SYMBOL;
					break;
				case 'womans':
					return $_WOMENS_SYMBOL;
					break;
				case 'toilet':
					return $_TOILET;
					break;
				case 'shower':
					return $_SHOWER;
					break;
				case 'bicycle':
					return $_BICYCLE;
					break;
				default:
					return $_WATER_CLOSET;
					break;
			}
		}
}


if (! function_exists("_createZip"))
{
	/**
	 * Method untuk membuat file ZIP
	 * @param  array  $file_want_to_zip [Nama File Yang Akan di Zip]
	 * @param  array  $file_name_to_zip [Nama File Zip]
	 * @param  string $filename_zip_end [Nama File Setelah di Zip]
	 * @param  string $direktori_to_zip [Lokasi Direktori Zip]
	 * @return [type]                   [boolean]
	 */
	function _createZip($file_want_to_zip = array(),$file_name_to_zip = array(),$filename_zip_end='default.zip',$direktori_to_zip='')
	{
		$zip = new ZipArchive;
		$path_zip    = __STORAGE_DIR__.$direktori_to_zip;

		if (! is_dir($path_zip))
		{
			mkdir($path_zip, 0777, true);
		}
		if ($zip->open($path_zip.$filename_zip_end ,  ZipArchive::CREATE))
		{

			$length_file_want_to_zip  = count($file_want_to_zip);
			$length_file_name_to_zip  = count($file_name_to_zip);

			if ($length_file_name_to_zip == $length_file_name_to_zip)
			{
				for ($i=0; $i < $length_file_want_to_zip ; $i++) {
					$zip->addFile(__STORAGE_DIR__.$file_want_to_zip[$i], $file_name_to_zip[$i]);
				}
			}
			else if ($length_file_name_to_zip==0)
			{
				for ($i=0; $i < $length_file_want_to_zip ; $i++) {
					$zip->addFile(__STORAGE_DIR__.$file_want_to_zip[$i], $file_want_to_zip[$i]);
				}
			}
			else
			{
				return false;
			}

			$zip->close();
			return true;
		}
		else
		{
			return false;
		}
	}
}

if (! function_exists("_destroySession"))
{
	function _destroySession($key='')
	{
		 if (! empty($key))
		 {
		 	 if (is_array($key))
		 	 {
		 	 	for ($i=0; $i < count($key) ; $i++) 
		 	 	{ 
		 	 		$o = $key[$i];
		 	 		if (isset($_SESSION[$o]))
		 	 		{
		 	 			unset($_SESSION[$o]);
		 	 		}
		 	 	}
		 	 	return true;
		 	 }
		     if (isset($_SESSION[$key]))
		     {
		        unset($_SESSION[$key]);
		        return true;
		     }
		     else
		     {
		       return false;
		     }
		 }
	}
}

if (! function_exists("_filter"))
{
	function _filter($str)
	{
	  return filter_var($str, FILTER_SANITIZE_STRING);
	}
}

if (! function_exists("_getDate"))
{
	function _getDate($custom=null,$time_zone=null)
	{
		if ($time_zone==null)
		{
			date_default_timezone_set(__Time_Zone__);
		}else{
			date_default_timezone_set($time_zone);
		}
	   ($custom==null) ?  $d  = date('Y/m/d') : $d   = date($custom);
	    return $d;
	}
}

if (! function_exists("_getTime"))
{
	function _getTime($custom=null,$time_zone=null)
	{
		if ($time_zone==null)
		{
			date_default_timezone_set(__Time_Zone__);
		}else{
			date_default_timezone_set($time_zone);
		}
		$custom == null ? $t = date('H:i') : $t = date($custom) ;
		return $t;
	}
}

if (! function_exists("_getYear"))
{
	function _getYear($time_zone=null)
	{
		if ($time_zone==null)
		{
			date_default_timezone_set(__Time_Zone__);
		}else{
			date_default_timezone_set($time_zone);
		}
		
		$y      = date('Y');
		return $y;
	}
}


if (! function_exists("_getMonth"))
{
	/**
	 * Method untuk mendapatkan nama bulan dalam bahasa indonesia
	 * @param  integer $bln [1-12]
	 * @return [type]       [String]
	 */

	function _getMonth($bln=false,$type="ind",$time_zone=null)
	{
		$month_eng = array("","January","February","March","April"
							  ,"May","June","July","August","September"
							  ,"October","November","December");

		$month_ind = array("","Januari","Februari","Maret","April"
							  ,"Mei","Juni","Juli","Agustus","September"
							  ,"Oktober","November","Desember");
		 if ($bln == false)
		  {
	  		if ($time_zone==null)
			{
				date_default_timezone_set(__Time_Zone__);
			}else{
				date_default_timezone_set($time_zone);
			}
		 
			$bln      = date('m');
			$bln      = ltrim($bln, '0');
		  }

		  if ($type=='ind')
		  {
		  	 return $month_ind[$bln];
		  }
		  else if ($type=='eng')
		  {
		  	 return $month_eng[$bln];
		  }
	}
}


if (! function_exists("_getDay"))
{
	/**
	 * Method untuk mendapatkan nama hari dalam bahasa indonesia
	 * @param  integer $bln [1-7]
	 * @return [type]       [String]
	 */
	function _getDay($hari=false,$type="ind",$time_zone=null)
	{
	  $day_ind   = array("","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");

	  $day_eng   = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

	  if ($hari == false)
	  {
	  	if ($time_zone==null)
		{
			date_default_timezone_set(__Time_Zone__);
		}else{
			date_default_timezone_set($time_zone);
		}
	  
		$hari      = date('N');
	  }

	  if ($type=='ind')
	  {
	  	 return $day_ind[$hari];
	  }
	  else if ($type=='eng')
	  {
	  	 return $day_eng[$hari];
	  }

	}
}

if (! function_exists("_isEmail"))
{
	function _isEmail($email=null)
	{
		return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
	}
}

if (! function_exists("_isUrl"))
{
	function _isUrl($url=null)
	{
		$url = filter_var($url, FILTER_SANITIZE_URL);
		if (filter_var($url, FILTER_VALIDATE_URL)) {return true; } else {return false; }
	}
}


if (! function_exists("_setLength"))
{
 	function _setLength($string='',$length=10)
     {
        $l = strlen($string);
        return ($l <= $length) ? true : false;
     }
}


if (! function_exists("_setNumber"))
{
     function _setNumber($number='',$custom=false)
     {
       if ($custom == false)
       {
           return (is_numeric($number)) ? $number : false;
       }
       else
       {
          if (is_numeric($number))
          {
              return (preg_match("/^[".$custom."]+$/", $number) == 1) ? $number : false;
          }
          else
          {
            return false;
          }
       }
    }
}


if (! function_exists("_setAlfabet"))
{
    function _setAlfabet($string='',$number=false)
    {
		 $a_to_z      =  array("a-zA-Z\s");
		 $one_to_nine =  array("0-9");
         if ($number==false)
         {
             return (preg_match("/^[".$a_to_z[0]."]+$/", $string) == 1) ? $string : false;
         }
         else if ($number==true)
         {
            return (preg_match("/^[".$a_to_z[0].$one_to_nine[0]."]+$/", $string) == 1) ? $string : false;
         }
         else if (is_string($number))
         {
         	  return (preg_match("/^[".$a_to_z[0].$number."]+$/", $string) == 1) ? $string : false;
         }
         else
         {
            return (preg_match("/^[".$a_to_z[0].$number."]+$/", $string) == 1) ? $string : false;
         }
    }
}

if (! function_exists("_setCustomString"))
{
   function _setCustomString($string='',$custom=false)
    {
       if ($custom == false)
        {
            return _setAlfabet($string);
        }
        else
        {
            return (preg_match("/^[".$custom."]+$/", $string) == 1) ? $string : false;
        }
    }
 }

if (! function_exists("_moneyFormat"))
{
	function _moneyFormat($val,$curr='Rp ')
	{
		return $curr." ".number_format($val);
	}
}

if (! function_exists("_setString"))
{
    function _setString($string='',$custom=false)
    {
       if ($custom == false)
        {
            return (is_string($string)) ? $string : false;
        }
        else
        {
           if (is_string($string))
           {
               return (preg_match("/^[".$custom."]+$/", $string) == 1) ? $string : false;
           }
           else
           {
              return false;
           }
        }
    }
 }

if (! function_exists("_setJson"))
{
	function _setJson($str='')
	{
	 if (is_string($str) && is_array(json_decode($str, true)))
	   {
	    return $str;
	  }
	  else
	  {
	    return (json_last_error() == JSON_ERROR_NONE) ? false : false;
	  }
	}
}

if (! function_exists("_jsonParse"))
{
	function _jsonParse($str='')
	{
		 if (is_string($str) && is_array(json_decode($str, true)))
		   {
		    return json_decode($str);
		  }
		  else if (is_object($str))
		  {
		  	  return $str;
		  }
		  else
		  {
		     false;
		  }
	}
}

if (! function_exists("_setArray"))
{
	function _setArray($str='')
	{
	  return (is_array($str)) ? $str : false;
	}
}

if (! function_exists("_setImageBase64"))
{
	function _setImageBase64($file="",$alt="Image Base 64 Garuda Framework Pro Edition")
	{

	 	if (file_exists($file))
	 	{
	 		$k = include $file;
	 		return '<center><img width="140" height="120" src="'.$k .'" alt="'.$alt.'"></center>';
	 	}
	 	else
	 	{
	 		trigger_error("_setImageBase64 -> File not found : ",E_USER_NOTICE);
	 	}

	}
}

if (! function_exists("_isCgi"))
{
	function _isCgi()
	{
		$sapi_type = php_sapi_name();
		return (substr($sapi_type, 0, 3) == 'cgi') ? true : false;
	}
}

   
if (! function_exists("_sensorEmail"))
{
	function _sensorEmail($email,$sensor_text="***")
	{
		$f1   =  strpos($email, "@");
		return     substr_replace(substr($email, 0,$f1),$sensor_text,floor( strlen(substr($email, 0,$f1)) / 2), strlen(substr($email, 0,$f1)))."@".substr($email, $f1+1);
	}
}

if (! function_exists("_arraySum"))
{
	function _arraySum(array ...$ar): array
	{
	    return array_map(function(array $a): int {
	        return array_sum($a);
	    }, $ar);
	}
}


if (! function_exists("_findAndMakeLink"))
{
	function _findAndMakeLink($str) 
	{
		$rE = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/"; $urls = array(); $uTr = array(); if(preg_match_all($rE, $str, $urls)) {$nM = count($urls[0]); $nMr = 0; for($i=0; $i<$nM; $i++) {$aD = false; $nMr = count($uTr); for($j=0; $j<$nMr; $j++) {if($uTr[$j] == $urls[0][$i]) {$aD = true; } } if(!$aD) {array_push($uTr, $urls[0][$i]); } } $nMr = count($uTr); for($i=0; $i<$nMr; $i++) {$str = str_replace($uTr[$i], "<a target='_blank' href=\"".$uTr[$i]."\">".$uTr[$i]."</a> ", $str); } return $str; } else {return $str; } 
	}
}

if (! function_exists("_cutString"))
{
	function _cutString($v,$i=100,$symbol=' ...')
	{
		$v = substr($v, 0 , $i) ;
		$v = substr_replace($v,$symbol, -1);
		return $v;
	}
}

if (! function_exists("_scrapping")){
	function _scrapping($url,$query,$fu=null){
		
		$html = file_get_contents($url); 
		$obj = new DOMDocument();
		libxml_use_internal_errors(TRUE); 
		if(!empty($html)){ 
			$obj->loadHTML($html);
			libxml_clear_errors(); 
			$obj_path = new DOMXPath($obj);
			$obj_row = $obj_path->query($query);
			if($obj_row->length > 0)
			{
				if (is_callable($fu)){
					call_user_func($fu,$obj_row);
				}
				else{
					$data=array();
					foreach($obj_row as $row){
						$data[]=$row->nodeValue;
					}
					return $data;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}

if (! function_exists("_dateFormat"))
{
	function _dateFormat($date='',$f='d-M-Y')
	{
		$res = date_create($date);
		return date_format($res,$f);
	}
}
if (! function_exists("_replaceStringPath"))
{
	function _replaceStringPath($v){
		return str_replace('\\', '/', $v);
	}
}

if (! function_exists("_getAndPutFile"))
{
	function _getAndPutFile($path=null,$url=null)
	{
		if ($puth != null && $url != null)
		{
			file_put_contents($path, fopen($url, 'r'));
		}
	}
}
defined('__Img_Base64__') or define('__Img_Base64__', $path['GF_Image_Base64']."/");


trait GF_Controller
{
	private static $path_controller;

	public static function setPathController($path)
	{
		self::$path_controller = __CONTROLLER_DIR__.$path.__ext_php__;
	}

	private static function checkController()
	{
		return (file_exists(self::$path_controller)) ? true : false;
	}

	public static function callController($file='',$any=null,$method=null,$parameter=null)
	{
		self::setPathController($file);

		if (! self::checkController())
		{
			System\GF_Message::showError('C_N_F_C',$file) ; 
			exit;
		}
		$path = self::$path_controller;
		if (__GF_LOG__)
		{
			$log = new Log;
			$log->setContent('run static function setController() - File .'.$path)->create();
		}
	    include $path;	    
	    $file = ($any==null) ? $file : $any;
		$class = "Garuda\Controller\\".$file;
		
		if (class_exists($class))
		{
			$obj = new $class($parameter);
			return ($method==null) ? $obj : $obj->$method($parameter);
		}else{
			System\GF_Message::showError('CLS_N_FOUND',$file) ; 
			exit;
		}
	}

}

class GF_Router_To_Controller
{
	private $function_user,$controller,$method;

	public function set($data)
	{	
		$this->function_user = $data['function_user'];
	}
	public function run()
	{
		  $index_controller = strrpos($this->function_user, _RTC_);
	      if ($index_controller)
	      {
	          $this->controller = trim(substr($this->function_user, 0,$index_controller));
	          $length_tot = strlen($this->function_user);
	          $this->method = trim(substr($this->function_user, $index_controller+strlen(_RTC_)
	          				,$length_tot));
	          
	          return true;
	      }else{
	      	  return false;
	      }
	}

	public function getController()
	{
		return $this->controller;
	}

	public function getMethod()
	{
		return $this->method;
	}
}

class GF_Template_View
{
	private $content_result,$file,$filename,$file_cache=null,$content_before;
	private $find_string = [
			'{{','}}',
			'[[',']]',
			'<<','>>',
			'=@>','<@=',
			'elif',
			'fe(',
			'<#','#>',
			'#TOKEN#',
			'@TOKEN@'
		];
	private $replace_string = [
			'<?=','?>',
			'<?php','?>',
			"echo '","';",
			"<script type='text/javascript'>",'</script>',
			'else if',
			'foreach (',
			'{ echo ','; }',
			'<script type="text/javascript"> var _TOKEN_ = "<?= _TOKEN_ ?>"; </script>',
			'<?= _token() ?>'
		];

	public function setFile($file)
	{
		$this->file = $file;
		return $this;
	}

	public function setFilename($filename)
	{
		$this->filename = str_replace('/', '-', $filename);
		return $this;
	}

	private function compile()
	{
		$result = $this->content_before;
		for ($i=0; $i < count($this->find_string); $i++) 
		{ 
			$result = str_replace($this->find_string[$i], 
								  $this->replace_string[$i], 
								  $result);
		}
		$this->content_result = $result;
		$this->compileImport();
	}

	private function compileImport()
	{
		
	}

	public function read()
	{
		if (filesize($this->file)>0)
		{
			$file   			  = fopen($this->file, "r");
			$this->content_before = fread($file,filesize($this->file));
			fclose($file);
			$this->file_cache = $this->filename.'-'
								._md5($this->filename)
								.sha1($this->filename).__ext_php__;

			$this->compile();
		}
		return $this;
	}	

	public function getContent()
	{
		return $this->content_result;
	}

	public function render()
	{
		$obj = new \GF_Text\File_Generator;
		$obj->setData($this->content_result);
		$obj->setFile($this->file_cache);
		$obj->setPath(__VIEW_TEMPLATE_DIR__);
		if (filesize($this->file)>0)
		{
			if (file_exists(__VIEW_TEMPLATE_DIR__.$this->file_cache))
			{	
				$sha_content_before = sha1_file(__VIEW_TEMPLATE_DIR__.$this->file_cache);
				$sha_content_now    = sha1($this->content_result);

				if ($sha_content_before!=$sha_content_now)
				{
					$obj->create();
				}
			}else{
				$obj->create();
			}
		}
		return $this;
	}

	public function isReady()
	{
		return ($this->file_cache==null) ? true : false;
	}

	public function getFile()
	{
		return __VIEW_TEMPLATE_DIR__.$this->file_cache;
	}
}


