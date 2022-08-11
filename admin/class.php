<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ScapeGoat Generator | Class List</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<script src="js/name.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      	<a class="navbar-brand" href="http://scapegoat.block2block.me/">ScapeGoat Generator - Admin</a>
				
    	<ul class="nav navbar-nav">
      		<li class="nav-item"><a class="nav-link" href="/admin">Home</a></li>
      		<li class="nav-item active"><a class="nav-link" href="#">Class List</a></li>
			<li class="nav-item"><a class="nav-link" href="history">ScapeGoat History</a></li>
		</ul>
	</nav>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div> <!-- Gap at left side of form -->
				<div class="col-sm-8 col-xs-12">
					<br>
					<h1><Strong>ScapeGoat Generator Admin Panel - Class List</Strong></h1>
					<br>
					<legend style="font-family: 'Helvetica';">Current ScapeGoat</legend>
					<hr>
					<p style="font-size: 17px; font-family: 'Helvetica'"><?php
					include_once "../generator/functions.php";
					include_once "../generator/db-connect.php";
						
					echo get_current_name($mysqli);
					
					?></p>
					<br>
					<legend style="font-family: 'Helvetica';">Class List</legend>
					<br>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th></th>
  						    </tr>
						</thead>
						<tbody id="table-values">
							<?php
							include_once "../generator/db-connect.php";
							
							if ($sql = $mysqli->prepare("SELECT * FROM class ORDER BY id ASC")) {
								$sql->execute();    // Execute the prepared query.
								
								$id = null;
								$name = null;
                   
								$sql->bind_result($id,$name);
								while ($sql->fetch()) {
									echo "<tr id='", $id, "'><td id='", $id, "-id'>", $id, "</td><td id='", $id, "-name'>", $name, "</td><td><button type'button' class='btn btn-secondary' id='", $id, "-edit' onclick='startEdit(", $id, ")'><i class='fas fa-pencil-alt'></i> Edit Name</button> <button type='button' class='btn btn-danger' id='", $id, "-delete' onclick='deleteName(", $id, ")'><i class='fas fa-trash-alt'></i> Delete</button></td></tr>";
								}
			
							} else {
								echo "ERROR";
							}
							
							?>
  						</tbody>
					</table>
					
					<button type="button" class="btn btn-success" onclick="newclassmate()"><i class="fas fa-user-plus"></i> Add Classmate</button>
					<button type="button" class="btn btn-danger" onclick="resetclass()"><i class="fas fa-ban"></i> Reset Class</button>
					
				</div>
			<div class="col-sm-2"></div> <!-- Gap at right side of form -->
		</div>
	</div>
</body>
</html>
