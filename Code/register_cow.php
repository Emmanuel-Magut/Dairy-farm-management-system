<!-- page for registering new cow-->
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
	<title>Register Cow</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style type="text/css">
	form .error {
  color: #ff0000;
}
input.error, select.error, textarea.error{
	border: 1px red solid;
}
	</style>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQueryUI -->
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<!-- easing-->
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<!-- anythingSlider -->
<script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
 		$('#registercow').validate({
 			rules:{
             serial_no_name:{
             	required: true
             } ,
             gender:{
             	required:true
             },
             breed_type:{
             	required: true
             },
             year_of_birth:{
             	required:true
             } ,
             cow_photo:{
             	required: true
             }
 			}// end rules
 }); //end validate
 		});// end ready
 		</script>
	</head>
<body style="background-color:#EEE";>
	<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require('process_register_cow.php');
}
?>
<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>
<div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
      	<div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h2 class="mb-3">Dairy_Cow Registration Page</h1>
          </div>
      </div>
    </div>
        
      </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'register_cow.php'" >Clear Choice</button>
</div>
 </nav>
</header>
	<div class="container">
		<div class="row">
			<div class="col-xm-6 col-lg-8 col-lg-offset-2">
				 <h2>Register New Cow/Calf</h2>
  <form action="register_cow.php" method="post"enctype="multipart/form-data" id="registercow" name="registercow" onsubmit="return checked()";>

<p><label for="serial_no_name">Serial_No/Name:</label><br>
<input type="text" class="form-control" id="serial_no_name" name="serial_no_name" placeholder="Serial_No/Name" maxlength="30" required value="<?php if(isset($_POST['serial_no_name'])) echo $_POST['serial_no_name'];?>" >
</p>
<p><label for="gender">Gender:</label><br>
<select name="gender" placeholder="Gender" required id="gender" value="<?php if(isset($_POST['gender'])) echo $_POST['gender'];?>" >
	<option value="male">Male</option>
	<option value="female">Female</option>
</select>
</p>

<p><label for="breed_type">Breed/Type:</label><br>
<input type="text" class="form-control" id="breed_type" name="breed_type" placeholder="Breed" maxlength="60" required value="<?php if(isset($_POST['breed_type'])) echo $_POST['breed_type'];?>" >
</p>

<p><label for="year_of_birth">Birth  Year:</label><br>
<input type="text" class="form-control" id="year_of_birth" name="year_of_birth" placeholder="Birth Year" maxlength="15" required value="<?php if(isset($_POST['year_of_birth'])) echo $_POST['year_of_birth'];?>" > 
</p>

<p><label for="cow_photo">Photo:</label><br>
<input type="file" class="form-control" id="cow_photo" name= "cow_photo" placeholder="cow_Photo"   value="<?php if(isset($_POST['cow_photo'])) echo $_POST['cow_photo'];?>"> </p>


<div class="col-sm-8">
<div class="form-group row">
 <label for="" class="col-sm-4 col-form-label"></label>
<div class="col-sm-8 text-center">
 <input id="submit" class="btn btn-primary" type="submit"
 name="submit" value="Register">
</div>
</div>
</form>
    </div>
	</div><!-- end row -->
  <footer class="jumbotron text-center row"
 style="padding-bottom:1px; padding-top:8px;">
<?php include('footer.php'); ?>
 </footer>
	</div> <!-- end container -->
</body>
</html>