<!--Page for viewing registered cows-->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2) AND ($_SESSION['user_level'] !=1))
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registered Cows</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
<body style="background-color:#EEE;">
	<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>

 <div class="mask">
     <div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">Dairy Cattle Database</h1>
          </div>
      </div>
    </div>
    </div>
</header>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-lg-8 ">
           <h1>Registered Cows</h1>
           <?php
try {
 // This script retrieves all the records 
 require('mysqli_connect.php'); // Connect to the database.
 $pagerows = 2; 
 if ((isset($_GET['p']) && is_numeric($_GET['p']))) {
 $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
 // make sure it is not executable XSS
 }else{//use the next block of code to calculate the number of pages 
 //First, check for the total number of records
 $q = "SELECT COUNT(cow_id) FROM cows";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
$records = htmlspecialchars($row[0], ENT_QUOTES); 
 // make sure it is not executable XSS
 //Now calculate the number of pages
 if ($records > $pagerows){ // #3
 //if the number of records will fill more than one page
 //Calculate the number of pages and round the result up to the
 // nearest integer
 $pages = ceil ($records/$pagerows); //
 }else{
 $pages = 1;
 }
 }//page check finished
 //Declare which record to start with #4
 if ((isset($_GET['s'])) &&( is_numeric($_GET['s'])))
 {
 $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
 // make sure it is not executable XSS
 }else{
 $start = 0;
 }

 $query = "SELECT cow_id, serial_no_name, gender, breed_type, year_of_birth, cow_photo, registration_date FROM cows ORDER BY registration_date ASC"; // #5
  $query .=" LIMIT ?, ?";
  $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind start and pagerows to SQL Statement
 mysqli_stmt_bind_param($q, "ii", $start, $pagerows);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if ($result) {
 // Table header.
 echo '<table class="table table-striped table-hover table-responsive">
 <tr>
 <th scope="col">Edit</th>
 <th scope="col">Delete</th>
 <th scope="col">cow_id</th>
 <th scope="col">Serial_No_Name</th>
 <th scope="col">Gender</th>
 <th scope="col">Breed_Type</th>
 <th scope="col">Year_Of_Birth</th>
 <th scope="col">Photo</th>
 <th scope="col">Date Registered</th>
 </tr>';
 // Fetch and print all the records:
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 // Remove special characters that might already be in table to
 // reduce the chance of XSS exploits
 $cow_id = htmlspecialchars($row['cow_id'], ENT_QUOTES);
 $serial_no_name=htmlspecialchars($row['serial_no_name'], ENT_QUOTES);
 $gender =htmlspecialchars($row['gender'], ENT_QUOTES);
 $breed_type = htmlspecialchars($row['breed_type'], ENT_QUOTES);
 $year_of_birth=htmlspecialchars($row['year_of_birth'],ENT_QUOTES);
 $cow_photo=htmlspecialchars($row['cow_photo'], ENT_QUOTES);
  $registration_date=htmlspecialchars($row['registration_date'], ENT_QUOTES);

 echo '<tr>
 <td><a href="edit_cow_details.php?id=' . $cow_id .'">Edit</a></td>
 <td><a href="delete_cow.php?id=' . $cow_id .'">Delete</a></td>
 <td>' . $cow_id . '</td>
 <td>' . $serial_no_name . '</td>
 <td>' . $gender. '</td>
 <td>' . $breed_type . '</td>
 <td>' . $year_of_birth .'</td>
 <td><img src="images/'. $cow_photo . '" height="200" width="200"></td>
 <td>' . $registration_date . '</td>

 </tr>';
 }
 echo '</table>'; // Close the table.
 mysqli_free_result ($result); // Free up the resources.
 }
 else { 
 echo '<p class="text-center">The current users could not be ';
 echo 'retrieved. We apologize for any inconvenience.</p>';
 exit;
 } 
 $q = "SELECT COUNT(cow_id) FROM cows";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
 $members = htmlspecialchars($row[0], ENT_QUOTES);
 mysqli_close($dbcon); // Close the database connection.
 $echostring = "<p class='text-center'>Total membership: $members </p>";
 $echostring .= "<p class='text-center'>";
 if ($pages > 1) { // #7
 
 $current_page = ($start/$pagerows) + 1;
 //creates the link of the prev page
 if ($current_page != 1) {
 $echostring .=
 ' <a href="view_registered_cows.php?s=' . ($start - $pagerows) .
 '&p=' . $pages . '">previous</a> ';
 }
 //Create a Next link 
 if ($current_page != $pages) {
 $echostring .=
 ' <a href="view_registered_cows.php?s=' . ($start + $pagerows) .
 '&p=' . $pages . '">Next</a> ';
 }
 $echostring .= '</p>';
 echo $echostring;
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
?>
            
			</div>
		</div> <!-- end row-->
    <footer class="jumbotron text-center row"
 style="padding-bottom:1px; padding-top:8px;">
<?php include('footer.php'); ?>
 </footer>
	</div>
</body>
</html>