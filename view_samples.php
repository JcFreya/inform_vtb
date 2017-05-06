<?php
require_once('includes/config.php');
$page_title = 'View Samples';
include('includes/header.html');

echo '<h3>Samples List</h3>';

?>

<form action="view_samples.php" method="post" class="navbar-form">
	<div class="form-group">
		<input name="search" type="text" class="form-control" placeholder="Search" />
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
    <input type="hidden" name="submitted" value="TRUE" />
</form>

<div class="container-fluid">
  <table class="table table-striped">
    <thead>
      <tr>
      	<th>Sample ID</th>
        <th>Diagnosis/Disease</th>
        <th>Symptoms/Findings</th>
        <th>Genotype - Allele 1</th>
        <th>Genotype - Allele 1 Code</th>
        <th>Genotype - Allele 2</th>
        <th>Genotype - Allele 2 Code</th>
        <th>Phenotype</th>
        <th>Investigator</th>
<?php
if (isset($_SESSION['investigator_id']) AND $_SESSION['investigator_id'] == 0) {
	echo '<th>Edit</th><th>Delete</th>';
}
?>
      </tr>
    </thead>
    <tbody>
<?php
require_once(MYSQL);

$display = 10;

if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $pages = $_GET['p'];
} else {
    $q = "SELECT COUNT(sample_id) FROM samples";

    $r = @mysqli_query($dbc, $q);

    $row = @mysqli_fetch_array($r, MYSQLI_NUM);

    $records = $row[0];

    if ($records > $display) {
        $pages = ceil($records/$display);
    } else {
        $pages = 1;
    }
}

if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s'];
} else {
    $start = 0;
}

if (isset($_POST['submitted'])) {

    $search = mysqli_real_escape_string($dbc, $_POST['search']);

    $q = "SELECT sample_id, diagnosis, symptoms, genotype_a1, genotype_a1_code, genotype_a2, genotype_a2_code, phenotype, sample_date, age, sex, ethnic, sample_type, users.user_id, first_name, last_name, email
        FROM samples
        LEFT JOIN users ON samples.user_id = users.user_id
        WHERE MATCH (diagnosis, symptoms, genotype_a1, genotype_a1_code, genotype_a2, genotype_a2_code, phenotype, type, passage_num, age_at_sampling, prior_results, sick_or_well, fed_or_fasted, plasma_or_serum_or_dried, frozen_vs_fixed, prior_testing) AGAINST('$search')
        ORDER BY samples.created_at DESC, samples.updated_at DESC
        LIMIT $start, $display";

} else {
    $q = "SELECT sample_id, diagnosis, symptoms, genotype_a1, genotype_a1_code, genotype_a2, genotype_a2_code, phenotype, sample_date, age_days, age_months, age_years, sex, ethnic, sample_type, users.user_id, first_name, last_name, email
        FROM samples
        LEFT JOIN users ON samples.user_id = users.user_id
        ORDER BY samples.created_at DESC, samples.updated_at DESC
        LIMIT $start, $display";    
}


$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '<tr>
    <td><a href="show_sample.php?sample_id=' . $row['sample_id'] . '">' . $row['sample_id'] . '</a></td>
    <td>' . $row['diagnosis'] . '</td>
    <td>' . $row['symptoms']. '</td>
    <td>' . $row['genotype_a1']. '</td>
    <td>' . $row['genotype_a1_code']. '</td>
    <td>' . $row['genotype_a2']. '</td>
    <td>' . $row['genotype_a2_code']. '</td>
    <td>' . $row['phenotype']. '</td>
    <td><a href="mailto:' . $row['email'] .'">' . $row['first_name']. ' ' . $row['last_name'] . '</a>' . '</td>';
    if ($_SESSION['user_id'] == $row['user_id']) {
    	echo '<td><a href="edit_sample.php?sample_id=' . $row['sample_id'] . '" class="btn btn-warning btn-sm">Edit</a></td>
        <td><a href="delete_sample.php?sample_id=' . $row['sample_id'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
    } else {
    	echo '<td>NA</td>
        <td>NA</td>';
    }
    echo '</tr>';
}
echo '</tbody>
  </table>
</div>';
mysqli_close($dbc);

if ($pages > 1) {

    echo '<br /><p>';

    $current_page = ($start/$display) + 1;

    if ($current_page != 1) {
        echo '<a href="view_samples.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a>';
    }

    for ($i = 1; $i <= $pages; $i++) {

        if ($i != $current_page) {

            echo '<a href="view_samples.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
        } else {

            echo $i . ' ';
        }
    }

    if ($current_page != $pages) {

        echo '<a href="view_samples.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>';
    }

    echo '</p>';
}
include('includes/footer.html');
?>