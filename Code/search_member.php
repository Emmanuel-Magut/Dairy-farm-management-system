<!-- page for searching member-->
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
	<title>Search Member</title>
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
 		$('#searchmember').validate({

 		rules:{
 			first_name:{
 				required:true
 			},
 			last_name:{
 				required:true
 			}
 		}

 		})// end validate

 	});// end ready
 </script>
</head>
<body style="background-color:#EEE";>

	<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<div class="col-sm-2">
<img class="img-fluid float-left" src="dev_images/d20.png" alt="Logo">
</div>

 <div class="mask">
      <div class="d-flex justify-content-center align-items-center h-100">
        
      </div>
    </div>
    <nav class="col-sm-2 col-xs-2 col-xs-offset-9 col-md-offset-9">
 <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button Group">
 <button type="button" class="btn btn-secondary"
 onclick="location.href = 'search_member.php'" >Clear Choice</button>
</div>
 </nav>
</header>




	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-md-6 col-lg-8">

			<h2 class="h2 text-center">Search Member:</h2>
<h6 class="text-center">Both names are required:</h6>
<form action="process_search_member.php" method="post" id="searchmember" name="searchmember">

 <p><label for="first_name">First Name:</label><br>
 <input type="text" class="form-control" id="first_name" name="first_name"
 placeholder="First Name" maxlength="30" required
 value=
 "<?php if (isset($_POST['first_name']))
echo htmlspecialchars($_POST['first_name'], ENT_QUOTES); ?>" >
 </p>

 <p><label for="last_name">Last Name:</label><br>
 <input type="text" class="form-control" id="last_name" name="last_name"
 placeholder="Last Name" maxlength="40" required
 value=
 "<?php if (isset($_POST['last_name']))
 echo htmlspecialchars($_POST['last_name'], ENT_QUOTES); ?>">
 </p>
 

<p><div class="col-sm-8">
 <input id="submit" class="btn btn-primary" type="submit"
 name="submit" value="Search"></div>
</div>
</form>
			</div>
		</div> <!-- end row div -->
	</div> <!-- end container div-->
</body>
</html>