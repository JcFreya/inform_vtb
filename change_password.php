<?php
require_once('includes/config.php');

$page_title = 'Change Your Password';

include('includes/header.html');

if (!isset($_SESSION['first_name'])) {

	$url = BASE_URL . 'index.php';

	ob_end_clean();

	header("Location: $url");

	exit();
}

if (isset($_POST['submitted'])) {

	require_once(MYSQL);

	$p = FALSE;

	if (preg_match('/^(\w){6,20}$/', $_POST['pass1'])) {

		if ($_POST['pass1'] == $_POST['pass2']) {

			$p = mysqli_real_escape_string($dbc, $_POST['pass1']);

		} else {

			echo '<p class="error">Your password did not match the confirmed password!</p>';

		}
	} else {

		echo '<p class="error">Please enter a valid password!</p>';

	}

	if ($p) {

		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";

		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) {

			echo '<h3>Your password has been changed.</h3>';

			mysqli_close($dbc);

			include('includes/footer.html');

			exit();

		} else {
			echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>';
		}
	} else {

		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);
} // End of the main Submit conditional.
?>

<h3>Change Your Password</h3>

<div class="row">
  <div class="col-md-4 col-md-offset-3">

		<form action="change_password.php" method="post">
		    <p>New Password: <input type="password" name="pass1" /></p>
		    <p>Confirm New Password: <input type="password" name="pass2" /></p>
		    <input type="submit" name="submit" value="Change My Password" />
		    <input type="hidden" name="submitted" value="TRUE" />
		</form>

	</div>
</div>
<?php
include('includes/footer.html');
?>