<!-- page for processing password change-->
<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Process Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style type="text/css">
form .error {
  color: #ff0000;
}
input.error, select.error, textarea.error{
	border: 1px red solid;
}
</style> 
	<!-- Bootstrap CSS File -->
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
 integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
 crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
      $('#passworderror').fadeOut(10000);
	});
</script>
</head>
<body>
<?php
// This script is a query that UPDATES the password in the users table.
// Check that form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
require ('mysqli_connect.php'); // Connect to the db.
$errors = array(); // Initialize an error array.
// Check for an email address:
$email = trim($_POST['email']);
if (empty($email)) {
 $errors[] = 'You forgot to enter your email address.';
}
// Check for a password and match against the confirmed password:
$password = trim($_POST['password']);
if (empty($password)) {
 $errors[] = 'You forgot to enter your old password.';
}
// Prepare and check new password 
$new_password = trim($_POST['password1']);
$verify_password = trim($_POST['password2']);
if (!empty($new_password)) {
 if (($new_password != $verify_password) ||
 ( $password == $new_password ))
 {
$errors[] = 'Your old password is the same as your new password.';
 }
} else {
 $errors[] = 'You did not enter a new password.';
}if (empty($errors)) { // If everything's OK.
try {
 // Check that the user has entered the right email address/password combination: #2
 $query = "SELECT member_id, password FROM family_members WHERE ( email=? )";
$q = mysqli_stmt_init($dbcon);
mysqli_stmt_prepare($q, $query);
 //prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
mysqli_stmt_bind_param($q, 's', $email);
 // execute query
 mysqli_stmt_execute($q);
$result = mysqli_stmt_get_result($q);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if ((mysqli_num_rows($result) == 1) //#3
 && (password_verify($password, $row['password'])))
 { // Found one record
 // Change the password in the database...
 // Hash password 
 $hashed_passcode = password_hash($new_password, PASSWORD_DEFAULT);
 // Make the query:
 $query = "UPDATE family_members SET password=? WHERE email=?";
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 //prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
 mysqli_stmt_bind_param($q, 'ss', $hashed_passcode, $email);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // one row updated #4
 // Thank you
header ("location:password-thanks.php");
 exit();
 } else { // If it did not run OK. #5
 // Public message:
 $errorstring = "System Error! <br /> You could not change password due ";
 $errorstring .= "to a system error. We apologize for any inconvenience.</p>";
 echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
 // Debugging message below do not use in production
 //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
 // include footer then close program to stop execution
 echo '<footer class="jumbotron text-center col-sm-12"
 style="padding-bottom:1px; padding-top:8px;">
 include("footer.php");
 </footer>';
 exit();
 }
 } else { // Invalid email address/password combination.
 $errorstring = 'Error! <br /> ';
 $errorstring .= 'The email address or password does not match those 
on file.';
 $errorstring .= " Please try again.";
 echo ' <p id="passworderror" class="alert alert-danger">Ooops! The current email address/password entered does not exist</p>
 ';
} }
 catch(Exception $e)
 {
 
 print "The system is busy please try later";
 }
 catch(Error $e)
 {

 print "The system is busy please try again later.";
 }
 } else { 
 $errorstring = "Error!<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= "  $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
 echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
 }
} 
?>
</body>
</html>
