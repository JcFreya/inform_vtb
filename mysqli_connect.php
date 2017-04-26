<?php

DEFINE('DB_USER', 'root');

if (!LIVE) {
	DEFINE('DB_PASSWORD', 'root');	
} else {
	DEFINE('DB_PASSWORD', 'Inform@2017');
}

DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'inform');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$dbc) {
	trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

?>