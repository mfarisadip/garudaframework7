<?php

defined('sys_run_app') OR exit('403 - Access Forbidden');

use System\GF_Router as Garuda;
use System\GF_Request as Req;

/*
|--------------------------------------------------------------------------
| Route Web 
|--------------------------------------------------------------------------
|
| Diroute ini adalah tempat untuk membuat website
| Header dari route ini adalah 'text/html;charset=UTF-8'
| Dengan hak akses publik Access-Control-Allow-Origin: *
| 
| Jika ingin dijadikan menjadi hak akses private 
| Maka gunakan function Faris::setPrivate();
|
*/
Garuda::Route('','welcome');

Garuda::Route('home');
