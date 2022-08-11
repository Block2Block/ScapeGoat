<?php
    
    include_once 'db-connect.php';
    
    function get_current_name($mysqli) {
        if ($sql = $mysqli->prepare("SELECT id FROM current_scape_goat ORDER BY timestamp DESC LIMIT 1")) {
           $sql->execute();    // Execute the prepared query.
           $sql->store_result();
                                    
           // get variables from result.
           $sql->bind_result($id);
           $sql->fetch();
           if ($sql->num_rows == 1) {
               if ($sql2 = $mysqli->prepare("SELECT name FROM class WHERE id = ? LIMIT 1")) {
                   $sql2->bind_param('i', $id);  // Binds the email to the parameter.
                   $sql2->execute();    // Execute the prepared query.
                   $sql2->store_result();
                   
                   // get variables from result.
                   $sql2->bind_result($name);
                   $sql2->fetch();
                   
                   if ($sql2->num_rows == 1) {
                       return $name;
                   } else {
                       return "Uh oh, something went wrong!";
                   }
               } else {
                   return "Uh oh, something went wrong!";
               }
           } else {
               return "There are currently no generated ScapeGoats.";
           }
                                    
        } else {
            return "Uh oh, something went wrong!";
        }
    }
    
    function name_total($mysqli) {
        if ($sql = $mysqli->prepare("SELECT * FROM class")) {
			$sql->execute();    // Execute the prepared query.
            $sql->store_result();
                                    
            // get variables from result.
            $sql->bind_result($results, $results2);
            $sql->fetch();
		    return $sql->num_rows;
		} else {
            return -1;
        }
    }
    
    function get_name($mysqli, $id) {
        if ($sql = $mysqli->prepare("SELECT name FROM class WHERE id = ? LIMIT 1")) {
			$sql->bind_param('i', $id);  // Binds the email to the parameter.
            $sql->execute();    // Execute the prepared query.
            $sql->store_result();
                   
            $sql->bind_result($name);
            $sql->fetch();
			
			if ($sql->num_rows == 1) {
                return $name;
            } else {
                return "ERROR 2";
            }
		} else {
			return "ERROR 1";
		}
    }
    
    function update_sg($mysqli, $id) {
        if ($sql = $mysqli->prepare("INSERT INTO current_scape_goat(id) VALUES (?)")) {
			$sql->bind_param('i', $id);  // Binds the email to the parameter.
            $sql->execute();    // Execute the prepared query.
		}
    }
	
	if (isset($_POST['editname'],$_POST['editid'])) {
		$id = filter_input(INPUT_POST, 'editid', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'editname', FILTER_SANITIZE_STRING);
		
		if ($sql = $mysqli->prepare("UPDATE class SET name = ? WHERE id = ? LIMIT 1")) {
			$sql->bind_param('si', $name, $id);  // Binds the email to the parameter.
            $sql->execute();    // Execute the prepared query.
		} else {
			return "ERROR";
		}
		
		return true;
	}
	
	if (isset($_POST['deleteid'])) {
		$id = filter_input(INPUT_POST, 'deleteid', FILTER_SANITIZE_NUMBER_INT);
		
		if ($sql = $mysqli->prepare("DELETE FROM class WHERE id = ?")) {
			$sql->bind_param('i', $id);  // Binds the email to the parameter.
            $sql->execute();    // Execute the prepared query.
		} else {
			return "ERROR";
		}
		
		return true;
	}
	
	if (isset($_POST['newname'])) {
		$name = filter_input(INPUT_POST, 'newname', FILTER_SANITIZE_STRING);
		if ($sql = $mysqli->prepare("INSERT INTO class(name) VALUES (?)")) {
			$sql->bind_param('s', $name);  // Binds the email to the parameter.
            $sql->execute();    // Execute the prepared query.
			
			if ($sql = $mysqli->prepare("SELECT id FROM class ORDER BY id DESC LIMIT 1")) {
				$sql->execute();    // Execute the prepared query.
				$sql->store_result();
                                    
				// get variables from result.
				$sql->bind_result($id);
				$sql->fetch();
				
				echo $id;
			}
		}
	}
	
	if(isset($_POST['reset'])) {
		if ($sql = $mysqli->prepare("ALTER TABLE scape_goat.current_scape_goat DROP FOREIGN KEY id")) {
            $sql->execute();    // Execute the prepared query.
			if ($sql = $mysqli->prepare("TRUNCATE TABLE current_scape_goat")) {
				$sql->execute();    // Execute the prepared query.
				if ($sql = $mysqli->prepare("TRUNCATE TABLE class")) {
					$sql->execute();    // Execute the prepared query.
					if ($sql = $mysqli->prepare("ALTER TABLE `current_scape_goat` ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `class`(`id`) ON DELETE CASCADE ON UPDATE CASCADE")) {
						$sql->execute();    // Execute the prepared query.
						echo "Success!";
					} else {
						echo "Something went wrong!";
					}
				
				} else {
					echo "Something went wrong!";
				}
			} else {
				echo "Something went wrong!";
			}
		} else {
			echo "Something went wrong!";
		}
		
	}
	
	if (isset($_POST['getname'])) {
		$id = filter_input(INPUT_POST, 'getname', FILTER_SANITIZE_NUMBER_INT);
		$element = filter_input(INPUT_POST, 'element', FILTER_SANITIZE_NUMBER_INT);
		echo $element;
		echo " ";
		echo get_name($mysqli, $id);
	}
	
	if (isset($_POST['getcurrent'])) {
		echo get_current_name($mysqli);
	}
    
    if (isset($_POST['forcename'], $_POST['forcedate'])) {
        $name = filter_input(INPUT_POST, 'forcename', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, 'forcedate', FILTER_SANITIZE_STRING);
        
        if ($sql = $mysqli->prepare("SELECT id FROM class WHERE name = ?")) {
            mysqli_report(MYSQLI_REPORT_ALL);
            $sql->bind_param('s', $name);
            $sql->execute();    // Execute the prepared query.
            $sql->store_result();
            
            // get variables from result.
            $sql->bind_result($id);
            $sql->fetch();
            
            if ($sql->num_rows == 1) {
             if ($sql = $mysqli->prepare("INSERT INTO forcesg(enddate,id) VALUES (?,?)")) {
                 $sql->bind_param("si",$date,$id);
                 $sql->execute();
             } else {
                 echo "Something went wrong!";
             }
            } else {
                $rows = $sql->num_rows;
                echo "Something went wrong!";
                echo $rows;
            }
        } else {
            echo "Something went wrong!";
        }
    }
    
    if(isset($_POST['resethistory'])) {
        if ($sql = $mysqli->prepare("TRUNCATE TABLE current_scape_goat")) {
            $sql->execute();
        }
    }
