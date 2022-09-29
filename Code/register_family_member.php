<!-- page for registering new member to the database -->
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
	<title>Register_Members</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style type="text/css">
form .error {
  color: #ff0000;

}
input.error, select.error, textarea.error{
	border: 1px red solid;
}

</style> 
<!-- Bootstrap CSS File -->
<link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
 integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
 crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
 <script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
     $('#registermember').validate({
     	rules:{
     		first_name:{
     			required: true
     		},
     		last_name:{
     			required: true
     		},
     		gender:{
     			required: true
     		},
     		email:{
     			required: true,
     			email: true
     		},
     		password1:{
     			required: true,
     			rangelength:[8,12]
     		},
     		password2:{
     			required: true,
     			equalTo:'#password1'
     		},
     		relationship:{
     			required: true
     		},
     		profile_photo:{
     			required: true
     		},

     		messages:{
     			first_name:"Please Enter First Name",
     			last_name:"Please Enter Last Name",
     			gender:"please Select Gender",
     			email:{
                required:"Please Enter Your Email",
                email: "Please Enter a valid email address"
     			},
     			password1:{
     				required: "Enter Password",
     				rangelength:"Password Must Be atleast 8 to 12 characters."
     			},
     			password2:{
     				required: "This field cannot be empty!",
     				equalTo: "Ooops The two passwords Don't match."
     			},
     			relationship:"Please enter this field"

     		}//end messages


            

     	}//end rules

     });//end validate
     $('#first_name').focus();
 	})//end ready
 </script>
</head>

	<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require('process_register_family_member.php');
}
?> 
<body style="background-color:#EEE";>

	<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>

 <div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">Membership Registration Page</h1>
          </div>
      </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'register_family_member.php'" >Clear Choice</button>
</div>
 </nav>
</header>
	<div class="container">
		<div class="row">
			<div class="col-xm-6 col-lg-8 col-lg-offset-2">
				 <h2>Register New Member</h2>
  <form action="register_family_member.php" method="post" id="registermember" name="registermember"enctype= "multipart/form-data" onsubmit="return checked()";>

<p><label for="first_name">First Name:</label><br>
<input type="text" class="form-control" id="first_name" name="first_name" placeholder="first Name" maxlength="30" required value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>" >
</p>



<p><label for="last_name">Last Name:</label><br>
<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" maxlength="40" required value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>" >
</p>

<p><label for="email">Gender:</label><br>
<select name="gender" placeholder="Gender" required id="gender" value="<?php if(isset($_POST['gender'])) echo $_POST['gender'];?>" >
	<option value="male">Male</option>
	<option value="female">Female</option>
</select>
</p>




<p><label for="email">Email:</label><br>
<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="60" required value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" >
</p>


<p><label for="password1">Password:</label><br>
<input type="password" class="form-control" id="password1" name="password1"
 
 placeholder="Password" minlength="8" maxlength="12" required
 value=
 "<?php if (isset($_POST['password1']))
 echo htmlspecialchars($_POST['password1'], ENT_QUOTES); ?>" >


<label for="password2" >Confirm Password:</label>
<input type="password" class="form-control" id="password2" name="password2" placeholder="confirm password" minlength="8" maxlength="12" required value="<?php if(isset($_POST['password2'])) echo $_POST['password2'];?>"></p>
<p><label for="relationship">Relationship:</label><br>
<input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship" maxlength="15" required value="<?php if(isset($_POST['relationship'])) echo $_POST['relationship'];?>" > 
</p>
<div id="upload">
<input type="hidden" name="size" value="1000000">
<div>
<p><label for="profile_photo">Profile:</label><br>
<input type="file" class="form-control" id="profile_photo" name="profile_photo"  value="<?php if(isset($_POST['profile_photo'])) echo $_POST['profile_photo'];?>"></p> 


</div>
</div>
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