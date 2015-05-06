<?php 

/*
CLIENT INFO
CLIENT ID	6ffbb1a0e9244168bdae9011caa8f3bc
CLIENT SECRET	fbfc98c3740a4b7893dea4ae3862a027
WEBSITE URL	http://localhost/Instagram/index.php
REDIRECT URI	http://localhost/Instagram/index.php
*/

//Configuration for PHP server

set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make constants using define

define('client_id', '6ffbb1a0e9244168bdae9011caa8f3bc');
define('client_secret', 'fbfc98c3740a4b7893dea4ae3862a027');
define('redirectURI', 'http://localhost/Instagram/index.php');
define('ImageDirectory', 'pics/');