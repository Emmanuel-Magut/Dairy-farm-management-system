<!-- This is the page for changing password -->
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
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

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- jQuery -->
 <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- jQueryUI -->
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<!-- easing-->
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<!-- animate -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<!-- anythingSlider -->
 <script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
   $('#changepassword').validate({
     rules:{
     	email:{
     		required: true,
     		email:true
     	},

     	password:{
     		required: true,
     		rangelength:[8,12]
     	},

     	password1:{
     		required: true,
     		rangelength: [8,12]
     	},
     	password2:{
     		required: true,
     		equalTo: '#password1'
     	},
     	messages:{
     		email:{
     			required: "Please Enter Your Email.",
     			email: "Please Enter a Valid Email Address."
     		},
     		password:{
                required: "Please Enter Your Current Password",
                rangelength: "Your Current Password Must Be atleast 8 to 12 characters"
     		},
     		password1:{
     			required: "Please Enter Your New Password",
     			rangelength: "Your New Password Must Be atleast 8 to 12 characters"
     		},
     		password2:{
     			required: "This field cannot be empty!",
     			equalTo: "Oops! The two passwords Don't match."
     		}
     	} // end messages


     }// end rules


   });// end validate

});
</script>
</head>
<body style="background-color:#EEE";>

	<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>

 <div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">Change Password Page</h1>
          </div>
      </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'change_password.php'" >Clear Choice</button>
</div>
 </nav>
</header>

	
	<div class="container">
  <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 require('process_change_password.php'); 
 }
 ?>


		<div class="row">
			<div class="col-sm-4 col-md-6 col-lg-8 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">

				<h2 class="h2 text-center">Change Password</h2>
<form action="change_password.php" method="post" name="changepassword"
 id="changepassword" onsubmit="return checked();">
 <p><label for="email">E-mail:</label> <br>
 <input type="email" class="form-control" id="email" name="email"
 placeholder="E-mail" maxlength="60" required
 value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
</p>



 <p><label for="password">Current Password:</label><br>
 <input type="password" class="form-control" id="password" name="password"
 placeholder="Password" minlength="8" maxlength="12"
 required value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
</p>



 <p><label for="password1">New Password:</label><br>
 <input type="password" class="form-control" id="password1" name="password1"
 placeholder="Password" minlength="8" maxlength="12"
 required value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>">
 


 <p><label for="password2">Confirm Password:</label><br>
 <input type="password" class="form-control" id="password2" name="password2"
 placeholder="Confirm Password" minlength="8" maxlength="12" required
 value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>">
</p>
 <p>
<div class="form-group row">
 <div class="col-sm-12">
 <input id="submit" class="btn btn-primary" type="submit" name="submit"
 value="Change Password">
 </div>
</div></p>
</form>
			</div>
		</div> <!-- end row div -->
	</div> <!-- end container div -->
</body>
</html>