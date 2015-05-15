<!DOCTYPE html>

<html>
	<head>
		<title>Instagram</title>
		<meta name="viewport" content="width-device width, initial-scale=1.0">
	</head>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/bootstrap.css">
	<body>

<?php 

//Configuration for PHP server

set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make constants using define

define('clientID', 'c66db307cf7140acac34946afb74cfcc');
define('clientSecret', 'f523fdc3d9004104a206616ff2bd2045');
define('redirectURI', 'http://localhost/AppAcademyAPI/index.php');
define('ImageDirectory', 'pics/');

//function that is going to connect to instagram
function connectToInstagram($url) {
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

//function to get userid cause username doesnt allow us to get pictures
function getUserID($userName) {
	$url = 'https://api.instagram.com/v1/users/search?q=' . $userName . '&client_id=' .clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data'][0]['id'];
}
//function to print out images onto screen
function printImages($userID) {
	$url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent?client_id=' . clientID . '&count=6';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	//going to parse through info one by one
	foreach ($results['data'] as $items) {
		$image_url = $items['images']['low_resolution']['url'];
		echo '<img src=" ' . $image_url . ' " class="pic-style">';
		//calling a function to save img url
		savePictures($image_url);
	}
}
//function to save img to server
function savePictures($image_url) {
	return $image_url . '<br>';
	$filename = basename($image_url); //storing filenmae, basename used to store
	return $filename . '<br>';

	$destination = ImageDirectory . $filename;
	file_put_contents($destination, file_get_contents($image_url)); //grabs img stores in server
}

if (isset($_GET['code'])) {
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
	//cURL is what we use in php, library for calls to other apis
	$curl = curl_init($url); //setting curl session, get data from url
	curl_setopt($curl, CURLOPT_POST, true);	
	curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); //setting POSTFIELDS to array setup we created
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting equal to 1, getting strings back
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //work, set to true


	$result = curl_exec($curl);
	curl_close($curl);

	$results = json_decode($result, true);

	$userName = $results['user']['username'];

	$userID = getUserID($userName);

	printImages($userID);
}

else {

?>

	<div id="align">
		<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>
		&redirect_uri=<?php echo redirectURI; ?>&response_type=code" 
		type="button" id="myButton" data-loading-text="Loading..." class="btn btn-warning" autocomplete="off" id="login">LOGIN</a>
		<!-- creating login for people to get approve for web app to use Instagram account
		after getting aprroval now going to have info to play with it -->
	</div>
	</body>
</html>

<?php

}