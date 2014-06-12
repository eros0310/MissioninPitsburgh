<?php
	if(isset($_POST['add']) && filter_var($_POST['add'], FILTER_VALIDATE_EMAIL)){
		//check connection
		$mysqli = new mysqli("localhost", "root", "pcco", "mydb");
		//force using utf-8 charset
		mysqli_set_charset ( $mysqli,'utf8');
		if ($mysqli->connect_errno) {
			echo 0;
		}
		else{
			$stmt = mysqli_prepare($mysqli, "SELECT PWD FROM CREDENTIAL WHERE EMAIL = ?");
			mysqli_stmt_bind_param($stmt, 's', $_POST['add']);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt, $pwd);
				if(mysqli_stmt_fetch($stmt) == NULL){
					echo 2;
				}
				else{
					$msg = 'Your password is:'.PHP_EOL;
					$msg .= $pwd;
					mail($_POST['add'], "Password Recovery", $msg, 'From: NSWM');
					echo $msg;
				}
			}
			else{
				echo 1;
				printf("Errormessage: %s\n", $mysqli->error);
			}
			//close connection
			mysqli_close($mysqli);
		}
	}
?>