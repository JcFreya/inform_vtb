<?php

require_once('includes/config.php');
$page_title = 'Delete Sample';
include('includes/header.html');

echo '<h3>Delete Sample</h3>';

if ( (isset($_GET['sample_id'])) && (is_numeric($_GET['sample_id'])) ) {
	$sample_id = $_GET['sample_id'];
} else if ( (isset($_POST['sample_id'])) && (is_numeric($_POST['sample_id'])) ){
	$sample_id = $_POST['sample_id'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';

	include('includes/footer.html');

	exit();
}

require_once(MYSQL);

if ( isset($_POST['submitted']) ) {
	if ($_POST['sure'] == 'Yes') {
		$q = "DELETE FROM samples WHERE sample_id=$sample_id LIMIT 1";

		$r = @mysqli_query($dbc, $q);

		if (mysqli_affected_rows($dbc) == 1) {

			mysqli_free_result($r);

			mysqli_close($dbc);

			$url = BASE_URL . 'view_samples.php';

			header("Location: $url");

			exit();

		} else {

			echo '<p class="error">THe sample could not be deleted due to a system error.</p>';

			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
		}
	} else {

		echo '<p>The sample has NOT been deleted.</p>';
	}
} else {

	$q = "SELECT sample_id FROM samples WHERE sample_id=$sample_id";

	$r = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($r) == 1) {

		$rows = mysqli_fetch_array ($r, MYSQLI_NUM);

		echo '<form action="delete_sample.php" method="post">

		<p>Sample ID: ' . $rows[0] . '</p>

		<p>Are you sure you want to delete this sample?<br />

		<input type="radio" name="sure" value="Yes" /> Yes

		<input type="radio" name="sure" value="No" checked="checked" /> No</p>
		<p><input type="submit" name="submit" value="Submit" /></p>

		<input type="hidden" name="submitted" value="TRUE" />

		<input type="hidden" name="sample_id" value="' . $sample_id . '" />

		</form>';
	} else {

		echo '<p class="error">This page has been accessed in error.</p>';
	}

}

mysqli_close($dbc);

include('includes/footer.html');
?>