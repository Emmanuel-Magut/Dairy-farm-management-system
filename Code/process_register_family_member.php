<!-- page that processes new member being added to the database-->
<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
// Check if file already exists
if (file_exists($target_file)) {
  print "Sorry, file already exists.";
  $uploadOk = 0;
}

 //Check file size
if ($_FILES["profile_photo"]["size"] > 500000) {
  print "Sorry, your file is too large.";
  $uploadOk = 0;} 

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType !="webp"  && $imageFileType !="jfif") {
  print "Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  print "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
    print "The file ". htmlspecialchars( basename( $_FILES["profile_photo"]["name"])). " has been uploaded.";
  } else {
    print "Sorry, there was an error uploading your file.";
  } 
}

$errors = array(); 
 // Check for a first name: #2
$first_name = filter_var( $_POST['first_name'], FILTER_SANITIZE_STRING);
if ((!empty($first_name)) && (preg_match('/[a-z\s]/i',$first_name)) &&
 (strlen($first_name) <= 30)) {
 //Sanitize the trimmed first name
 $first_nametrim = $first_name;
 }else{
 $errors[] =
 'First name missing or not alphabetic and space characters. Max 30';
 }
 // Check for a last name:
$last_name = filter_var( $_POST['last_name'], FILTER_SANITIZE_STRING);
if ((!empty($first_name)) && (preg_match('/[a-z\s]/i',$last_name)) &&
 (strlen($last_name) <= 30)) {
 //Sanitize the trimmed last name
 $last_nametrim = $last_name;
 }else{
 $errors[] =
 'Last name missing or not alphabetic and space characters. Max 30';
 }
 $gender = trim($_POST['gender']);
 if (empty($gender)) {
 $errors[] = 'Gender field cannot be empty';
 }
 
 // Check for an email address:
 $email = trim($_POST['email']);
 if (empty($email)) {
 $errors[] = 'You forgot to enter your email address.';
 }
// Check for a password and match against the confirmed password: #3
 $password1= trim($_POST['password1']);
 $password2 = trim($_POST['password2']);
 if (!empty($password1)) {
 if ($password1 !== $password2) {
 $errors[] = 'Your two passwords did not match.';
 }
 } else {
 $errors[] = 'You forgot to enter your password.';
 }

$relationship = filter_var( $_POST['relationship'], FILTER_SANITIZE_STRING);
if ((!empty($relationship)) && (preg_match('/[a-z\s]/i',$relationship)) &&
 (strlen($relationship) <= 30)) {
 //Sanitize the trimmed first name
 $relationshiptrim = $relationship;
 }else{
 $errors[] =
 'Relationship missing or not alphabetic and space characters. Max 30';
 }
 $profile_photo = $_FILES['profile_photo']['name'];



if (empty($errors)) { // If everything's OK. #4
try {
 // Register the user in the database...
 // Hash password 
 $hashed_passcode = password_hash($password1, PASSWORD_DEFAULT); //#5
 require ('mysqli_connect.php'); // Connect to the db. //#6
 // Make the query: #
   $query = "INSERT INTO family_members (member_id, first_name, last_name, gender, email, password, relationship, profile_photo, registration_date)";
 $query .="VALUES(' ', ?, ?, ?, ?, ?, ?, ?, NOW())"; //#8
  $dbcon= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $q = mysqli_stmt_init($dbcon); //#9
 mysqli_stmt_prepare($q, $query);
 // use prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
 mysqli_stmt_bind_param($q, 'sssssss',$first_name, $last_name, $gender, $email, $hashed_passcode, $relationship, $profile_photo);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted #10
 header ("location: register_thanks.php");
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
 } else { // Report the errors. 
 $errorstring = "Error! The following error(s) occurred:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " - $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
 echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
 }
?>