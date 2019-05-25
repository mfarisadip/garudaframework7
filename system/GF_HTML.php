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

function _importJS($path='')
{
	return '<script src="'.__view_url__.''.$path.'"></script>';
}

function _importJSOnline($url=''){
	return '<script src="'.$url.'"></script>';
}

function _importCSS($path='')
{
	return '<link href="'.__view_url__.''.$path.'" rel="stylesheet">
';
}

function _importCSSOnline($url=''){
	return '<link href="'.$url.'" rel="stylesheet">';
}


function _importGarudaJS()
{
	return  _importJS("asset/garuda/garuda.js");
}

function _importBootstrap4(){
	return _importCSS('asset/bootstrap4/bootstrap4.min.css').
			_importJS('asset/jquery/jquery.slim.min.js').
				_importJS('asset/bootstrap4/bootstrap4.min.js');
}

class Facebook_Twitter_Setup
{
	private $title;
	private $image;
	private $description;
	private $creator;
	private $type;
	private $url;
	private $type_image = 'summary_large_image';

	public function __construct(array $setup)
	{
			$this->title = isset($setup['title']) ? $setup['title'] : false;
			$this->image = isset($setup['image']) ? $setup['image'] : false;
			$this->description = isset($setup['description']) ? $setup['description'] : false;
			$this->creator = isset($setup['creator']) ? $setup['creator'] : false;
			$this->type_image = isset($setup['type_image']) ? $setup['type_image'] : false;
			$this->type = isset($setup['type']) ? $setup['type'] : false;
			$this->url = isset($setup['url']) ? $setup['url'] : false;
	}
}

class Twitter_Card extends Facebook_Twitter_Setup
{
	public function render()
	{
		$r = '<meta name="twitter:card" content="summary" />
				<meta name="twitter:description" content="'.$this->description.'">
				<meta name="twitter:image" content="'.$this->image.'">
				<meta name="twitter:image" content="'.$this->image.'">	
				<meta name="twitter:card" content="'.$this->type_image.'">
				<meta name="twitter:site" content="@'.$this->url.'">
				<meta name="twitter:creator" content="@'.$this->creator.'">
				<meta name="twitter:title" content="'.$this->title.'">';
		echo $r;
	}
}

class Facebook_Graph extends Facebook_Twitter_Setup
{
	public function render()
	{
		$r = '<meta property="og:url"         content="'.$this->url.'" />
			  <meta property="og:type"        content="'.$this->type.'" />
			  <meta property="og:title"       content="'.$this->title.'" />
              <meta property="og:description" content="'.$this->description.'" />
              <meta property="og:image"       content="'.$this->image.'" />';
		echo $rmp;
	}
}
