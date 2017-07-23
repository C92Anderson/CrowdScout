<?php
//Connect to Database
$db_host = 'mysql.crowd-scout.net';
$db_name = 'nhl_all';
$db_user = 'ca_elo_games';
$db_pass = 'cprice31!';

//Create mysqli Object
$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);


//Error Handler
if($mysqli->connect_error){
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}
////
//mysqli::__construct ([ string $host = ini_get("mysqli.default_host") [, string $username = ini_get("mysqli.default_user") 
//	[, string $passwd = ini_get("mysqli.default_pw") [, string $dbname = "" [, int $port = ini_get("mysqli.default_port") 
//	[, string $socket = ini_get("mysqli.default_socket") ]]]]]] )