<!-- page for registering insemination to the database-->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1) AND ($_SESSION['user_level'] !=2)) 
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Insemination</title>
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
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
 <script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#regins').validate({

 		rules:{
 			
 			cow_id:{
 				required:true,
 				number: true
 			},
 			insemination_summary:{
 				required: true
 			}
 			
 		}

 		});// end validate

 	});// end ready
 </script>
</head>
<body style="background-color:#EEE;">
	<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require('process_register_insemination.php');
}
?>
<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>

 <div class="mask">
     <div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">Insemination Registration Page</h1>
          </div>
      </div>
    </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'register_insemination.php'" >Clear Choice</button>
</div>
 </nav>
</header>
	<div class="container">
		<div class="row">
			<div class="col-xm-6 col-lg-8 col-lg-offset-2">
				 <h2>Register Insemination</h2>
				 <h6> View registered Cows To Confirm Cow Id.</h6>
				 <h6>Don't Use Serial_No/Name To Register</h6>
  <form action="register_insemination.php" method="post" enctype="multipart/form-data" name="regins" id="regins" onsubmit="return checked()";>

<p><label for="cow_id">Cow Id:</label><br>
<input type="text" class="form-control" id="cow_id" name="cow_id"  maxlength="30" required value="<?php if(isset($_POST['cow_id'])) echo $_POST['cow_id'];?>" >
</p>
<p><label for="insemination_summary">Insemination Summary:</label><br>
<textarea name="insemination_summary" id="insemination_summary" class="form-control" placehplder="Say Something About Insemination" required value="<?php if(isset($_POST['insemination_summary'])) echo $_POST['insemination_summary'];?>"></textarea>
</p>
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
