<!-- page that processes new cow being added to the database -->
<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["cow_photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["cow_photo"]["tmp_name"]);
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
if ($_FILES["cow_photo"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["cow_photo"]["tmp_name"], $target_file)) {
    print "The file ". htmlspecialchars( basename( $_FILES["cow_photo"]["name"])). " has been uploaded.";
  } else {
    print "Sorry, there was an error uploading your file.";
  } 
}


$errors = array(); // Initialize an error array. #1
 
$serial_no_name = filter_var( $_POST['serial_no_name'], FILTER_SANITIZE_STRING);
$gender= filter_var( $_POST['gender'], FILTER_SANITIZE_STRING);
$breed_type = filter_var( $_POST['breed_type'], FILTER_SANITIZE_STRING);
$year_of_birth = filter_var( $_POST['year_of_birth'], FILTER_SANITIZE_STRING);
$cow_photo = $_FILES['cow_photo']['name'];
if (empty($errors)) { // If everything's OK. 
try {
require ('mysqli_connect.php'); // Connect to the db. //#6
 // Make the query: #
  $query = "INSERT INTO cows (cow_id, serial_no_name, gender, breed_type, year_of_birth, cow_photo, registration_date)";
 $query .="VALUES(' ', ?, ?, ?, ?, ?, NOW())"; //#8
  $dbcon= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $q = mysqli_stmt_init($dbcon); //#9
 mysqli_stmt_prepare($q, $query);
 // prepared statement to ensure that only text is inserted
 // bind fields to SQL Statement
 mysqli_stmt_bind_param($q, 'sssss', $serial_no_name, $gender, $breed_type, $year_of_birth, $cow_photo);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted #10
 header ("location: cow_thanks.php");
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
 // Debugging message below do not use in production
 echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
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
 } else {
 $errorstring = "Error! The following error(s) occurred:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " - $msg<br>\n";
 }
 $errorstring .= "Please try again.<br>";
 echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
 }
?>