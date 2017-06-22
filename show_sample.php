<?php

require_once('includes/config.php');

$page_title = 'Show Sample';

include('includes/header.html');

if ( isset($_GET['sample_id']) ) {
	$sample_id = $_GET['sample_id'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';

	include('includes/footer.html');

	exit();
}

require_once(MYSQL);

echo '<h3>Show Sample</h3>';

$q = "SELECT
sample_id,
diagnosis,
symptoms,
genotype_a1,
genotype_a1_code,
genotype_a2,
genotype_a2_code,
phenotype,
sample_date,
age_days,
age_months,
age_years,
sex,
ethnic,
sample_type,
type,
passage_num,
age_at_sampling,
prior_results,
sick_or_well,
fed_or_fasted,
plasma_or_serum_or_dried,
frozen_vs_fixed,
prior_testing,
consent,
user_id
FROM samples
WHERE sample_id=$sample_id";

$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) == 1) {

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if ($row['sex'] == 1) {
		$sex = "Male";
	} else {
		$sex = "Female";
	}

	if ($row['consent'] == '1') {
		$consent = "Yes";
	} else {
		$consent = "No";
	}

	echo '
	<div class="container">
		<div class="row">
		  <div class="col-md-6">
		  	<h4>Sample</h4>
		  	<hr />
		  	<p>Sample ID: ' . $row['sample_id'] . '</p>
		  	<p>Diagnosis/Disease: ' . $row['diagnosis'] . '</p>
		  	<p>Symptoms/Findings: ' . $row['symptoms'] . '</p>
		  	<p>Genotype - Allele 1: ' . $row['genotype_a1'] . '</p>
		  	<p>Genotype - Allele 1 Code: ' . $row['genotype_a1_code'] . '</p>
		  	<p>Genotype - Allele 2: ' . $row['genotype_a2'] . '</p>
		  	<p>Genotype - Allele 2 Code: ' . $row['genotype_a2_code'] . '</p>
		  	<p>Phenotype: ' . $row['phenotype'] . '</p>
		  	<p>Sample Date: ' . $row['sample_date'] . '</p>
		  	<p>Demographic Data - Age: ' . $row['age_years'] . ' year(s) ' . $row['age_months'] . ' month(s) ' . $row['age_days'] . ' day(s)</p>
		  	<p>Demographic Data - Sex: ' . $sex . '</p>
		  	<p>Demographic Data - Ethnic Background: ' . $row['ethnic'] . '</p>
		  	<p>Sample Type: ' . $row['sample_type'] . '</p>
		  	<input id="sample_type" type="text" value="' . $row['sample_type'] . '" hidden />
			<p id="type">Type: ' . $row['type'] . '</p>
			<p id="passage_num">Passage #: ' . $row['passage_num'] . '</p>
			<p id="age_at_sampling">Age at sampling: ' . $row['age_at_sampling'] . '</p>
			<p id="sick_or_well">Sick or well: ' . $row['sick_or_well'] . '</p>
			<p id="fed_or_fasted">Fed or fasted: ' . $row['fed_or_fasted'] . '</p>
			<p id="plasma_or_serum_or_dried">Plasma, serum or dried blood spot: ' . $row['plasma_or_serum_or_dried'] . '</p>
			<p id="frozen_vs_fixed">Frozen vs fixed: ' . $row['frozen_vs_fixed'] . '</p>
			<p id="prior_results">Prior biochemical results: ' . $row['prior_results'] . '</p>
			<p id="prior_testing">Prior pathology or enzyme testing: ' . $row['prior_testing'] . '</p>
		  </div>
		  <div class="col-md-6">
		  	<h4>Investigator</h4>
		  	<hr />';
				require_once(MYSQL);
				$q = "SELECT first_name, last_name, title, institution, web_address, address1, address2, postal_code, country, email FROM users WHERE user_id={$row['user_id']}";

				$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

				while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				    echo '<p>Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>';
				    echo '<p>Title: ' . $row['title'] . '</p>';
				    echo '<p>Institution: ' . $row['institution'] . '</p>';
				    echo '<p>Address: ' . $row['address1'] . ' ' . $row['address2'] . ' ' . $row['postal_code'] . '</p>';
				    echo '<p>Country: ' . $row['country'] . '</p>';
				    echo '<p>Web Address: ' . $row['web_address'] . '</p>';
				    echo '<p>Email: ' . $row['email'] . '</p>';
				    echo '<br />';
				    echo '<p>Consent: ' . $consent . '</p>';
				}
				mysqli_close($dbc);
		  echo '</div>
		</div>
	</div>';
}

?>

<script>

$(document).ready(function(){

	if ($('#sample_type').val() == 'Cell') {
		hideAll();
		$('#type').show();
		$('#passage_num').show();
		$('#age_at_sampling').show();
		$('#prior_results').show();
	} else if ($('#sample_type').val() == 'Blood') {
		hideAll();
		$('#age_at_sampling').show();
		$('#sick_or_well').show();
		$('#fed_or_fasted').show();
		$('#plasma_or_serum_or_dried').show();
		$('#prior_results').show();
	} else if ($('#sample_type').val() == 'Urine') {
		hideAll();
		$('#age_at_sampling').show();
		$('#sick_or_well').show();
		$('#fed_or_fasted').show();
		$('#prior_results').show();
	} else if ($('#sample_type').val() == 'Tissue') {
		hideAll();
		$('#type').show();
		$('#age_at_sampling').show();
		$('#frozen_vs_fixed').show();
		$('#prior_testing').show();
	} else {
		hideAll();
		alert("Please choose Sample Type!");
	}
})

function hideAll() {
	$('#type').hide();
	$('#passage_num').hide();
	$('#age_at_sampling').hide();
	$('#prior_results').hide();
	$('#sick_or_well').hide();
	$('#fed_or_fasted').hide();
	$('#plasma_or_serum_or_dried').hide();
	$('#frozen_vs_fixed').hide();
	$('#prior_testing').hide();
}
</script>
<?php

include('includes/footer.html');
?>