<?php

require_once('config/config.php');

$page_title = 'Activate Account';

include('includes/header.html');

$x = $y = FALSE;

if (isset($_GET['x']) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x'])) {
	$x = $_GET['x'];
}

if (isset($_GET['y']) && (strlen($_GET['y']) == 32)) {
	$y = $_GET['y'];
}

if ($x && $y) {

	require_once(MYSQL);

	$q = "UPDATE users SET active='' WHERE (email='" . mysqli_real_escape_string($dbc, $x) . "' AND active='" . mysqli_real_escape_string($dbc, $y) . "') LIMIT 1";
	$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	if (mysqli_affected_rows($dbc) == 1) {
		mail($x, 'Your INFORM VTB account is now activated.', 'Please log in ' . BASE_URL . 'login.php', 'From: ' . EMAIL);

		echo "<h3>The requester's account is now active.</h3>";
		echo "<h3>The confirmation email has been sent to the requester.</h3>";
	} else {
		echo '<p class="error">The requester\'s account could not be activated.</p>';
	}
} else {
	$url = BASE_URL . 'index.php';

	ob_end_clean();

	header("Location: $url");

	exit();
}

include('includes/footer.html');
?>