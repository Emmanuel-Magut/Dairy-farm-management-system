<!-- page for viewing registered members-->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View_Members</title>
	<meta charset="utf-8">
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
          <h1 class="mb-3">Membership Database</h1>
          </div>
      </div>
    </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'admin_page.php'" >Home</button>
</div>
 </nav>
</header>
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-lg-8 col-md-6">
           <h1>These are the registered members</h1>
           <?php
try {
 // This script retrieves all the records
 require('mysqli_connect.php'); // Connect to the database.
 //set the number of rows per display page
 $pagerows = 2; // #1
 if ((isset($_GET['p']) && is_numeric($_GET['p']))) {
 $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
 }else{//use the next block of code to calculate the number of pages 
 //First, check for the total number of records
 $q = "SELECT COUNT(member_id) FROM family_members";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
$records = htmlspecialchars($row[0], ENT_QUOTES);
 if ($records > $pagerows){ // 
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
 }else{
 $start = 0;
 }

 $query = "SELECT member_id, last_name, first_name, email, gender, relationship, profile_photo, registration_date AS regdat, user_level  FROM family_members ORDER BY registration_date"; // #5
 $query .=" LIMIT ?, ?";
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 mysqli_stmt_bind_param($q, "ii", $start, $pagerows);
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if ($result) {
 // If it ran OK (records were returned), display the records.
 // Table header.
 echo '<table class="table table-striped table-hover table-responsive" style="overflow: auto;">
 <tr>
 <th scope="col">Edit</th>
 <th scope="col">Delete</th>
 <th scope="col">Last Name</th>
 <th scope="col">First Name</th>
 <th scope="col">Email</th>
 <th scope="col">Gender</th>
 <th scope="col">Relationship</th>
 <th scope="col">Profile</th>
 <th scope="col">Date Registered</th>
 <th scope="col">User Level</th>
 </tr>';
 // Fetch and print all the records:
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 // Remove special characters that might already be in table to
 // reduce the chance of XSS exploits
 $member_id = htmlspecialchars($row['member_id'], ENT_QUOTES);
 $last_name =htmlspecialchars($row['last_name'], ENT_QUOTES);
 $first_name =htmlspecialchars($row['first_name'], ENT_QUOTES);
 $email = htmlspecialchars($row['email'], ENT_QUOTES);
 $gender=htmlspecialchars($row['gender'],ENT_QUOTES);
 $relationship=htmlspecialchars($row['relationship'], ENT_QUOTES);
 $profile_photo=htmlspecialchars($row['profile_photo'], ENT_QUOTES);
 $registration_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
 $user_level= htmlspecialchars($row['user_level'], ENT_QUOTES);

 echo '<tr>
 <td><a href="edit_family_member.php?id=' . $member_id .'">Edit</a></td>
 <td><a href="delete_family_member.php?id=' . $member_id .'">Delete</a></td>
 <td>' . $last_name . '</td>
 <td>' . $first_name . '</td>
 <td>' . $email . '</td>
 <td>' . $gender .'</td>
 <td>' . $relationship . '</td>
 <td  width="300" align="center"><font color="white"><img src="images/' . $profile_photo . '" class="img-rounded img-fluid" height=150 width=250> </td>
 <td>' . $registration_date . '</td>
 <td>' . $user_level. '</td>
 </tr>';
 }
 echo '</table>'; // Close the table.
 mysqli_free_result ($result); // Free up the resources.
 }
 else { // If it did not run OK.
 // Error message:
 echo '<p class="text-center">The current users could not be ';
 echo 'retrieved. We apologize for any inconvenience.</p>';
 exit;
 } 
 // Now display the total number of records/members. 
 $q = "SELECT COUNT(member_id) FROM family_members";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
 $members = htmlspecialchars($row[0], ENT_QUOTES);
 mysqli_close($dbcon); // Close the database connection.
 $echostring = "<p class='text-center'>Total membership: $members </p>";
 $echostring .= "<p class='text-center'>";
 if ($pages > 1) { // #7
 //What number is the current page?
 $current_page = ($start/$pagerows) + 1;
 //creates the link of the prev page
 if ($current_page != 1) {
 $echostring .=
 ' <a href="view_family_members.php?s=' . ($start - $pagerows) .
 '&p=' . $pages . '">previous</a> ';
 }
 //Create a Next link 
 if ($current_page != $pages) {
 $echostring .=
 ' <a href="view_family_members.php?s=' . ($start + $pagerows) .
 '&p=' . $pages . '">Next</a> ';
 }
 $echostring .= '</p>';
 echo $echostring;
 }
} //end of try
catch(Exception $e) // all problems are handled here
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