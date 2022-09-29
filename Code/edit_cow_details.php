<!-- page for editing coe details -->
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
	<title>Edit Cow Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
          <h1 class="mb-3">Edit Details</h1>
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
			<div class="col-xs-6 col-md-6 col-lg-12">

<?php
 try
 {
 
 
 // The code looks for a valid cow ID, either through GET or POST:
 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
 // From view_users.php
 $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
 } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
 // Form submission.
 $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
 } else { // No valid ID, kill the script.
 echo '<p class="text-center">This page has been accessed in error.</p>';
 include ('footer.php');
 exit();
 }
require ('mysqli_connect.php');
 // Has the form been submitted?
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array();
$serial_no_name = filter_var( $_POST['serial_no_name'], FILTER_SANITIZE_STRING);
$gender= filter_var( $_POST['gender'], FILTER_SANITIZE_STRING);
$breed_type = filter_var( $_POST['breed_type'], FILTER_SANITIZE_STRING);
$year_of_birth = filter_var( $_POST['year_of_birth'], FILTER_SANITIZE_STRING);
//$cow_photo = filter_var( $_POST['cow_photo'], FILTER_SANITIZE_STRING);
 

if (empty($errors)) { // If everything's OK. #3
 $q = mysqli_stmt_init($dbcon);
 $query = 'SELECT cow_id FROM cows WHERE serial_no_name=? AND cow_id !=?';
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'si', $email, $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if (mysqli_num_rows($result) == 0) {
 // e-mail does not exist in another record #4
 $query = 'UPDATE cows SET serial_no_name=?, gender=?, breed_type=?, year_of_birth=?';
 $query .= ' WHERE cow_id=? LIMIT 1';
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind values to SQL Statement
mysqli_stmt_bind_param($q, 'ssssi', $serial_no_name, $gender, $breed_type, $year_of_birth, $id);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // Update OK
 // Echo a message if the edit was satisfactory:
 echo '<h3 class="text-center">The record has been edited.</h3>';
 } else { // Echo a message if the query failed.
 echo'

 <p class="alert alert-danger">The details could not be edited because no changes were made.
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 </p>';
 
 }
} else { // Already registered.
 echo '<p class="text-center">The Serial_No/Name has ';
 echo 'already been registered.</p>';
 }
 } else { // Display the errors.
 echo '<p class="text-center">The following error(s) occurred:<br />';
 foreach ($errors as $msg) { // Echo each error.
 echo " - $msg<br />\n";
 }
 echo '</p><p>Please try again.</p>';
 } // End of if (empty($errors))section.
 } // End of the conditionals
 
 $q = mysqli_stmt_init($dbcon);
 $query = "SELECT serial_no_name, gender, breed_type, year_of_birth FROM cows WHERE cow_id=?";
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'i', $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 if (mysqli_num_rows($result) == 1) { 
 
 // Create the form:
?>
<h2 class="h2 text-center">Edit Cow Details</h2>
<form action="edit_cow_details.php" method="post"
 name="editform" enctype="multipart/form-data" id="editform">
<p><label for="serial_no_name">
 Serial_No/Name:</label><br>
 <input type="text" class="form-control" id="serial_no_name" name="serial_no_name"
 placeholder="Serial_No/Name" maxlength="30" required
 value="<?php echo htmlspecialchars($row[0], ENT_QUOTES); ?>" ></p>
<p><label for="gender">
 Gender:</label><br>
 <input type="text" class="form-control" id="gender" name="gender"
 placeholder="Gender" maxlength="40" required
 value="<?php echo htmlspecialchars($row[1], ENT_QUOTES); ?>">
</p>
<p><label for="breed_type">
 Breed/Type:</label><br>
 <input type="text" class="form-control" id="breed_type" name="breed_type"
 placeholder="Breed" maxlength="40" required
 value="<?php echo htmlspecialchars($row[2], ENT_QUOTES); ?>">
</div></p>


<p><label for="year_of_birth">Year Of Birth><br>
 <input type="text"  class="form-control" id="year_of_birth" name="year_of_birth"
placeholder="Birth Year" maxlength="60" required
 value="<?php echo htmlspecialchars($row[3], ENT_QUOTES); ?>">
</p>
<input type="hidden" name="id" value=" <?php echo $id ?>" /> <!-- #6 -->
<div class="form-group row">
 <label for="" class="col-sm-4 col-form-label"></label>
<div class="col-sm-8">
 <input id="submit" class="btn btn-primary" type="submit" name="submit" 
value="Edit">
</div>
</div>
</form>
<?php
 } else { // The user could not be validated
echo '<p class="text-center">This page has been accessed in error.</p>';
 }
 mysqli_stmt_free_result($q);
 mysqli_close($dbcon);
 }
 catch(Exception $e)
 {
 print "The system is busy. Please try later";
 }
 catch(Error $e)
 {
 print "The system is currently busy. Please try later";
 }
?>	
			</div>
		</div> <!-- end row div -->
	</div> <!-- end container div-->
</body>
</html>