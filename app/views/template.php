<!DOCTYPE html>
<html>
<head>
	<title>FilmApp</title>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href=<?php echo '"'.URL.'assets/css/style.css"';?>/>
	<script src=<?php echo '"'.URL.'assets/js/main.js"';?> type="text/javascript"></script>
	<script src=<?php echo '"'.URL.'assets/js/modules.js"';?> type="text/javascript"></script>
</head>
<body>
	<nav class="navbar navbar-reverse">
		<div class="container-fluid">
		    	<div class="navbar-header">
		    		<a class="navbar-brand" href="#">FilmApp</a>
		   		</div>
		    	<ul class="nav navbar-nav">
		      		<li><a href=<?php echo '"'.URL.'main"';?>>Films</a></li>
		      		<li><a href=<?php echo '"'.URL.'film/add"';?>>Add new film</a></li>
		      		<li><a href=<?php echo '"'.URL.'film/load"';?>>Upload file</a></li>
		      		<li><a href=<?php echo '"'.URL.'main/actors"';?>>Actors</a></li>
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