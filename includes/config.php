<?php

define('LIVE', TRUE);

if (!LIVE) {

	define('EMAIL', 'dongukcho@gmail.com');

	define('BASE_URL', 'http://localhost:8888/inform_vtb/');

	define('MYSQL', getcwd() . '/mysqli_connect.php');

} else {

	define('EMAIL', 'keith.mcintire@chp.edu');

	define('BASE_URL', 'http://vtb.informnetwork.org/');

	define('MYSQL', getcwd() . '/mysqli_connect.php');

}

date_default_timezone_set('US/Eastern');

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
	$message = "<p>An error occurred in script '$e_file' on $e_line: $e_message\n<br />";

	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";

	$message .= "<pre>" . print_r($e_vars, 1) . "</pre>\n</p>";

	if (!LIVE) { // Development Mode
		echo '<div id="error">' . $message . '</div><br />';
	} else { // Production Mode
		mail(EMAIL, 'Site Error!', $message, 'FROM: admin@inform-vtb.org');

		echo '<div id="error">' . $message . '</div><br />';

		if ($e_number != E_NOTICE) {
			echo '<div id="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF
} // Enf of my_error_handler()

set_error_handler('my_error_handler');

?>