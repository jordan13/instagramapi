<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('client_ID', '4503b95fad07470b9a05e553d7e666e0');
define('client_Secret', '2260286d766040f8a0ee05ed1cc2be9c');
define('redirectURI', 'http://localhost:8888/appacademyapi/index.php');
define('ImageDirectory', 'pics/');
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8">
    	<meta name="description" content="">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" type="text/style.css">
		<link rel="author" href="humans.txt">
</head>
<body>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram account 
	After getting approval, we are now going to have the information so that we can play with it 
	-->
	<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo client_ID; ?> &redirect_uri=<?php echo redirectURI?>&response_type=code">LOGIN</a>
	<script src="js/main.js"></script>
</body>
</html>