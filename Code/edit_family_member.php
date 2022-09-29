<!-- this is the page for editing members details like name and email but not password -->
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
	<title>Edit Member</title>
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
 
 // The code looks for a valid user ID, either through GET or POST:
 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
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
 // Look for the first name: #2
 $first_name =
 filter_var( $_POST['first_name'], FILTER_SANITIZE_STRING);
 if (empty($first_name)) {
 $errors[] = 'You forgot to enter your first name.';
 }
 // Look for the last name:
 $last_name = filter_var( $_POST['last_name'], FILTER_SANITIZE_STRING);
 if (empty($last_name)) {
 $errors[] = 'You forgot to enter your last name.';
 }

  // look for gender
 $gender = filter_var( $_POST['gender'], FILTER_SANITIZE_STRING);
 if (empty($gender)) {
 $errors[] = 'You forgot to enter Gender';
 }
 // Look for the email address:
 $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
 if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
 $errors[] = 'You forgot to enter your email address';
 $errors[] = ' or the e-mail format is incorrect.';
 }
// look for relationship
 $relationship = filter_var( $_POST['relationship'], FILTER_SANITIZE_STRING);
 if (empty($relationship)) {
 $errors[] = 'You forgot to enter relationship.';
 }
$user_level = filter_var( $_POST['user_level'], FILTER_SANITIZE_STRING);

if (empty($errors)) { // If everything's OK. #3
 $q = mysqli_stmt_init($dbcon);
 $query = 'SELECT member_id FROM family_members WHERE email=? AND member_id != ?';
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'si', $email, $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if (mysqli_num_rows($result) == 0) {
 // e-mail does not exist in another record #4
 $query = 'UPDATE family_members SET first_name=?, last_name=?, gender=?, email=?, relationship=?, user_level=? WHERE member_id=? LIMIT 1';
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind values to SQL Statement
mysqli_stmt_bind_param($q, 'ssssssi', $first_name, $last_name, $gender, $email, $relationship, $user_level, $id);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // Update OK
 // Echo a message if the edit was satisfactory:
 echo '<h3 class="text-center">The user has been edited.</h3>';
 } else { // Echo a message if the query failed.
 echo'

 <p class="alert alert-danger">The user could not be edited because no changes were made.
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 </p>';
 }
} else { // Already registered.
 echo '<p class="text-center">The email address has ';
 echo 'already been registered.</p>';
 }
 } else { // Display the errors.
 echo '<p class="text-center">The following error(s) occurred:<br />';
 foreach ($errors as $msg) { // Echo each error.
 echo " - $msg<br />\n";
 }
 echo '</p><p>Please try again.</p>';
 } 
 } // End of the conditionals
 // Select the user's information to display in textboxes: #5
 $q = mysqli_stmt_init($dbcon);
 $query = "SELECT first_name, last_name, gender, email, relationship, user_level FROM family_members WHERE member_id=?";
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'i', $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 if (mysqli_num_rows($result) == 1) { // Valid user ID, display the form.
 // Get the user's information:
 // Create the form:
?>
<h2 class="h2 text-center">Edit Member</h2>
<form action="edit_family_member.php" enctype="multipart/form-data" method="post"
 name="editform" id="editform">
<p><label for="first_name">
 First Name:</label><br>
 <input type="text" class="form-control" id="first_name" name="first_name"
 placeholder="First Name" maxlength="30" required
 value="<?php echo htmlspecialchars($row[0], ENT_QUOTES); ?>" ></p>
<p><label for="last_name">
 Last Name:</label><br>
 <input type="text" class="form-control" id="last_name" name="last_name"
 placeholder="Last Name" maxlength="40" required
 value="<?php echo htmlspecialchars($row[1], ENT_QUOTES); ?>">
</p>
<p><label for="gender">
 Gender:</label><br>
 <input type="text" class="form-control" id="gender" name="gender"
 placeholder="Gender" maxlength="40" required
 value="<?php echo htmlspecialchars($row[2], ENT_QUOTES); ?>">
</div></p>


<p><label for="email">E-mail:</label><br>
 <input type="email" class="form-control" id="email" name="email"
placeholder="E-mail" maxlength="60" required
 value="<?php echo htmlspecialchars($row[3], ENT_QUOTES); ?>">
</p>

<p><label for="relationship">
 Relationship:</label><br>
 <input type="text" class="form-control" id="relationship" name="relationship"
 placeholder="Relationship" maxlength="40" required
 value="<?php echo htmlspecialchars($row[4], ENT_QUOTES); ?>"></p>

<p><label for="user_level">
 User Level:</label><br>
 <input type="number" min= "0" max="3" class="form-control" id="user_level" name="user_level"
 placeholder="User_level" maxlength="40" required
 value="<?php echo htmlspecialchars($row[5], ENT_QUOTES); ?>">
 <span id='message'> Level_0= Regular member. Level_1= Veterinary. Level_2 = Admin</span>

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