<?php

if (!LIVE) {
	DEFINE('DB_USER', 'root');	
	DEFINE('DB_PASSWORD', 'root');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'inform_vtb');
} else {
	DEFINE('DB_USER', 'inform_admin');
	DEFINE('DB_PASSWORD', 'Inform@2017');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'inform_vtb');
}

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($dbc,"utf8");

if (!$dbc) {
	trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

?>