<?php

require_once('config/config.php');

$page_title = 'Register';

include('includes/header.html');

if (isset($_POST['submitted'])) {

	require_once(MYSQL);

$diagnosis = mysqli_real_escape_string($dbc, $_POST['diagnosis']);
$symptoms = mysqli_real_escape_string($dbc, $_POST['symptoms']);
$genotype_a1 = mysqli_real_escape_string($dbc, $_POST['genotype_a1']);
$genotype_a1_code = mysqli_real_escape_string($dbc, $_POST['genotype_a1_code']);
$genotype_a2 = mysqli_real_escape_string($dbc, $_POST['genotype_a2']);
$genotype_a2_code = mysqli_real_escape_string($dbc, $_POST['genotype_a2_code']);
$phenotype = mysqli_real_escape_string($dbc, $_POST['phenotype']);
$sample_date = mysqli_real_escape_string($dbc, $_POST['sample_date']);
$age = mysqli_real_escape_string($dbc, $_POST['age']);
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
$user_id = $_SESSION['user_id'];

	$q = "INSERT INTO samples (
diagnosis,
symptoms,
genotype_a1,
genotype_a1_code,
genotype_a2,
genotype_a2_code,
phenotype,
sample_date,
-- age,
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
user_id) VALUES (
'$diagnosis',
'$symptoms',
'$genotype_a1',
'$genotype_a1_code',
'$genotype_a2',
'$genotype_a2_code',
'$phenotype',
'$sample_date',
-- '$age',
'$sex',
'$ethnic',
'$sample_type',
'$type',
'$passage_num',
'$age_at_sampling',
'$prior_results',
'$sick_or_well',
'$fed_or_fasted',
'$plasma_or_serum_or_dried',
'$frozen_vs_fixed',
'$prior_testing',
'$consent',
'$user_id'
)";
	$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	if (mysqli_affected_rows($dbc) == 1) {

		mysqli_free_result($r);

		mysqli_close($dbc);

		$url = BASE_URL . 'view_samples.php';

		header("Location: $url");

		exit();

	} else{
		echo '<p class="error">Internal Error</p>';

		mysqli_close($dbc);
	}

	
}
?>

<h3>Create Sample</h3>

<form action="create_sample.php" method="post">
	<div class="container">
		<div class="row">
		  <div class="col-md-6">
		  	<h4>Sample</h4>
		  	<hr />
		  		<p>Diagnosis/Disease: 
				  	<select name="diagnosis">
					  <option value="Carnitine transporter defect">Carnitine transporter defect</option>
					  <option value="Carnitine palmitoyltransferase defect (CPT1)">Carnitine palmitoyltransferase defect (CPT1)</option>
					  <option value="Carnitine acylcarnitine trasferase defect (CACT)">Carnitine acylcarnitine trasferase defect (CACT)</option>
					  <option value="Very long chain acyl-CoA dehydrogenase deficiency (VLCAD)">Very long chain acyl-CoA dehydrogenase deficiency (VLCAD)</option>
					  <option value="Medium chain acyl-CoA dehydrogenase deficiency (MCAD)">Medium chain acyl-CoA dehydrogenase deficiency (MCAD)</option>
					  <option value="Short chain acyl-CoA dehydrogenase deficiency (SCAD)">Short chain acyl-CoA dehydrogenase deficiency (SCAD)</option>
					  <option value="Acyl-CoA dehydrogenase 9 deficiency (ACAD)">Acyl-CoA dehydrogenase 9 deficiency (ACAD)</option>
					  <option value="Long chain 3-hydroxyacyl-CoA dehydrogenase deficiency, isolated (LCHAD)">Long chain 3-hydroxyacyl-CoA dehydrogenase deficiency, isolated (LCHAD)</option>
					  <option value="Mitochondrial trifunctional protein deficiency (MTP)">Mitochondrial trifunctional protein deficiency (MTP)</option>
					  <option value="Medium chain 3-hydroxyacyl-CoA dehydrogenase deficiency (MCHAD)">Medium chain 3-hydroxyacyl-CoA dehydrogenase deficiency (MCHAD)</option>
					  <option value="Short chain 3-hydroxyacyl-CoA dehydrogenase deficiency (SCHAD)">Short chain 3-hydroxyacyl-CoA dehydrogenase deficiency (SCHAD)</option>
					  <option value="Medium chain 3-ketoacyl-CoA thiolase (MKAT)">Medium chain 3-ketoacyl-CoA thiolase (MKAT)</option>
					  <option value="Electron transfer flavoprotein deficiency (ETF)">Electron transfer flavoprotein deficiency (ETF)</option>
					  <option value="Electron flavoprotein dehydrogenase deficiency (ETFDH)">Electron flavoprotein dehydrogenase deficiency (ETFDH)</option>
					</select>
				</p>

				<p>Symptoms/Findings: 
				  	<select name="symptoms">
					  <option value="Hypoglycemia">Hypoglycemia</option>
					  <option value="Rhabdomyolysis">Rhabdomyolysis</option>
					  <option value="Cardiomyopathy">Cardiomyopathy</option>
					  <option value="Cardiac arrhythmia">Cardiac arrhythmia</option>
					  <option value="Skeletal Myopathy">Skeletal Myopathy</option>
					  <option value="Hyperammonemia">Hyperammonemia</option>
					  <option value="Peripheral neuropathy">Peripheral neuropathy</option>
					  <option value="Retinopathy">Retinopathy</option>
					</select>
				</p>

				<p>Genotype - Allele 1:
					<select name="genotype_a1">
						<option value="Protein">Protein</option>
						<option value="DNA">DNA</option>
					</select>
					<input name="genotype_a1_code" type="text" placeholder="Code" />
				</p>

				<p>Genotype - Allele 2:
					<select name="genotype_a2">
						<option value="Protein">Protein</option>
						<option value="DNA">DNA</option>
					</select>
					<input name="genotype_a2_code" type="text" placeholder="Code" />
				</p>

				<p>Phenotype: <input name="phenotype" type="text" size="30" placeholder="Hypoglycemia Rhadomyolysis"></p>

				<p>Sample Date: <input name="sample_date" type="date"></p>

				<p>Demographic Data: <br />
					Age: <input name="age" type="number" min="1" placeholder="Age" style="margin-top:5px"/>
                    <br/>
					Sex: <select name="sex" style="margin-top:5px; margin-bottom:5px">
						<option value="0">Female</option>
						<option value="1">Male</option>
					</select>
                    <br/>
					Ethnic Background: <select name="ethnic" style="margin-top:5px">
					    <option value="Mixed Race">Mixed Race</option>
					    <option value="Arctic (Siberian, Eskimo)">Arctic (Siberian, Eskimo)</option>
					    <option value="Caucasian (European)">Caucasian (European)</option>
					    <option value="Caucasian (Indian)">Caucasian (Indian)</option>
					    <option value="Caucasian (Middle East)">Caucasian (Middle East)</option>
					    <option value="Caucasian (North African, Other)">Caucasian (North African, Other)</option>
					    <option value="Indigenous Australian">Indigenous Australian</option>
					    <option value="Native American">Native American</option>
					    <option value="North East Asian (Mongol, Tibetan, Korean Japanese, etc)">North East Asian (Mongol, Tibetan, Korean Japanese, etc)</option>
					    <option value="Pacific (Polynesian, Micronesian, etc)">Pacific (Polynesian, Micronesian, etc)</option>
					    <option value="South East Asian (Chinese, Thai, Malay, Filipino, etc)">South East Asian (Chinese, Thai, Malay, Filipino, etc)</option>
					    <option value="West African, Bushmen, Ethiopian">West African, Bushmen, Ethiopian</option>
					    <option value="Other Race">Other Race</option>
					</select>
				</p>

				<p>Sample Type: 
					<select id="sample_type" name="sample_type">
						<option value=""></option>
						<option value="Cell">Cell</option>
						<option value="Blood">Blood</option>
						<option value="Urine">Urine</option>
						<option value="Tissue">Tissue</option>
					</select>
				</p>

				<p id="type">Type: <input name="type" type="text" /></p>
				<p id="passage_num">Passage #: <input name="passage_num" type="text" /></p>
				<p id="age_at_sampling">Age at sampling: <input name="age_at_sampling" type="text" /></p>
				<p id="sick_or_well">Sick or well: <input name="sick_or_well" type="text" /></p>
				<p id="fed_or_fasted">Fed or fasted: <input name="fed_or_fasted" type="text" /></p>
				<p id="plasma_or_serum_or_dried">Plasma, serum or dried blood spot: <input name="plasma_or_serum_or_dried" type="text" /></p>
				<p id="frozen_vs_fixed">Frozen vs fixed: <input name="frozen_vs_fixed" type="text" /></p>
				<p id="prior_results">Prior biochemical results: <input name="prior_results" type="text" /></p>
				<p id="prior_testing">Prior pathology or enzyme testing: <input name="prior_testing" type="text" /></p>
		  	
		  </div>
		  <div class="col-md-6">
		  	<h4>Investigator</h4>
		  	<hr />
				<?php
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
				?>

				<br />

				<p><input name="consent" type="checkbox" value="1" checked> Consent obtained for additional research</p>
		  	
		  </div>
		</div>

		<input class="btn btn-primary" type="submit" name="submit" value="Submit" />
		<input type="hidden" name="submitted" value="TRUE" />
	</div>
</form>

<script>

$(document).ready(function(){

	hideAll();	

	$('#sample_type').change(function(){
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