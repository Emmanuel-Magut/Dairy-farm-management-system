<!-- page that processes registration of vaccination-->
<?php
 $errors = array(); // error array
 
$vaccine_name = filter_var( $_POST['vaccine_name'], FILTER_SANITIZE_STRING);
$vaccination_description= filter_var( $_POST['vaccination_description'], FILTER_SANITIZE_STRING);
$cow_id = filter_var( $_POST['cow_id'], FILTER_SANITIZE_STRING);

 

if (empty($errors)) { // If everything's Ok.
try {

 require ('mysqli_connect.php'); // Connect to the db.
 // Make the query: #
$query="INSERT INTO vaccination (vaccine_id, vaccine_name, date_administered, vaccination_description, cow_id) VALUES(' ', ?, NOW(), ?, ?);";
 $dbcon= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $q = mysqli_stmt_init($dbcon); 
 mysqli_stmt_prepare($q, $query);
 //prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
 mysqli_stmt_bind_param($q, 'sss', $vaccine_name, $vaccination_description, $cow_id);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted #10
 header ("location: vaccination_thanks.php");
 exit();
 } else { // If it did not run OK.
 // Public message:
 $errorstring = "<p class='text-center col-sm-8' 
style='color:red'>";
 $errorstring .= "System Error<br />You could not be registered due ";
 $errorstring .= "to a system error. We apologize for any 
inconvenience.</p>";
 echo "<p class=' text-center col-sm-2' 
style='color:red'>$errorstring</p>";
// echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
 mysqli_close($dbcon); // Close the database connection.
 // include footer then close program to stop execution
 echo '<footer class="jumbotron text-center col-sm-12"
 style="padding-bottom:1px; padding-top:8px;">
 include("footer.php");
 </footer>';
 exit();
 }
 }
 catch(Exception $e) // We finally handle any problems here #11
 {
 print "The system is busy please try later";
 }
 catch(Error $e)
 {
 print "The system is busy please try again later.";
 }
 } else { // Report the errors. #12
 $errorstring = "Error! The following error(s) occurred:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " - $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
 echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
 }// End of if (empty($errors)) IF.
?>