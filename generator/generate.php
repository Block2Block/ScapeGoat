<?php
    include_once "db-connect.php";
    include_once "functions.php";
    
	$total = name_total($mysqli);
	$sc_id = mt_rand(1, $total);
	
    
    
	update_sg($mysqli, $sc_id);
	
	echo "success";
