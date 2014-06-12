<?php
	$response= array();
	$resposne['hometowns'] = array();
	$resposne['schools'] = array();
	$resposne['majors'] = array();
	$post = array();
	
	//check connection
	$mysqli = new mysqli("localhost", "root", "pcco", "mydb");
	//force using utf-8 charset
	mysqli_set_charset ( $mysqli,'utf8');
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}		
	//prepare statement for HOMETOWN
	$stmt1 = mysqli_prepare($mysqli, "SELECT HOMETOWN FROM HOMETOWN");
	//execute prepared statement 
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_bind_result($stmt1, $name);
	//printf("Errormessage: %s\n", $mysqli->error);
	
	while (mysqli_stmt_fetch($stmt1)) {
		$post['name'] = $name;
		array_push($resposne['hometowns'], $post);
    }
	
	//prepare statement for MAJORS
	$stmt1 = mysqli_prepare($mysqli, "SELECT MAJOR FROM MAJOR");
	//execute prepared statement 
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_bind_result($stmt1, $name);
	//printf("Errormessage: %s\n", $mysqli->error);
	
	while (mysqli_stmt_fetch($stmt1)) {
		$post['name'] = $name;
		array_push($resposne['majors'], $post);
    }
	
	//prepare statement for MAJORS
	$stmt2 = mysqli_prepare($mysqli, "SELECT MAJOR FROM MAJOR");
	//execute prepared statement 
	mysqli_stmt_execute($stmt2);
	mysqli_stmt_bind_result($stmt2, $name);
	//printf("Errormessage: %s\n", $mysqli->error);
	
	while (mysqli_stmt_fetch($stmt2)) {
		$post['name'] = $name;
		array_push($resposne['majors'], $post);
    }
	
	//prepare statement for MAJORS
	$stmt3 = mysqli_prepare($mysqli, "SELECT SCHOOL FROM SCHOOL");
	//execute prepared statement 
	mysqli_stmt_execute($stmt3);
	mysqli_stmt_bind_result($stmt3, $name);
	//printf("Errormessage: %s\n", $mysqli->error);
	
	while (mysqli_stmt_fetch($stmt3)) {
		$post['name'] = $name;
		array_push($resposne['schools'], $post);
    }
	mysqli_stmt_close($stmt1);
	mysqli_stmt_close($stmt2);
	mysqli_stmt_close($stmt3);
	mysqli_close($mysqli);
	
	echo json_encode($resposne);
?>