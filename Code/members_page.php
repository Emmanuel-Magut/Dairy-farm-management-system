<!-- this is the registered members page with user leve 0. They can only view the farm profile -->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{ 
header("Location: login_page.php");
 exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>Members Page</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style type="text/css">
 	.fa {
  padding: 20px;
  font-size: 20px;
  width: 25px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}

.fa-linkedin {
  background: #007bb5;
  color: white;
}

.fa-youtube {
  background: #bb0000;
  color: white;
}

.fa-instagram {
  background: #125688;
  color: white;
}

.fa-pinterest {
  background: #cb2027;
  color: white;
}

.fa-snapchat-ghost {
  background: #fffc00;
  color: white;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

.fa-skype {
  background: #00aff0;
  color: white;
}

.fa-android {
  background: #a4c639;
  color: white;
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
 <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="https://cdn.jquery.anythingslider.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script>
	 $(document).ready(function(){
    });
</script>
</head>
<body style="background-color:#EEE;">
<header class="jumbotron text-center row" style="margin-bottom: 2px; background:linear-gradient(white, blue); padding: 20px;">
<?php include('members_header.php');?>
</header>
<div class="container">
<div class="row">
<div class="col-xs-6 col-md-12 col-lg-12">
<nav id="navbarExample" class="navbar navbar-default" role="navigation">
 <div class="container-fluid">
 <div class="navbar-header">
 <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbarLinks">
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 </button>
 <a class="navbar-brand" href="#">Menu</a>
 </div>
 <div class="collapse navbar-collapse navbarLinks">
 <ul class="nav navbar-nav">
 <li><a href="#home">Home</a></li>
 <li><a href="#profile">Profile</a></li>
 <li><a href="change_password.php">Change Password</a></li>
 <li><a href="about_dev.php">About Developer</li>
<li><a href="#contact">Contact Us</a></li>
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
 </div>
  </li>
 </ul>

 </div>
 </div>
</nav>
</div>
</div>
<!-- carousel-->
		<div class="row">
			<div class="col-sm-12 king">
		<div id="bestCarsCarousel" class="carousel slide" data-ride="carousel">
 <!-- Indicators -->
 <ol class="carousel-indicators">
 <li data-target="#bestCarsCarousel" data-slide-to="0" class="active"></li>
 <li data-target="#bestCarsCarousel" data-slide-to="1"></li>
 <li data-target="#bestCarsCarousel" data-slide-to="2"></li>
 <li data-target="#bestCarsCarousel" data-slide-to="3"></li>
 </ol>
 
 <!-- Wrapper for slides -->
 <div class="carousel-inner">
 <div class="item active">
 <img class="img-responsive img-fluid img-rounded" src="dev_images/d77.jpeg" width=1000 height=300>
 <div class="carousel-caption">
 <h3>Dairy Farm</h3>
 </div>
 </div>
 <div class="item">
 <img class="img-responsive img-fluid img-rounded" src="dev_images/d7.jpg" width=1000 height=300>
 <div class="carousel-caption">
 <h3>American Species</h3>
 </div>
 </div>
 <div class="item">
 <img class="img-responsive img-fluid img-rounded"src="dev_images/d63.jpg" width=1000 height=300>
 <div class="carousel-caption" >
 <h3>Poultry Farm</h3>
 </div>
 </div>
<div class="item">
 <img class="img-responsive img-fluid img-rounded"src="dev_images/d12.jfif" width=1000 height=300>
 <div class="carousel-caption" >
 <h3>Quality Products</h3>
 </div>
 </div>

 </div>
 <!-- Controls -->
 <a class="left carousel-control" href="#bestCarsCarousel" data-slide="prev">
 <span class="glyphicon glyphicon-chevron-left"></span>
 </a>
 <a class="right carousel-control" href="#bestCarsCarousel" data-slide="next">
 <span class="glyphicon glyphicon-chevron-right"></span>
 </a>
</div>
</div>
</div>
<div class="row">
	<div class="col-xs-6 col-md-6 col-lg-3">
		<div class="well">
			<img src="dev_images/d91.jpg" class="img-fluid img-rounded" height="400" width="300" alt="welcome"/>
			<p>We are so glad you could find our website. We welcome you once again to limooefarm. Visit our farm and get to know more about us and get the best training on dairy farming.
				<p><a href="#" class="btn btn-primary disabled">Read More</a></p>
		</div>
	</div>
	<div class="col-xs-6 col-md-6 col-lg-3">
		<div class="well">
			<img src="dev_images/d44.jfif" class="img-fluid img-rounded" height="400" width="300" alt="welcome"/>
			<p>This is our poultry farm.<br>  We do sell chicks and eggs direct from our farm. We have both broiler and layer variety, get in  touch with  us and we deliver to you the best products of choice.
				<p><a href="#" class="btn btn-primary disabled">Read More</a></p>
		</div>
	</div>
	<div class="col-xs-6 col-md-6 col-lg-3">
		<div class="well">
			<img src="dev_images/d67.jpeg" class="img-fluid img-rounded" height="200" width="200" alt="welcome"/>
			<p> This is our dairy farm. <br>
				We have a total of over 50 heads of cattle.
			<p><a href="#" class="btn btn-primary disabled">Read More</a></p>
		</div>
	</div>
	<div class="col-xs-6 col-md-6 col-lg-3">
		<div class="well">
			<img src="dev_images/d61.jfif" class="img-fluid img-rounded" height="200" width="200" alt="welcome"/>
			<p>Dairy Goats.<br>
			This is our dairy goats farm. We supplement our dairy milk products with dairy Goats products and our clients are happy and growing healthier</p>
			<p><a href="#" class="btn btn-primary disabled">Read More</a></p>
		</div>
	</div>
	</div> <!-- end row div -->

</div>

<div class="jumbotron jumbotron-fluid" style="background-image:url(dev_images/d90.jpg); height:400px;">
	<div class="col-sm-6 col-md-6 col-lg-6">
		<h2 style="color:white">About Us</h2>
		<p style="color:black;">We are limooefarm.<br>
			This is a dairy farm that produces and <br>
			sells dairy products.
		</p>
	</div>
	
	<div class="col-sm-6 col-md-3 col-lg-3">
	<h2 style="color:white">Contact Us</h2>	
<p><a href="#facebook" class="fa fa-facebook"></a>
<a href="#facebook" class="fa fa-twitter"></a>
<a href="#facebook" class="fa fa-linkedin"></a>
<a href="#facebook" class="fa fa-youtube"></a>
<a href="#facebook" class="fa fa-instagram"></a>

	
		</p>
	</div>
	
	<!-- footer -->
<footer style="text-align:center;">
 <h5 class="h6 col-sm-12" style="color:black;">&copy;All Rights Reserved. limooefarm 2022. Designed by
<a href="mailto:ekiplimo38@gmail.com">eMagut</a></h5>
 </footer>

</div>

</body>
</html>