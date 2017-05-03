<?php

require_once('includes/config.php');

$page_title = 'Register';

include('includes/header.html');

if (isset($_POST['submitted'])) {
	require(MYSQL);

	$trimmed = array_map('trim', $_POST);

	$fn = $ln = $e = $p = FALSE;

	if (preg_match('/^[A-Z\'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	if (preg_match('/^[A-Z\'.-]{2,20}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}

	if (preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/i', $trimmed['email'])) {
		$e = mysqli_real_escape_string($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	if (preg_match('/^\w{6,20}$/', $trimmed['pass1'])) {
		if ($trimmed['pass1'] == $trimmed['pass2']) {
			$p = mysqli_real_escape_string($dbc, $trimmed['pass1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password! Use only letters, numbers and the underscore. Must be between 6 and 20 charaters long.</p>';
	}

	$t = mysqli_real_escape_string($dbc, $trimmed['title']);
    $i = mysqli_real_escape_string($dbc, $trimmed['institution']);
    $w = mysqli_real_escape_string($dbc, $trimmed['web_address']);
    $a1 = mysqli_real_escape_string($dbc, $trimmed['address1']);
    $a2 = mysqli_real_escape_string($dbc, $trimmed['address2']);
    $a3 = mysqli_real_escape_string($dbc, $trimmed['address3']);
    $pc = mysqli_real_escape_string($dbc, $trimmed['postal_code']);
    $c = mysqli_real_escape_string($dbc, $trimmed['country']);
        
        if (!$t OR !$i OR !$w OR !$a1 OR !$a2 OR !$a3 OR !$pc OR !$c) {
            echo '<p class="error">Please fill in every blank.</p>';
        }
        
        $ii = mysqli_real_escape_string($dbc, $trimmed['investigator_id']);
	
	if ($fn && $ln && $e && $p && $t && $i && $w && $a1 && $a2 && $a3 && $pc && $c) {
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_num_rows($r) == 0) {

			$a = md5(uniqid(rand(), true));

			$q = "INSERT INTO users
(first_name, last_name, email, pass, title, institution, web_address, address1, address2, address3, postal_code, country, investigator_id, active) VALUES
('$fn', '$ln', '$e', SHA1('$p'), '$t', '$i', '$w', '$a1', '$a2', '$a3', '$pc', '$c', '$ii', '$a')";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) {
                            
                                $body = 'First Name: ' . $fn . "\r\n";
                                $body .= 'Last Name: ' . $ln . "\r\n";
                                $body .= 'Title: ' . $t . "\r\n";
                                $body .= 'Institution: ' . $i . "\r\n";
                                $body .= 'Web Address: ' . $w . "\r\n";
                                $body .= 'Address 1: ' . $a1 . "\r\n";
                                $body .= 'Address 2: ' . $a2 . "\r\n";
                                $body .= 'Address 3: ' . $a3 . "\r\n";
                                $body .= 'Postal Code: ' . $pc . "\r\n";
                                $body .= 'Country: ' . $c . "\r\n";
                                $body .=  "\r\n";
                                $body .= "If you want to approve this request, please click on the link below:\r\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";

				require('vendor/autoload.php');

				// Create the Transport
				$transport = Swift_SmtpTransport::newInstance('smtp.mailgun.org', 587)
				  ->setUsername('postmaster@sandboxd9979805d66d44cfb3ed977a0935cab7.mailgun.org')
				  ->setPassword('22ac6581ce67826e266ed579088f330a')
				  ;

				// Create the Mailer using your created Transport
				$mailer = Swift_Mailer::newInstance($transport);

				$adminName = 'Keith Mcintire';
				$requesterName = $fn . ' ' . $ln;

				// Create a message
				$message = Swift_Message::newInstance('INFORM VTB Registration Request')
				  ->setFrom(array($e => $requesterName))
				  ->setTo(array(EMAIL => 'Keith Mcintire'))
				  ->setBody($body)
				  ;

				// Send the message
				$result = $mailer->send($message);

				if ($result) {
					echo '<p>INFORM Coordinator will review your registration request.</p>';
					echo '<p>Once reviewed, your account will be activated and notified via your email address with which you registered.</p>';
					echo '<p>If your account is not activated within two business days, please contact INFORM Coordinator, Keith Mcintire at keith.mcintire@chp.edu or +1-412-692-5099.</p>';

					echo '<a class="btn btn-primary" href="index.php">Go Home</a>';	
				} else {
					echo '<p class="error">The request has not been processed properly. Please contact the system administrator.</p>';
				}

				include('includes/footer.html');

				exit();
			} else {
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}

		} else {
			echo '<p class="error">That email address has already been registered.</p>';
		}
	} else {
		echo '<p class="error">Please try again.';
	}

	mysqli_close($dbc);
}
?>

<h3>Registration</h3>

<div class="row">
  <div class="col-md-4 col-md-offset-3">

	<form action="register.php" method="post">
		<p>First Name: <input type="text" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
		<p>Last Name: <input type="text" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
		<p>Email: <input type="email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /></p>
		<p>Password: <input type="password" name="pass1" /></p>
		<p>Confirm Password: <input type="password" name="pass2" /></p>
	        <p>Title: <input type="text" name="title" value="<?php if (isset($trimmed['title'])) echo $trimmed['title']; ?>" " /></p>
	        <p>Institution: <input type="text" name="institution" value="<?php if (isset($trimmed['institution'])) echo $trimmed['institution']; ?>"  /></p>
	        <p>Web Address: <input type="url" name="web_address" value="<?php if (isset($trimmed['web_address'])) echo $trimmed['web_address']; ?>" /></p>
	        <p>Address 1: <input type="text" name="address1" value="<?php if (isset($trimmed['address1'])) echo $trimmed['address1']; ?>" /></p>
	        <p>Address 2 (City): <input type="text" name="address2" value="<?php if (isset($trimmed['address2'])) echo $trimmed['address2']; ?>" /></p>
	        <p>Address 3 (State/Province): <input type="text" name="address3" value="<?php if (isset($trimmed['address3'])) echo $trimmed['address3']; ?>" /></p>
	        <p>Postal Code: <input type="text" name="postal_code" value="<?php if (isset($trimmed['postal_code'])) echo $trimmed['postal_code']; ?>" /></p>
	        <p>Country: 
	            <?php include('includes/country_list.html') ?>
	        </p>
		<p>If you are a Researcher, please select your Investigator:
			<select id="investigator_id" name="investigator_id">
				<option value="0"></option>
	<?php
	require(MYSQL);
	$q = "SELECT user_id, first_name, last_name FROM users WHERE investigator_id = 0";
	$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<option value="' . $row['user_id'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
	}
	mysqli_close($dbc);
	?>
			</select>
		</p>
		<input type="submit" name="submit" value="Submit" />
		<input type="hidden" name="submitted" value="TRUE" />
	</form>
  </div>
</div>

<?php
include('includes/footer.html');
?>