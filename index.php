<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('clientID', '50771717f2b748f1885243a1314e45e4');
define('clientSecret', '7a500718477047bb9bf53dd130b3b578');
define('redirectURI', 'http://localhost/appacademyapi/index.php');
define('ImageDirectory', 'pics/');

//Function that is going to connect to Instagram.
function connectToInstagram($url){
	$ch = curl_init();

	curl_setopt_array($ch, options(
		CURLOPT_URL => $url;
		CURLOPT_RETURNTRANSFER => true;
		CURLOPT_SSL_VERIFYPEER => false;
		CURLOPT_SSL_VERIFYHOST => 2;
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

if (isset($_GET['code'])) {
	$code = ($_GET['code']);	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
//cURL is what we use in PHP, it's a library that we use to make calls to other API's\
$curl = curl_init($url);  // setting a cURL session and we put in $url because that's where we are getting the data from
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); // setting the POSTFIELDS to the array setup that we created.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it equal to 1 because we are geting strings back. 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // but in live work production we want to set this to true.


$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
echoresults['user']['username'];
}
else {
	
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
	<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
	<script src="js/main.js"></script>
</body>
</html>