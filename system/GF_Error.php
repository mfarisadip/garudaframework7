<?php 
defined('sys_run_app') OR exit('403 - Access Forbidden');

class GF_Error
{
	private $content,$title,$f_title,$cookie_e,$session_e,$get_e,$post_e,$server_e,$file_e;
	private $footer;

	public function __construct(){
		$this->footer = '<center><i>Garuda Framework Professional Edition 7.0</i></center>';
	}

	public function setTitle($title){
		$this->f_title = $title;
		$this->title = $title." Handling | Garuda Framework Professional Edition 7.0";
	}

	private function getGoogle()
	{
		return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAw1JREFUOI2dlGtIFFEYht8zZ3Znr1m6GREmVl7TolUpNCIhuv/IH1GEkJlkSWVEgkjkj7QiK7KLFXQhIoggqeiGSiaRSkJalqVhrqUpu6ntZXZ0Z93Tj9rabXWT3l8z3znv870ffDMEQcRub6TiYPoqz4iUwsAEwiu7CWX39fmF5ok8ZLyi/eLZJLnXdNn97nUKbFbO75BS0Jh4szIuoUy/u/DMP4H2k6WVzrrqnUSSxm3mK964pJOLil8yNT9/2Fvz6z5cWvxQenRv12RgAODu6Zyr4OVYvybeB+upsmOjD++u9XMIKvBJCzr4sOkvQHmR2eyJrq736ay/X4mw0DF1xuoV2h0FTb4WAgCOx8UzxUtNvcRu/52Yj461KlNSM3S5BS2+Bk9FhWB1mO9QQ3j5lLyC+r9TEwBwv82q8phNmbYLgGdoFFzEbEmRsTwiZOuewcmMHqDRxkV2uVbB3PVz2PfCNcx67kTOf4EAENZXonF/OC6CuX+OpI4bEdLb1H9fPHDT8dHu5AwTgijzXNymMfBMQoIXBgBEmDEAtAUYBmyI+DrkEYKlu1I7EsUFVD3jL/tkJCs4LU/UaAdRAEwGAEiyZcZ4l3VKzmHQj1Hf2ncn4d1jf955XmEiAOBqMtqIo01vUiShyJaK9FmLs/cbc64HS1NSx1StLQ7RLhEOAML1kG/t1Sk5AOB0C2ueqjKRY4lFj/gNDQOtlWfbr4cFAwq2kWteGABEGrgO4Nen16xOyy+3aDyS2wUAMNn6NI2m1q5TzVeNASQGcqK2u+JZ+9hm33KEgR4GfH4OR15eOFr1qbbILwVVYmFozEeDJrSRUl4UXVJ0l7UnrV+0aBYostHZvhQAkBxJusqztPP8gABwsOH0gyefn68LNqqvjCEZcPVucS6NFKJzV2q//h7Zq9K0fes3zF1xXkNVbDJAme8zz0+tSfTCAhJ6VfHqRsIXZ/+VN4OdqUPSsN+qUEIRMy1qaH7onMqi5LxDIPBrHnyJGcj5tpvLRFlKZgwqFVX26LRC9faYTZaJLD8ArV4nFpXylQAAAAAASUVORK5CYII=';
	}

	private function getStackOverFlow()
	{
		return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAACXUlEQVQ4jZ3RXUjTYRTH8e/5zxcUMsyycjMjMKhEMAMNNboRKboRAvWiuig3oQZ1ERH0ogSVEISabSCEN0VBd0FhXRR6kYKkGUFQVIQGaxvLLadt+pwu0pjmdHiunufA78N5zgNrrEhpYUmktHBc9zuyEvtWqoCCKMjCfYrYF2BrZNrauybwxwGr11fD2YX7ljHfFMiYpVq5JhDMc0Ha/dWUJ8w9qGsFN/dzH+SBEXkUrCAHQJBBkNRBfwOL9iM2cwaYm023PApimB0EHNFSu2NVMNTIdoEhfwNPAw3sAsh/xS8RbUT0qL+GE+vGvn8EQnNIxapg7kO+qqFEYA54F2igM1xPXn4/I6J6XpHuQBXFCkOa8GxJBiZWsIlaNdwGCgTaNhg8fp88ViSUEym6Es2whfKGPoWTggMXyo4rOpmRlfmysnUoDKAHSQvkcwrhmkCQOMdC04wVP+N3YjYZ6AWagGyE1xjpE7SvKnvkzc9RcmYzOReP0l7whOjS7D/Q5XLVWpY14/F4BgCGneXpM+u1Um2mDpU6YB8QQHkxGivsfj9TUOz1enuXgmkJ55PGmEDndfcHKy6HB2Fc1UxYmJunW+9e6r9YtskyWqsidd9iudtU9RawIvh35JgWqXAVsCOSYbDR1eYOv4VxkAlBP0cm4xHQ5bb1P+huvTMM7FBFum64N9piNrsSdxix7AJ2IHtZKRnY3Ny8U0R2u1zA4g/0AT7LsvxAbsogcAi4nCygqv0ici9lsKenpwPoSBYAaGlpOZIqWOB0OqtXwuan3JMqWC8i9auB8xVcrvkHMdXn5SlegJQAAAAASUVORK5CYII=';
	}

	public function setContent($data)
	{
		$brw = "&nbsp <g style='color: red'><a target='_blank' href='https://www.google.co.id/search?q=".$data['string']."'> 
				<img src='".$this->getGoogle()."'> 🔍</img></a> | <a target='_blank' 
				href='https://stackoverflow.com/search?q=".$data['string']."'> <img src='".$this->getStackOverFlow()."'> 🔍</img></a></g>";
		if ($data['number']==null)
		{
			$brw = '';
		}
	    $this->content = "<hr><b><b>".$data['image']."<hr><center><font color='#b2bec3'>".strtoupper($this->f_title)."
						</font></center><hr> 
						<font color='#c0392b'><strong>Number</strong>  : [".$data['number']."]</font> </br></br> 
			  			<strong>Message</strong></font><font color='black'> : ".$data['string']." </font> . ".$brw ." </br></br>
			  			<font color='#467FE7'><strong>File</strong>	<strong> : <a href='file:///".$data['file']."'>".$data['file']."</a></font></strong> </br> </br>
			  			<font color='#F79F1F'><strong>Line </strong><strong> : ".$data['line']."</font></strong>
			  			</br>"; 
	}

	public function render()
	{
		$res = '<ul>';
		foreach ($_COOKIE as $key=>$val)
		{
			$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val."</font></li>";
		}
		$this->cookie_e = $res."</ul>";

		$res = '<ul>';
		$aa = 0;
		foreach ($_SESSION as $key=>$val)
		{
			if (is_array($key) || is_array($val))
			{
				$key = json_encode($key);
				$val = json_encode($val);
				$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val.'</font></li>';
			}else{
				$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val.'</font></li>';
			}
			$aa++;
		}
		$this->session_e = $res."</ul>";

		$res = '<ul>';
		foreach ($_GET as $key=>$val)
		{
			$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val."</font></li>";
		}
		$this->get_e = $res."</ul>";

		$res = '<ul>';
		foreach ($_POST as $key=>$val)
		{
			$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val."</font></li>";
		}
		$this->post_e = $res."</ul>";

		$res = '<ul>';
		foreach ($_FILES as $key=>$val)
		{
			$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val."</font></li>";
		}
		$this->file_e = $res."</ul>";

		$res = '<ul>';
		foreach ($_SERVER as $key=>$val)
		{
			$res.= "<li><font color='#34495e'>".$key.'</font> => <font color="#e74c3c">'.$val."</font></li>";
		}
		$this->server_e = $res."</ul>";

		return '<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<title>'.$this->title.'</title>
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
				</head>
				<style>
					hr{border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); } code, {font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace } code {font-size: 87.5%; color: #95a5a6; word - break: break -word } 
				</style>
				<body>
					<div class="content">
						'.$this->content.'
						<hr></br>
					</div>
					
					<div class="content">
						<font size="4">
						    <font color="#2c3e50">Cookie :</font>
							<code>
								'.$this->cookie_e.'
							</code>
							<font color="#2c3e50">Session :</font>
							<code>
								'.$this->session_e.'
							</code>
							<font color="#2c3e50">Get :</font>
							<code>
								'.$this->get_e.'
							</code>
							<font color="#2c3e50">Post :</font>
							<code>
								'.$this->post_e.'
							</code>
							<font color="#2c3e50">Files :</font>
							<code>
								'.$this->file_e.'
							</code>
							<font color="#2c3e50">Server :</font>
							<code>
								'.$this->server_e.'
							</code>
						</font>
						<hr>
					</div>
					
					<div class="content">
					   <i>'.$this->footer.'</i>
					</div>
				</body>
				</html>';
	}

}

function _shutdownGF(){
	unset($GLOBALS);
}

function _execptionHandleGF($e) {
	$engine = new GF_Error;	
	$engine->setTitle('Exception');
    $image = _setImageBase64(__SYSTEM_DIR__.__img64_error__.__ext_php__);
	$engine->setContent([
		'number'=> $e->getCode(),
		'string'=> $e->getMessage(),
		'file'  => $e->getFile(),
		'line'  => $e->getLine(),
		'image' => $image
	]);
	echo $engine->render();exit;
}

function _errorHandleGF($error_number, $error_string, $error_file, $error_line)
	{
		if (__GARUDA_FRAMEWORK_ERROR_HANDLING__)
		{
		    if (! (error_reporting() & $error_number))
		    {
		        return false;
		    }
	         $engine = new GF_Error;
	         $image = '';
		     switch ($error_number)
		    {
			    case E_USER_ERROR:
			    	 $engine->setTitle('Error');
			    	 $image = _setImageBase64(__SYSTEM_DIR__.__img64_error__.__ext_php__);
			         return;
			     	 break;
			    case E_USER_WARNING:
			     	$engine->setTitle('Warning');
			        $image = _setImageBase64(__SYSTEM_DIR__.__img64_warning__.__ext_php__);
			        break;
			    case E_USER_NOTICE:
			    	$engine->setTitle('Notice');
			        $image = _setImageBase64(__SYSTEM_DIR__.__img64_notice__.__ext_php__);
			        break;
			    default:
			    	$engine->setTitle('Error');
			    	$image = _setImageBase64(__SYSTEM_DIR__.__img64_error__.__ext_php__);
			        break;
		    }
			$engine->setContent([
				'number'=> $error_number,
				'string'=> $error_string,
				'file'  => $error_file,
				'line'  => $error_line,
				'image' => $image
				]);
			echo $engine->render();
			exit;
	   }
	}