<?php 

//Configuration for PHP server

set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make constants using define

define('clientID', '6ffbb1a0e9244168bdae9011caa8f3bc');
define('clientSecret', 'fbfc98c3740a4b7893dea4ae3862a027');
define('redirectURI', 'http://localhost/AppAcademyAPI/index.php');
define('ImageDirectory', 'pics/');

?>

<!DOCTYPE html>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>
		&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
		<!-- creating login for people to get approve for web app to use Instagram account
		after getting aprroval now going to have info to play with it -->
	</body>
</html>