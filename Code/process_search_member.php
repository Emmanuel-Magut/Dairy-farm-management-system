<!-- page that processes member search-->
<!DOCTYPE html>
<html>
<head>
	<title>Member Search</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- jQuery -->
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQueryUI -->
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="https://cdn.jquery.anythingslider.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-lg-8">
				<?php
try
{
 // This script retrieves records 
require ('mysqli_connect.php'); // Connect to the db.
 echo '<p class="text-center">If no record is shown, ';
 echo 'this is because you had an incorrect ';
 echo ' or missing entry in the search form.';
 echo '<br>Click the back button on the browser and try again</p>';
 // #1
 $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
 $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
 
 $query = "SELECT last_name, first_name, gender, email, relationship,profile_photo,";
 $query .= "DATE_FORMAT(registration_date, '%M %d, %Y')";
 $query .=" AS regdat, member_id FROM family_members WHERE ";
 $query .= "last_name=? AND first_name=? ";
 $query .="ORDER BY registration_date ASC ";
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind values to SQL Statement
 mysqli_stmt_bind_param($q, 'ss', $last_name, $first_name);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if ($result) { //display the records.
 // Table header.
 echo '<table class="table table-striped">
 <tr>
 <th scope="col">Edit</th>
 <th scope="col">Delete</th>
 <th scope="col">Last Name</th>
 <th scope="col">First Name</th>
 <th scope="col">Gender</th>
 <th scope="col">Email</th>
 <th scope="col">Relationship</th>
 <th scope="col">Profile</th>
 <th scope="col">Date Registered</th>
 </tr>';
 // Fetch and display the records:
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 // Remove special characters that might already be in table to
 // reduce the chance of XSS exploits
 $member_id = htmlspecialchars($row['member_id'], ENT_QUOTES);
 $last_name =
 htmlspecialchars($row['last_name'], ENT_QUOTES);
 $first_name =
 htmlspecialchars($row['first_name'], ENT_QUOTES);
 $gender =
 htmlspecialchars($row['gender'], ENT_QUOTES);
 $email =
 htmlspecialchars($row['email'], ENT_QUOTES);
 $relationship =
 htmlspecialchars($row['relationship'], ENT_QUOTES);
 $profile_photo=
 htmlspecialchars($row['profile_photo'], ENT_QUOTES);
 $registration_date =
 htmlspecialchars($row['regdat'], ENT_QUOTES);
 echo '<tr>

<td><a href="edit_family_member.php?id=' . $member_id .
 '">Edit</a></td>
 <td><a href="delete_family_member.php?id=' . $member_id .
 '">Delete</a></td>
 <td>' . $last_name . '</td>
 <td>' . $first_name . '</td>
 <td>' . $gender . '</td>
 <td>' . $email . '</td>
 <td>' . $relationship . '</td>
 <td>' . $profile_photo . '</td>
<td>' . $registration_date . '</td>
 </tr>';
 }
 echo '</table>'; // Close the table.
 
 mysqli_free_result ($result); 
 } else { 
echo '<p class="text-center">The current users could not be retrieved.';
 echo 'We apologize for any inconvenience.</p>';
 
 }
 mysqli_close($dbcon); // Close the database connection.
 }
 catch(Exception $e)
 {
 print "The system is currently busy. Please try later.";
 }
 catch(Error $e)
 {
 print "The system us busy. Please try later.";
 }

?>
</body>
</html>
