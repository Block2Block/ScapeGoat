<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ScapeGoat Generator | History</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
	<script src="js/history.js"></script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
</head>

<body onload="fetchnames()">
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      	<a class="navbar-brand" href="http://scapegoat.block2block.me/">ScapeGoat Generator - Admin</a>
				
    	<ul class="nav navbar-nav">
      		<li class="nav-item"><a class="nav-link" href="/admin">Home</a></li>
      		<li class="nav-item"><a class="nav-link" href="class">Class List</a></li>
			<li class="nav-item active"><a class="nav-link" href="#">ScapeGoat History</a></li>
		</ul>
	</nav>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div> <!-- Gap at left side of form -->
				<div class="col-sm-8 col-xs-12">
					<br>
					<h1><Strong>ScapeGoat Generator Admin Panel - ScapeGoat History</Strong></h1>
					<br>
					<legend style="font-family: 'Helvetica';">Current ScapeGoat</legend>
					<hr>
					<p style="font-size: 17px; font-family: 'Helvetica'"><?php
					include_once "../generator/functions.php";
					include_once "../generator/db-connect.php";
						
					echo get_current_name($mysqli);
					
					?></p>
					<br>
					<legend style="font-family: 'Helvetica';">ScapeGoat History</legend>
					<br>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Date</th>
								<th>Execution Time</th>
								<th>ID</th>
								<th>Name</th>
  						    </tr>
						</thead>
						<tbody id="table-values">
							<?php
							include_once "../generator/db-connect.php";
							include_once "../generator/functions.php";
							
							if ($sql = $mysqli->prepare("SELECT * FROM current_scape_goat ORDER BY timestamp ASC")) {
								$sql->execute();    // Execute the prepared query.
								
								$timestamp = null;
								$id = null;
								$total = 1;
                   
								$sql->bind_result($timestamp,$id);
								while ($sql->fetch()) {
									$dayofweek = date('w', strtotime($timestamp));
									$day = null;
									switch ($dayofweek) {
										case 0:
											$day = "Sunday ";
											break;
										case 1:
											$day = "Monday ";
											break;
										case 2:
											$day = "Tuesday ";
											break;
										case 3:
											$day = "Wednesday ";
											break;
										case 4:
											$day = "Thursday ";
											break;
										case 5:
											$day = "Friday ";
											break;
										case 6:
											$day = "Saturday ";
											break;
									}
									
								
									echo "<tr><td>", $day, date("jS F Y",strtotime($timestamp)), "</td><td>", $timestamp, "</td><td>", $id, "</td><td id='", $total,"' name='", $id, "'></td></tr>";
									$total = $total + 1;
								}
			
							} else {
								echo "ERROR";
							}
							
							?>
  						</tbody>
					</table>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus"></i> Force ScapeGoat</button>
					<button type="button" class="btn btn-danger" onclick="resetHistory()"><i class="fas fa-ban"></i> Clear History</button>
					<br>
					<br>
					<div id="alerts"></div>

					<!-- The Modal -->
					<div class="modal fade" id="myModal">
						<div class="modal-dialog">
							<div class="modal-content">
      
							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Force ScapeGoat</h4>
								<button type="button" class="close" data-dismiss="modal">×</button>
							</div>
        
							<!-- Modal body -->
							<div class="modal-body">
								<div class='alert alert-info fade show'><strong>NOTE!</strong> If there is currently a force ScapeGoat active, this will override the end date of the previous, and force the new one instead!</div>
								<form action="accounts/process-login.php" method="post" name="login_form" style="font-family: 'Helvetica';">
					
									<fieldset style="font-family: 'Helvetica';">
									<p style="font-family: 'Helvetica';">Who would you like to force ScapeGoat?</p>
									<select class="custom-select" name="person" id="person">
										<option value="" selected></option>
										<?php
											if ($stmt = $mysqli->prepare("SELECT `name` FROM `class`")) {
												if ($stmt->execute()) {
													$stmt->store_result();
													$stmt->bind_result($name);
													while ($stmt->fetch()) {
														echo '<option value="' . $name . '">' . $name . '</option>';
													}
												}
											}
										?>
									</select>
									<br>
									<br>
									<p style="font-family: 'Helvetica';">When would you like their ScapeGoat reign to end?</p>
									<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="date" id="date"/>
										<div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<script type="text/javascript">
										$(function () {
											$('#datetimepicker4').datetimepicker({
												format: 'YYYY-MM-D',
												minDate: new Date()
											});
										});
									</script>
									<br>
									<input type="button" value="Force" onclick="force(this.form.person.value, this.form.date.value);" class="btn btn-success" data-dismiss="modal"/> 
								</form>
							</div>
        
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
        
						</div>
					</div>
				</div>
				</div>
			<div class="col-sm-2"></div> <!-- Gap at right side of form -->
		</div>
	</div>
</body>
</html>
