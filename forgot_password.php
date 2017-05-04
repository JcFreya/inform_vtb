<?php

require_once('includes/config.php');

$page_title = 'Forgot Your Password';

include ('includes/header.html');

if (isset($_POST['submitted'])) {

	require_once(MYSQL);

	$uid = FALSE;

	if (!empty($_POST['email'])) {

		$q = 'SELECT user_id FROM users WHERE email="' . mysqli_real_escape_string($dbc, $_POST['email']) . '"';

		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_num_rows($r) == 1) {
			list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
		} else {
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
	} else {
		echo '<p class="error">You forgot to enter your email address!</p>';
	} // End of if (!empty($_POST['email'])) {

	if ($uid) {
		$p = substr (md5(uniqid(rand(), true)), 3, 10);

		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";

		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) {

			$body = "Your password to log into " . BASE_URL . "login.php has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";

			$result = mail($_POST['email'], 'INFORM VTB Password Reset', $body, EMAIL);

			if (!$result) {

				echo '<p class="error">Password Reset email could not be sent.</p>';
				
			} else {
				
				echo '<p>Your password has been changed.</p>';
				echo '<p>You will receive the new, temporary password at the email address with which you registered.</p>';
				echo '<p>Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</p>';

				mysqli_close($dbc);	
			}

			include('includes/footer.html');

			exit();
		} else {
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
		}
	} else {
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);
}
?>

<h3>Reset Your Password</h3>
<p>Enter your email address below and your password will be reset.</p>

<form action="forgot_password.php" method="post">
	<p>Email Address: <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<input type="submit" name="submit" value="Reset My Password" />
	<input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
include('includes/footer.html');
?>