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
//Function to get userID cause userName doesn't allow us to get pictures!
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data'][0]['id'];
}
// Function to print out images onto screen
function printImages($userID){
	$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	// we are going to parse thorugh the info one by one.
	 foreach ($results['data'] as $items){
	 	$image_url = $items['images']['low_resolution']['url']; // going through all of my results and give myself back the URL of those pictures because we want to save it in the PHP Server. 
	 	echo '<img src=" '.$image_url.' "/><br/>';
	 	//calling a function to save that $image_url
	 	savePictures($image_url);
	 }
}
//Function to save image to  server
function savePictures($image_url){
		echo $image_url.'<br>';
		$filename = basename($image_url);// the filename is what we are storing. basename is the PHP built in method that we are using to stor $image_url
		echo $filename . '<br>';

		$destination = ImageDirectory . $filename; // Making sure that the image doesn't exist in the storage.
		file_put_contents($destination, file_get_contents($image_url));// gets and grabs an imagefile and stores it in our server
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
//cURL is what we use in PHP, it's a library that we use to make calls to other API's\
$curl = curl_init($url);  // setting a cURL session and we put in $url because that's where we are getting the data from
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); // setting the POSTFIELDS to the array setup that we created.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it equal to 1 because we are geting strings back. 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // but in live work production we want to set this to true.


$result = curl_exec($curl);
curl_close($curl);


$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
}
else {
	
}
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8">
    	<meta name="description" content="">
    	<link rel="stylesheet" type="text/css" href="main.css"> 
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/javascript" href="js/bootstrap.min.js">
  	    <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" type="css/style.css">
		<link rel="author" href="humans.txt">
</head>
<body>
<div class="wrap">
	<div class="tl">
		
	</div>
</div>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram account 
	After getting approval, we are now going to have the information so that we can play with it 
	-->
	<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code"><div class="button"><h1> <center> LOGIN </center> </h1> </div></a>
	<script src="js/main.js"></script>
</body>
</html>