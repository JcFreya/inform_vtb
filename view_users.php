<?php
require_once('includes/config.php');
$page_title = 'Manage users';
include('includes/header.html');

echo '<h3>User List</h3>';

?>

<div class="container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Title</th>
        <th>Institution</th>
        <th>Address</th>
        <th>Country</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
<?php
require_once(MYSQL);
$q = "SELECT user_id, first_name, last_name, title, institution, web_address, address1, address2, address3, postal_code, country FROM users WHERE active=''";

$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '<tr>
    <td>' . $row['user_id'] . '</td>  
    <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
    <td>' . $row['title']. '</td>
    <td>' . $row['institution']. '</td>
    <td>' . $row['address1'] . ' ' . $row['address2'] . ' ' . $row['address3'] . ' ' . $row['postal_code'] . '</td>
    <td>' . $row['country']. '</td> 
    <td><a href="edit_user.php?user_id=' . $row['user_id'] . '" class="btn btn-warning btn-sm">Edit</a></td>
    <td><a href="delete_user.php?user_id=' . $row['user_id'] . '" class="btn btn-danger btn-sm">Delete</a></td></tr>';
    
}
mysqli_close($dbc);
?>
        
    </tbody>
  </table>
</div>

<?php
include('includes/footer.html');
?>


