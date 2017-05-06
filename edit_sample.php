<?php

require_once('includes/config.php');

$page_title = 'Edit Sample';

include('includes/header.html');

if ( isset($_GET['sample_id']) ) {
	$sample_id = $_GET['sample_id'];
} else if ( isset($_POST['sample_id']) ){
	$sample_id = $_POST['sample_id'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';

	include('includes/footer.html');

	exit();
}

require_once(MYSQL);

if (isset($_POST['submitted'])) {

$sample_id = mysqli_real_escape_string($dbc, $_POST['sample_id']);
$diagnosis = mysqli_real_escape_string($dbc, $_POST['diagnosis']);
$symptoms = mysqli_real_escape_string($dbc, implode(", ", $_POST['symptoms']));
$genotype_a1 = mysqli_real_escape_string($dbc, $_POST['genotype_a1']);
$genotype_a1_code = mysqli_real_escape_string($dbc, $_POST['genotype_a1_code']);
$genotype_a2 = mysqli_real_escape_string($dbc, $_POST['genotype_a2']);
$genotype_a2_code = mysqli_real_escape_string($dbc, $_POST['genotype_a2_code']);
$phenotype = mysqli_real_escape_string($dbc, $_POST['phenotype']);
$sample_date = mysqli_real_escape_string($dbc, $_POST['sample_date']);
$age_days = mysqli_real_escape_string($dbc, $_POST['age_days']);
$age_months = mysqli_real_escape_string($dbc, $_POST['age_months']);
$age_years = mysqli_real_escape_string($dbc, $_POST['age_years']);
$sex = mysqli_real_escape_string($dbc, $_POST['sex']);
$ethnic = mysqli_real_escape_string($dbc, $_POST['ethnic']);
$sample_type = mysqli_real_escape_string($dbc, $_POST['sample_type']);
$type = mysqli_real_escape_string($dbc, $_POST['type']);
$passage_num = mysqli_real_escape_string($dbc, $_POST['passage_num']);
$age_at_sampling = mysqli_real_escape_string($dbc, $_POST['age_at_sampling']);
$prior_results = mysqli_real_escape_string($dbc, $_POST['prior_results']);
$sick_or_well = mysqli_real_escape_string($dbc, $_POST['sick_or_well']);
$fed_or_fasted = mysqli_real_escape_string($dbc, $_POST['fed_or_fasted']);
$plasma_or_serum_or_dried = mysqli_real_escape_string($dbc, $_POST['plasma_or_serum_or_dried']);
$frozen_vs_fixed = mysqli_real_escape_string($dbc, $_POST['frozen_vs_fixed']);
$prior_testing = mysqli_real_escape_string($dbc, $_POST['prior_testing']);
$consent = mysqli_real_escape_string($dbc, $_POST['consent']);

	$q = "UPDATE samples SET
diagnosis='$diagnosis',
symptoms='$symptoms',
genotype_a1='$genotype_a1',
genotype_a1_code='$genotype_a1_code',
genotype_a2='$genotype_a2',
genotype_a2_code='$genotype_a2_code',
phenotype='$phenotype',
sample_date='$sample_date',
age_days='$age_days',
age_months='$age_months',
age_years='$age_years',
sex='$sex',
ethnic='$ethnic',
sample_type='$sample_type',
type='$type',
passage_num='$passage_num',
age_at_sampling='$age_at_sampling',
prior_results='$prior_results',
sick_or_well='$sick_or_well',
fed_or_fasted='$fed_or_fasted',
plasma_or_serum_or_dried='$plasma_or_serum_or_dried',
frozen_vs_fixed='$frozen_vs_fixed',
prior_testing='$prior_testing',
consent='$consent'
WHERE sample_id='$sample_id' LIMIT 1";

	$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	if (mysqli_affected_rows($dbc) == 1) {

		mysqli_close($dbc);

		$url = BASE_URL . 'view_samples.php';

		header("Location: $url");

		exit();

	} else{
		echo '<p class="error">Internal Error</p>';

		mysqli_close($dbc);
	}

	
}

echo '<h3>Edit Sample</h3>';

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
consent
FROM samples
WHERE sample_id=$sample_id";

$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) == 1) {

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	echo '
<form action="edit_sample.php" method="post">
	<div class="container">
		<div class="row">
		  <div class="col-md-6">
		  	<h4>Sample</h4>
		  	<hr />
		  	<p>Diagnosis/Disease: 
				  	<select name="diagnosis">
					  <option value="Carnitine transporter defect"';

					  if (!strcmp($row['diagnosis'], 'Carnitine transporter defect')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Carnitine transporter defect</option>
					  <option value="Carnitine palmitoyltransferase defect (CPT1)"';

					  if (!strcmp($row['diagnosis'], 'Carnitine palmitoyltransferase defect (CPT1)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Carnitine palmitoyltransferase defect (CPT1)</option>
					  <option value="Carnitine acylcarnitine trasferase defect (CACT)"';

					  if (!strcmp($row['diagnosis'], 'Carnitine acylcarnitine trasferase defect (CACT)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Carnitine acylcarnitine trasferase defect (CACT)</option>
					  <option value="Very long chain acyl-CoA dehydrogenase deficiency (VLCAD)"';

					  if (!strcmp($row['diagnosis'], 'Very long chain acyl-CoA dehydrogenase deficiency (VLCAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Very long chain acyl-CoA dehydrogenase deficiency (VLCAD)</option>
					  <option value="Medium chain acyl-CoA dehydrogenase deficiency (MCAD)"';

					  if (!strcmp($row['diagnosis'], 'Medium chain acyl-CoA dehydrogenase deficiency (MCAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Medium chain acyl-CoA dehydrogenase deficiency (MCAD)</option>
					  <option value="Short chain acyl-CoA dehydrogenase deficiency (SCAD)"';

					  if (!strcmp($row['diagnosis'], 'Short chain acyl-CoA dehydrogenase deficiency (SCAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Short chain acyl-CoA dehydrogenase deficiency (SCAD)</option>
					  <option value="Acyl-CoA dehydrogenase 9 deficiency (ACAD)"';

					  if (!strcmp($row['diagnosis'], 'Acyl-CoA dehydrogenase 9 deficiency (ACAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Acyl-CoA dehydrogenase 9 deficiency (ACAD)</option>
					  <option value="Long chain 3-hydroxyacyl-CoA dehydrogenase deficiency, isolated (LCHAD)"';

					  if (!strcmp($row['diagnosis'], 'Long chain 3-hydroxyacyl-CoA dehydrogenase deficiency, isolated (LCHAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Long chain 3-hydroxyacyl-CoA dehydrogenase deficiency, isolated (LCHAD)</option>
					  <option value="Mitochondrial trifunctional protein deficiency (MTP)"';

					  if (!strcmp($row['diagnosis'], 'Mitochondrial trifunctional protein deficiency (MTP)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Mitochondrial trifunctional protein deficiency (MTP)</option>
					  <option value="Medium chain 3-hydroxyacyl-CoA dehydrogenase deficiency (MCHAD)"';

					  if (!strcmp($row['diagnosis'], 'Medium chain 3-hydroxyacyl-CoA dehydrogenase deficiency (MCHAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Medium chain 3-hydroxyacyl-CoA dehydrogenase deficiency (MCHAD)</option>
					  <option value="Short chain 3-hydroxyacyl-CoA dehydrogenase deficiency (SCHAD)"';

					  if (!strcmp($row['diagnosis'], 'Short chain 3-hydroxyacyl-CoA dehydrogenase deficiency (SCHAD)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Short chain 3-hydroxyacyl-CoA dehydrogenase deficiency (SCHAD)</option>
					  <option value="Medium chain 3-ketoacyl-CoA thiolase (MKAT)"';

					  if (!strcmp($row['diagnosis'], 'Medium chain 3-ketoacyl-CoA thiolase (MKAT)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Medium chain 3-ketoacyl-CoA thiolase (MKAT)</option>
					  <option value="Electron transfer flavoprotein deficiency (ETF)"';

					  if (!strcmp($row['diagnosis'], 'Electron transfer flavoprotein deficiency (ETF)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Electron transfer flavoprotein deficiency (ETF)</option>
					  <option value="Electron flavoprotein dehydrogenase deficiency (ETFDH)"';

					  if (!strcmp($row['diagnosis'], 'Electron flavoprotein dehydrogenase deficiency (ETFDH)')) {
					  	echo ' selected="selected"';
					  }

					  echo '>Electron flavoprotein dehydrogenase deficiency (ETFDH)</option>
					</select>
				</p>';

				
				$symptoms_array = explode(", ", $row['symptoms']);

				echo '<p>Symptoms/Findings: <br />
				  	<select name="symptoms[]" multiple size=8>
					  <option value="Hypoglycemia" ';

			  	// if option value is included in the symptoms_array, echo "selected".
					  if (in_array("Hypoglycemia", $symptoms_array)) {
					  	echo "selected";
					  }

				echo '>Hypoglycemia</option>
					  <option value="Rhabdomyolysis"';

					  if (in_array("Rhabdomyolysis", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Rhabdomyolysis</option>
					  <option value="Cardiomyopathy" ';

					  if (in_array("Cardiomyopathy", $symptoms_array)) {
					  	echo "selected";
					  }

				echo '>Cardiomyopathy</option>
					  <option value="Cardiac arrhythmia"';

					  if (in_array("Cardiac arrhythmia", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Cardiac arrhythmia</option>
					  <option value="Skeletal Myopathy"';

					  if (in_array("Skeletal Myopathy", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Skeletal Myopathy</option>
					  <option value="Hyperammonemia"';

					  if (in_array("Hyperammonemia", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Hyperammonemia</option>
					  <option value="Peripheral neuropathy"';

					  if (in_array("Peripheral neuropathy", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Peripheral neuropathy</option>
					  <option value="Retinopathy"';

					  if (in_array("Retinopathy", $symptoms_array)) {
					  	echo "selected";
					  }

			    echo '>Retinopathy</option>
					</select>
				</p>';

				echo '<p>Genotype - Allele 1:
					<select name="genotype_a1">
						<option value="Protein"';

						if (!strcmp($row['genotype_a1'], 'Protein')) {
						  	echo ' selected="selected"';
						  }

						echo '>Protein</option>
						<option value="DNA"';

						if (!strcmp($row['genotype_a1'], 'DNA')) {
						  	echo ' selected="selected"';
						  }

						echo '>DNA</option>
					</select>
					<input name="genotype_a1_code" type="text" placeholder="Code" value="' . $row['genotype_a1_code'] . '" />
				</p>

				<p>Genotype - Allele 2:
					<select name="genotype_a2">
						<option value="Protein"';

						if (!strcmp($row['genotype_a2'], 'Protein')) {
						  	echo ' selected="selected"';
						  }

						echo '>Protein</option>
						<option value="DNA"';

						if (!strcmp($row['genotype_a2'], 'DNA')) {
						  	echo ' selected="selected"';
						  }

						echo '>DNA</option>
					</select>
					<input name="genotype_a2_code" type="text" placeholder="Code" value="' . $row['genotype_a2_code'] . '"/>
				</p>

				<p>Phenotype: <input name="phenotype" type="text" size="30" value="' . $row['phenotype'] . '"></p>

				<p>Sample Date: <input name="sample_date" type="date" value="' . $row['sample_date'] . '"></p>

				<p>Demographic Data: <br />
					Age: <input name="age_days" type="number" min="1" style="margin-top:5px; width:5em;" value="' . $row['age_days'] . '" />
					<input name="age_months" type="number" min="1" style="margin-top:5px; width:5em;" value="' . $row['age_months'] . '" />
					<input name="age_years" type="number" min="1" style="margin-top:5px; width:5em;" value="' . $row['age_years'] . '" />
                    <br/>

					Sex: <select name="sex">
						<option value="0"';

						if (!strcmp($row['sex'], '0')) {
						  	echo ' selected="selected"';
						  }

						echo '>Female</option>
						<option value="1"';

						if (!strcmp($row['sex'], '1')) {
						  	echo ' selected="selected"';
						  }

						echo '>Male</option>
					</select><br />
					Ethnic Background: <select name="ethnic">
					    <option value="Mixed Race"';

					    if (!strcmp($row['ethnic'], 'Mixed Race')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Mixed Race</option>
					    <option value="Arctic (Siberian, Eskimo)"';

					    if (!strcmp($row['ethnic'], 'Arctic (Siberian, Eskimo)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Arctic (Siberian, Eskimo)</option>
					    <option value="Caucasian (European)"';

					    if (!strcmp($row['ethnic'], 'Caucasian (European)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Caucasian (European)</option>
					    <option value="Caucasian (Indian)"';

					    if (!strcmp($row['ethnic'], 'Caucasian (Indian)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Caucasian (Indian)</option>
					    <option value="Caucasian (Middle East)"';

					    if (!strcmp($row['ethnic'], 'Caucasian (Middle East)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Caucasian (Middle East)</option>
					    <option value="Caucasian (North African, Other)"';

					    if (!strcmp($row['ethnic'], 'Caucasian (North African, Other)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Caucasian (North African, Other)</option>
					    <option value="Indigenous Australian"';

					    if (!strcmp($row['ethnic'], 'Indigenous Australian')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Indigenous Australian</option>
					    <option value="Native American"';

					    if (!strcmp($row['ethnic'], 'Native American')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Native American</option>
					    <option value="North East Asian (Mongol, Tibetan, Korean Japanese, etc)"';

					    if (!strcmp($row['ethnic'], 'North East Asian (Mongol, Tibetan, Korean Japanese, etc)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>North East Asian (Mongol, Tibetan, Korean Japanese, etc)</option>
					    <option value="Pacific (Polynesian, Micronesian, etc)"';

					    if (!strcmp($row['ethnic'], 'Pacific (Polynesian, Micronesian, etc)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Pacific (Polynesian, Micronesian, etc)</option>
					    <option value="South East Asian (Chinese, Thai, Malay, Filipino, etc)"';

					    if (!strcmp($row['ethnic'], 'South East Asian (Chinese, Thai, Malay, Filipino, etc)')) {
						  	echo ' selected="selected"';
						  }

					    echo '>South East Asian (Chinese, Thai, Malay, Filipino, etc)</option>
					    <option value="West African, Bushmen, Ethiopian"';

					    if (!strcmp($row['ethnic'], 'West African, Bushmen, Ethiopian')) {
						  	echo ' selected="selected"';
						  }

					    echo '>West African, Bushmen, Ethiopian</option>
					    <option value="Other Race"';

					    if (!strcmp($row['ethnic'], 'Other Race')) {
						  	echo ' selected="selected"';
						  }

					    echo '>Other Race</option>
					</select>
				</p>

				<p>Sample Type: 
					<select id="sample_type" name="sample_type">
						<option value=""';

						if (!strcmp($row['sample_type'], '')) {
						  	echo ' selected="selected"';
						  }

						echo '></option>
						<option value="Cell"';

						if (!strcmp($row['sample_type'], 'Cell')) {
						  	echo ' selected="selected"';
						  }

						echo '>Cell</option>
						<option value="Blood"';

						if (!strcmp($row['sample_type'], 'Blood')) {
						  	echo ' selected="selected"';
						  }

						echo '>Blood</option>
						<option value="Urine"';

						if (!strcmp($row['sample_type'], 'Urine')) {
						  	echo ' selected="selected"';
						  }

						echo '>Urine</option>
						<option value="Tissue"';

						if (!strcmp($row['sample_type'], 'Tissue')) {
						  	echo ' selected="selected"';
						  }

						echo '>Tissue</option>
					</select>
				</p>

				<p id="type">Type: <input name="type" type="text" value="' . $row['type'] . '" /></p>
				<p id="passage_num">Passage #: <input name="passage_num" type="text" value="' . $row['passage_num'] . '" /></p>
				<p id="age_at_sampling">Age at sampling: <input name="age_at_sampling" type="text"  value="' . $row['age_at_sampling'] . '"/></p>
				<p id="sick_or_well">Sick or well: <input name="sick_or_well" type="text"  value="' . $row['sick_or_well'] . '"/></p>
				<p id="fed_or_fasted">Fed or fasted: <input name="fed_or_fasted" type="text"  value="' . $row['fed_or_fasted'] . '"/></p>
				<p id="plasma_or_serum_or_dried">Plasma, serum or dried blood spot: <input name="plasma_or_serum_or_dried" type="text" value="' . $row['plasma_or_serum_or_dried'] . '" /></p>
				<p id="frozen_vs_fixed">Frozen vs fixed: <input name="frozen_vs_fixed" type="text" value="' . $row['frozen_vs_fixed'] . '"/></p>
				<p id="prior_results">Prior biochemical results: <input name="prior_results" type="text" value="' . $row['prior_results'] . '"/></p>

				<p id="prior_results">Prior biochemical results: <br /><textarea rows="5" cols="55" name="prior_results" />' . $row['prior_results'] . '</textarea></p>


				<p id="prior_testing">Prior pathology or enzyme testing: <input name="prior_testing" type="text" value="' . $row['prior_testing'] . '" /></p>
		  	
		  </div>
		  <div class="col-md-6">
		  	<h4>Investigator</h4>
		  	<hr />';
				require_once(MYSQL);
				$q = "SELECT first_name, last_name, title, institution, web_address, address1, address2, postal_code, country, email FROM users WHERE user_id={$_SESSION['user_id']}";

				$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

				while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				    echo '<p>Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>';
				    echo '<p>Title: ' . $row['title'] . '</p>';
				    echo '<p>Institution: ' . $row['institution'] . '</p>';
				    echo '<p>Address: ' . $row['address1'] . ' ' . $row['address2'] . ' ' . $row['postal_code'] . '</p>';
				    echo '<p>Country: ' . $row['country'] . '</p>';
				    echo '<p>Web Address: ' . $row['web_address'] . '</p>';
				    echo '<p>Email: ' . $row['email'] . '</p>';
				}
				mysqli_close($dbc);
				
			echo '<br />

				<p><input name="consent" type="checkbox" value="1" checked> Consent obtained for additional research</p>
		  	
		  </div>
		</div>

		<input class="btn btn-primary" type="submit" name="submit" value="Submit" />
		<input type="hidden" name="sample_id" value="' . $sample_id . '" />
		<input type="hidden" name="submitted" value="TRUE" />
	</div>
</form>';
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