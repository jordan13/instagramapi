<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('client_id', '4503b95fad07470b9a05e553d7e666e0');
define('client_secret', '2260286d766040f8a0ee05ed1cc2be9c');
define('redirectURI', 'http://localhost:8888/appacademyapi/index.php');
define('ImageDirectory', 'pics/');
?>


<!-- CLIENT INFO
CLIENT ID	4503b95fad07470b9a05e553d7e666e0
CLIENT SECRET	2260286d766040f8a0ee05ed1cc2be9c
WEBSITE URL	http://localhost:8888/appacademyapi/index.php
REDIRECT URI	http://localhost:8888/appacademyapi/index.php -->