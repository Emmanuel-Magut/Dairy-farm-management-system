<!-- php code that processes new member being added to the database-->
<?php
 $errors = array(); // error array
 
$insemination_summary= filter_var( $_POST['insemination_summary'], FILTER_SANITIZE_STRING);
$cow_id = filter_var( $_POST['cow_id'], FILTER_SANITIZE_STRING);

if (empty($errors)) { // if all is well
try {

 require ('mysqli_connect.php'); // Connect to the db. 
 // Make the query: 
$query="INSERT INTO insemination (insemination_id, date_inseminated, insemination_summary, cow_id) VALUES(' ', NOW(), ?, ?);";
 //#8
  $dbcon= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $q = mysqli_stmt_init($dbcon); 
 mysqli_stmt_prepare($q, $query);
 //prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
 mysqli_stmt_bind_param($q, 'ss', $insemination_summary, $cow_id);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted 
 header ("location: insemination_thanks.php");  //insemination_thanks.php page showing successful insemination 
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
 //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
 mysqli_close($dbcon); // Close the database connection.
 // include footer then close program to stop execution
 echo '<footer class="jumbotron text-center col-sm-12"
 style="padding-bottom:1px; padding-top:8px;">
 include("footer.php");
 </footer>';
 exit();
 }
 }
 catch(Exception $e)
 {
 print "The system is busy please try later";
 }
 catch(Error $e)
 {
 print "The system is busy please try again later.";
 }
 } else { 
 $errorstring = "Error! The following error(s) occurred:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " - $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
 echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
 }
?>