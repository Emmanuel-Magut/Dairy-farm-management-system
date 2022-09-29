<!-- page for processing login-->
<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>Logins</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <!-- Bootstrap CSS File -->
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
 integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
 crossorigin="anonymous">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      $('#warn').fadeOut(10000);
	});

	</script>
</head>
<body style="background-color:#EEE;">
<?php

// This section processes submissions from the login form
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //connect to database
try {
 require ('mysqli_connect.php');
// Check for an email address:
 $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
 if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
 $errors[] = 'You forgot to enter your email address';
 $errors[] = ' or the e-mail format is incorrect.';
 }
 // Validate the password
 $password =
 filter_var( $_POST['password'], FILTER_SANITIZE_STRING);
 if (empty($password)) {
 $errors[] = 'You forgot to enter your password.';
 }
 if (empty($errors)) { // If everything's OK. #1
// Retrieve the member_id, password, first_name, user_level for that
// email/password combination
 $query =
 "SELECT member_id, password, first_name, user_level FROM family_members WHERE email=?";
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, "s", $email);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 if (mysqli_num_rows($result) == 1) {
 //if one database row (record) matches the input:-
 // Start the session, fetch the record and insert the
 // values in an array


 if (password_verify($password, $row[1])) {
@session_start();  //#2
 
 // Ensure that the user level is an integer.
$_SESSION['user_level'] = (int) $row[3];
 // Use a ternary operation to set the URL #3

if($_SESSION['user_level']===2){

 header('location: admin_page.php'); //if user level is 2 it directs to admin page
}
 else if($_SESSION['user_level']===1){
 	header('location: veterinary_page.php'); //if user level is 1 it directs to veterinary page
 }

else{
header('location: members_page.php'); 
}
 // Make the browser load either the members or the admin page
 }else { // No password match was made. #4
$errors[] = 'E-mail/Password entered does not match our records. ';
$errors[] = 'Perhaps you need to register, just click the Register ';
$errors[] = 'button on the header menu';
 }
 } else { // No e-mail match was made.
$errors[] = 'E-mail/Password entered does not match our records. ';
$errors[] = 'Perhaps you need to register, just click the Register ';
$errors[] = 'button on the header menu';
}}
if (!empty($errors)) {
 $errorstring =
 "Error! <br /> Oops!:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
echo '<p id="warn" class="alert alert-danger"> Unauthorized Login Attempt. Password/Email Does Not Exist.</p>';

 }// End of if (!empty($errors)) IF.
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_free_result($q);
 mysqli_stmt_close($q);
 }
 catch(Exception $e)
 {
 
//print "The system is busy please try later";
 }
 catch(Error $e)
 {
 //print "The system is busy please try again later.";
 }
} // no else to allow user to enter values
?>

</body>
</html>
