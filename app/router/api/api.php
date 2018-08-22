<?php 

defined('sys_run_app') OR exit('403 - Access Forbidden');

use System\GF_Router as Garuda;
use System\GF_Request as Req;


/*
|--------------------------------------------------------------------------
| Route API 
|--------------------------------------------------------------------------
|
| Diroute ini adalah tempat untuk membuat API
| Header dari route ini adalah 'application/json'
| Dengan hak akses publik Access-Control-Allow-Origin: *
| 
| Jika ingin dijadikan menjadi hak akses private 
| Maka gunakan function Garuda::setPrivate();
|
*/


Garuda::Route('api-data-pdo','c_user => pdo');
Garuda::Route('api-data-sqlite','c_user => sqlite');


