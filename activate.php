<?php
	$email = '';
	$key = '';
	if(isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
		$email = $_GET['email'];
	}
	if(isset($_GET['key']) && (strlen($_GET['key']) == 32)){
		$key = $_GET['key'];
	}
	if(isset($_GET['email']) && isset($_GET['key'])){
		//check connection
		$mysqli = new mysqli("localhost", "root", "pcco", "mydb");
		//force using utf-8 charset
		mysqli_set_charset ( $mysqli,'utf8');
		if ($mysqli->connect_errno) {
			echo "Activation failed due to database connection error.";
		}
		else{
			$stmt = mysqli_prepare($mysqli, "UPDATE CREDENTIAL SET VALIDATION = 'YES' WHERE EMAIL = ? AND VALIDATION = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $email, $key);
			if(mysqli_stmt_execute($stmt)){
				echo "Activation succeeded.";
			}
			else{
				echo "Activation failed";
				printf("Errormessage: %s\n", $mysqli->error);
			}
			//close connection
			mysqli_close($mysqli);
		}
	}
?>