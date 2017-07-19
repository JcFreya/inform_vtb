<?php
require_once('config/config.php');
$page_title = 'Welcome to INFORM Virtual Tissue Bank';
include('includes/header.html');
?>

<div class="container">
<h3>Investigators List</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Institution</th>
        <th>Address</th>
        <th>Country</th>
        <th>Web</th>
      </tr>
    </thead>
    <tbody>
<?php
require_once(MYSQL);
$q = "SELECT first_name, last_name, title, institution, web_address, address1, address2, address3, postal_code, country FROM users WHERE investigator_id=0 AND active=''";

$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '<tr>  
    <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
    <td>' . $row['title']. '</td>
    <td>' . $row['institution']. '</td>
    <td>' . $row['address1'] . ' ' . $row['address2'] . ' ' . $row['address3'] . ' ' . $row['postal_code'] . '</td>
    <td>' . $row['country']. '</td>    
    <td><a href="' . $row['web_address']. '" target="_blank">Visit</a></td></tr>';
    
}
mysqli_close($dbc);
?>
        
    </tbody>
  </table>
</div>

<?php
include('includes/footer.html');
?>

<script>
(function ($) {
    $(".banner-info").css("padding-top","190px"); 
    $(".banner-info").css("visibility","visible"); 
    $("#banner").css("min-height","650px"); 
    $(".bg-color").css("min-height","650px"); 
    
})(jQuery);
</script>



