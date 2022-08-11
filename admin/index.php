<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ScapeGoat Generator | Admin</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      	<a class="navbar-brand" href="http://scapegoat.block2block.me/">ScapeGoat Generator - Admin</a>
				
    	<ul class="nav navbar-nav">
      		<li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
      		<li class="nav-item"><a class="nav-link" href="class">Class List</a></li>
			<li class="nav-item"><a class="nav-link" href="history">ScapeGoat History</a></li>
		</ul>
	</nav>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div> <!-- Gap at left side of form -->
				<div class="col-sm-8 col-xs-12">
					<br>
					<h1><Strong>ScapeGoat Generator Admin Panel</Strong></h1>
					<br>
					<legend style="font-family: 'Helvetica';">Current ScapeGoat</legend>
					<hr>
					<p style="font-size: 17px; font-family: 'Helvetica'"><?php
					include_once "../generator/functions.php";
					include_once "../generator/db-connect.php";
						
					echo get_current_name($mysqli);
					
					?></p>
				</div>
			<div class="col-sm-2"></div> <!-- Gap at right side of form -->
		</div>
	</div>
</body>
</html>