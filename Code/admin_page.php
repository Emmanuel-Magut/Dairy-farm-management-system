<!-- this is the farm admin page with user level 0-->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>Admin Page</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
 <script>
	 $(document).ready(function(){
       
   $('#success').hide();
   $('#success').fadeIn(1000);
   $('#success').fadeOut(5000);

     
 
   
  });

	</script>

</head>
<body style="background-color:#EEE;">

<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<?php include('admin_header.php');?>
</header>
<div class="container">
	<div id="success">
<div class="alert alert-info text-center">
 <p>Welcome Admin.</p>
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
 
 <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Membership</a>
 <ul class="dropdown-menu">
 	<li><a href="view_family_members.php">View Registered Members</a></li>
 	<li><a href="register_family_member.php">Register New Member</a></li>
 	<li><a href="search_member.php">Search Member</a></li>
 </ul>
 
 </li>
 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dairy Farm</a>
 <ul class="dropdown-menu">
 	<li><a href="view_registered_cows.php">View Registered Cows</a></li>
 	<li><a href="register_cow.php">Register New Cow</a></li>
 	<li><a href="search_cow.php">Search Cow</a></li>
 </ul>
 </li>
 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Vaccination</a>
 <ul class="dropdown-menu">
 	<li><a href="view_vaccination.php">View Vaccination</a></li>
 	<li><a href="register_vaccination.php">Register Vaccination</a></li>
 </ul>
</li>

<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Insemination</a>
 <ul class="dropdown-menu">
 	<li><a href="view_insemination.php">View Insemination</a></li>
 	<li><a href="register_insemination.php">Register Insemination</a></li>
 </ul>
</li>

 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Milk Production</a>
 <ul class="dropdown-menu">
 	<li><a href="view_production.php">View Daily Production</a></li>
 	<li><a href="register_production.php">Register Production</a></li>
 </ul>
</li>
  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Notes</a>
 <ul class="dropdown-menu">
 	<li><a href="view_notes.php">View Notes</a></li>
 	<li><a href="add_notes.php">Add New Note</a></li>
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
 </div>
</body>
</html>