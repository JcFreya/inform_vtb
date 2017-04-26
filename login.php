<?php

require_once('includes/config.php');

$page_title = 'Login';

include('includes/header.html');

if (isset($_POST['submitted'])) {
	require_once(MYSQL);

	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}

	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}

	if ($e && $p) {
            
		$q = "SELECT user_id, first_name, investigator_id FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active=''";
                
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                
		if (@mysqli_num_rows($r) == 1) {
			$_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);

			mysqli_free_result($r);

			mysqli_close($dbc);

			$url = BASE_URL . 'view_samples.php';

			ob_end_clean();

			header("Location: $url");

			exit();

		} else {
			echo '<p class="error">Either the email address and password entered do not match those on file or your account has not been activated yet.</p>';
		}
	} else {
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);
} // End of if (isset($_POST['submitted'])) {

?>

<h3>Login</h3>

<div class="row">
  <div class="col-md-4 col-md-offset-3">
		<form action="login.php" method="post">
			<p>Email Address: <input type="email" name="email" /></p>
			<p>Password: <input type="password" name="pass" /></p>
			<input type="submit" name="submit" value="Login" />
			<input type="hidden" name="submitted" value="TRUE" />

			<p><a href="forgot_password.php">Forgot your password?</a></p>
		</form>
	</div>
</div>

<?php
include('includes/footer.html');
?>