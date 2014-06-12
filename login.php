<?php
	if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$email = $_POST['email'];
	}
	if(isset($_POST['pwd'])){
		$pwd = $_POST['pwd'];
	}
	if(isset($_POST['email']) && isset($_POST['pwd'])){
		//check connection
		$mysqli = new mysqli("localhost", "root", "pcco", "mydb");
		//force using utf-8 charset
		mysqli_set_charset ( $mysqli,'utf8');
		if ($mysqli->connect_errno) {
			echo 0;
		}
		else{
			$stmt = mysqli_prepare($mysqli, "SELECT * FROM CREDENTIAL WHERE EMAIL = ? AND PWD = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $email, $pwd);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt, $em, $pw, $va);
				if(mysqli_stmt_fetch($stmt) == NULL){
					echo 2;
				}
				else{
					echo 3;
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