<!-- This is the landing page that directs users to login page-->
<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<style type="text/css">
	
	</style>
	<link style type="text/css" rel="stylesheet" href="bootstrap.css">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQueryUI -->
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- form validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script src="https://cdn.jquery.anythingslider.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
 
 $(document).ready(function(){
$('#blur').hide();
$('#blur').fadeIn(2000);
$('#blur').fadeOut(5000);
});
</script>
</head>
<body style="background-color:#EEE;">
<div class="container">
	<div class="row">
<div class="col-xs-6 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
<header class="jumbotron text-center row" style="margin-bottom: 2px; position:absolute; top:100px; background:linear-gradient(white, wheat); padding: 20px;">
<?php include('index_header.php');?>
</header>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
<div id="blur">
		<div class="alert alert-info">
			Welcome To Our Website.Please Login To Continue.
		</div>
	</div>
</div> <!-- end row div -->
 
 </div>
 </div>
</div>
 

</div> <!-- end container div -->
	</body>
	</html>