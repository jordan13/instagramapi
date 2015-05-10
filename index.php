<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('clientID', '8be6c304ca794638987d90796e54f299');
define('clientSecret', '25548e97d1b740b1bb680bf52b579df6');
define('redirectURI', 'http://localhost/appacademyapi/index.php');
define('ImageDirectory', 'pics/');

if isset(($_GET['code'])) {
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
}

?>

<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8">
    	<meta name="description" content="">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" type="css/style.css">
		<link rel="author" href="humans.txt">
</head>
<body>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram account 
	After getting approval, we are now going to have the information so that we can play with it 
	-->
	<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?> &redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
	<script src="js/main.js"></script>
</body>
</html>