<!-- this is the login page-->
<!DOCTYPE html>
<html lang="en">
<head>
 <title>Login</title>
 <meta charset="utf-8">
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
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
	 $(document).ready(function(){
    $('#loginform').validate({
    rules:{
    	email:{
    		required: true,
    		email:true
    	},
    	password:{
    		required: true,
    		rangelength:[8,12]
    	},

    	messages:{
    		email:{
    			required:"please input your email",
    			email:"please enter a valid email"
    		},
    		password:{
    			reqired:"Please Enter You Password",
    			rangelength:"Your Password Must Be atleast 8 to 12 Characters"
    		}
    	}
    }
 }); 
  $('#email').focus();
 
  }); // end document ready
</script>

</head>
<body style="background-color:#EEE;">
<div class="container" style="margin-top:30px">

<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<?php include('login_header.php');?>
</header>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //#1
 require('process_login.php');
} // End of the main Submit conditional.
?>
<div class="col-xs-6 col-md-6 col-lg-8 col-xs-offset-3 col-lg-offset-3 col-md-offset-6">
<form action="login_page.php" method="post"  id="loginform">
	<fieldset>
		<legend>Your Credentials:</legend>

 <P><label for="email" class="col-sm-4 col-form-label">Email:</label><br>
 <input type="text" class="form-control" id="email" name="email"
 placeholder="Email" maxlength="30" required
 value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" ></P>
 
 

<p><label for="password" class="col-sm-4 col-form-label">Password:</label><br>
<input type="password" class="form-control" id="password" name="password" 
placeholder="Password" minlength="8" maxlength="40" required
 value=
 "<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"></p>

<div class="col-sm-12">
<input style="text-align:center;"id="submit" class="btn btn-primary" type="submit" name="submit"
 value="Login">
</div>
</fieldset>
 </form>

  <footer class="jumbotron text-center row"
 style="padding-bottom:1px; padding-top:8px;">
<?php include('footer.php'); ?>
 </footer>
</div>
</body>
</html>