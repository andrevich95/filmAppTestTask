<!DOCTYPE html>
<html>
<head>
	<title>FilmApp</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<script src='assets/js/main.js' type="text/javascript"></script>
	<script src='assets/js/modules.js' type="text/javascript"></script>
</head>
<body>
	<nav class="navbar navbar-reverse">
		<div class="container-fluid">
		    	<div class="navbar-header">
		    		<a class="navbar-brand" href="#">FilmApp</a>
		   		</div>
		    	<ul class="nav navbar-nav">
		      		<li><a href="main">Films</a></li>
		      		<li><a href="add">Actors</a></li>
		      	</ul>
	</nav>
	<div class="container" id="main_body">
	<?php include 'app/views/'.$content_view; ?>
	</div>
	<footer class="footer">
		 <p class="text-center"><?php date_default_timezone_set('UTC'); echo date('Y');?> &copy; Andrey Yaroshevskyy</p>
	</footer>
</body>	
</html>