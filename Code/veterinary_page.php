<!-- this is the page where veterinary can register vaccination and insemination-->
<?php
session_start(); 
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>Veterinary Page</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS File -->
 <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
 integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
 crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQueryUI -->
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<!-- anythingSlider -->
 <script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script>
	 $(document).ready(function(){
      $('#doc').hide();
      $('#doc').fadeIn(1000);
      $('#doc').fadeOut(5000);
  });

	</script>

</head>
<body style="background-color:#EEE;">

<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<?php include('veterinary_header.php');?>
</header>

<div class="container">
	<div id="doc">
		<div class="alert alert-info text-center">
			<p>Welcome Daktari</p>
		</div>
	</div>
<div class="navbar navbar-default">
 <div class="navbar-header">
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar-content">
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 </button>
 <a class="navbar-brand" href="#">Menu</a>
 </div>

 <div class="collapse navbar-collapse" id="mynavbar-content">
 <ul class="nav navbar-nav">
 <li class="active"><a href="#">Home</a></li>
 
 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dairy Farm</a>
 <ul class="dropdown-menu">
 	<li><a href="view_registered_cows.php">Registered Cows</a></li>
 	<li><a href="search_cow.php">Search Cow</a></li>
 </ul>
 </li>
 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Vaccination</a>
 <ul class="dropdown-menu">
 	<li><a href="view_vaccination.php">Vaccinated Cows</a></li>
 	<li><a href="register_vaccination.php">Register Vaccination</a></li>
 </ul>
</li>

<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Insemination</a>
 <ul class="dropdown-menu">
 	<li><a href="view_insemination.php">View Insemination</a></li>
 	<li><a href="register_insemination.php">Register Insemination</a></li>
 </ul>
</li>

 <li><a href="change_password.php">Change Password</a></li> 
 <li>
  <div class="btn-group-vertical btn-group-sm" role="group"
 aria-label="Button Group">
 <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-out"></span> Log out</a></button>
 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
 <div class="modal-content">
 <div class="modal-header">
 <h4 class="modal-title" id="myModalLabel">Logout</h4>
 </div>
 <div class="modal-body">
 You are about to log out from the system. Do you want to proceed?
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-primary"
 data-dismiss="modal">Cancel</button>
 <button type="button" class="btn btn-primary" onclick="location.href = 'logout.php'"  >Logout</button>
 </div>
 </div>
 </div>
 </div></li> 
 </ul>
 </div>
 
  </div>
  <footer class="jumbotron text-center row"
 style="padding-bottom:1px; padding-top:8px;">
<?php include('footer.php'); ?>
 </footer>
 </div>
</body>
</html>