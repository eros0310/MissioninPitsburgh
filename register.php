<?php	
	$_POST['cell'] = preg_replace("/[^0-9]/", "", $_POST['cell']);
	
	//check connection
	$mysqli = new mysqli("localhost", "root", "pcco", "mydb");
	//force using utf-8 charset
	mysqli_set_charset ( $mysqli,'utf8');
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}	
	
	//prepare statement for CREDENTIAL
	$stmt1 = mysqli_prepare($mysqli, "INSERT INTO CREDENTIAL VALUES(?, ?)");
	mysqli_stmt_bind_param($stmt1, 'ss', $_POST['email'], $_POST['pwd']);
	//execute prepared statement 
	mysqli_stmt_execute($stmt1);
	//printf("Errormessage: %s\n", $mysqli->error);
	mysqli_stmt_close($stmt1);
	
	// prepare statement for BASIC
	$stmt2 = mysqli_prepare($mysqli, "INSERT INTO BASIC VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt2, 'ssssssssssssssss', $_POST['lnc'], $_POST['fnc'], $_POST['lne'], $_POST['fne'], $_POST['email'], $_POST['cell'], $_POST['gen'], $_POST['line'], $_POST['qq'], $_POST['wechat'], $_POST['region'], $_POST['school'], $_POST['major'], $_POST['program'], $_POST['length'], $_POST['comment']);
	//execute prepared statement
	mysqli_stmt_execute($stmt2);
	//printf("Errormessage: %s\n", $mysqli->error);
	mysqli_stmt_close($stmt2);
	
	if($_POST['pick'] == 'Y' || $_POST['hosting'] == 'Y'){
		//prepare statement for HOSTNPICKUP 
		$stmt3 = mysqli_prepare($mysqli, "INSERT INTO HOSTNPICKUP VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt3, 'ssssssssssssss', $_POST['lnc'], $_POST['fnc'], $_POST['lne'], $_POST['fne'], $_POST['email'], $_POST['gen'], $_POST['flight'], $_POST['date'], $_POST['time'], $_POST['lug'], $_POST['com'], $_POST['hosting'] , $_POST['pick'], $_POST['comment']);
		//execute prepared statement 
		mysqli_stmt_execute($stmt3);
		//printf("Errormessage: %s\n", $mysqli->error);
		//printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt3));
	}
	mysqli_stmt_close($stmt3);
	/* close connection */
	mysqli_close($mysqli);
	/*
	$email = rtrim($_POST['email']);
	$pwd = rtrim($_POST['pwd']);
	$lnc = rtrim($_POST['lnc']);
	$fnc = rtrim($_POST['fnc']);
	$lne = rtrim($_POST['lne']);
	$fne = rtrim($_POST['fne']);
	$gen = rtrim($_POST['gen']);
	$region = rtrim($_POST['region']);
	$cell = rtrim($_POST['cell']);
	$line = rtrim($_POST['line']);
	$qq = rtrim($_POST['qq']);
	$wechat = rtrim($_POST['wechat']);
	$school = rtrim($_POST['school']);
	$major = rtrim($_POST['major']);
	$program = rtrim($_POST['program']);
	$length = rtrim($_POST['length']);
	$pick = rtrim($_POST['pick']);
	$hosting = rtrim($_POST['hosting']);
	$flight = rtrim($_POST['flight']);
	$date = rtrim($_POST['date']);
	$time = rtrim($_POST['time']);
	$lug = rtrim($_POST['lug']);
	$com = rtrim($_POST['com']);
	$comment = rtrim($_POST['comment']);
	*/
?>