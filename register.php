<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		header("Location: gamesList.php");
		exit();
	}
	$nick = trim($_POST['nick']);
	$passcode = trim($_POST['passcode']);
	$passcode2 = trim($_POST['passcode2']);
	$mail = trim($_POST['email']);

	$allRight = true;

	if ($nick == "") {
		$allRight = false;
	}
	if ($passcode != $passcode2) {
		$allRight = false;
	}
	if ($passcode == "") {
		$allRight = false;
	}
	if (!isset($_POST['ch1'])) {
		$allRight = false;
	}
	if ($allRight == false) {
		$_SESSION['error'] = "Nie udało się zarejestrować!";
		header('Location: index.php');
		exit();
	}

	require_once "base.php";
	$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
	if ($connection->connect_errno !=0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$sql = "SELECT nickname, mail FROM users WHERE BINARY nickname = ? OR BINARY mail = ?";
		$stmt = $connection -> prepare($sql);
		$stmt -> bind_param("ss", $nick, $mail);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> fetch();
		$alfa = $stmt->num_rows;
		$stmt -> close();
		if ($alfa > 0) {	
			$_SESSION['error'] = "Istnieje użytkownik o tym nicku lub emailu!";
			session_destroy();
			header("Location: index.php");
		} else {
			$passcode = password_hash($passcode, PASSWORD_DEFAULT);
			echo $passcode;
			$sql = "INSERT INTO users (nickname, password, mail) VALUES (?,?,?)";
			$stmt = $connection -> prepare($sql);
			$stmt -> bind_param("sss", $nick, $passcode,$mail);
			$stmt -> execute();
			$stmt -> close();
			$_SESSION['error'] = "Udało się zarejestrować!!!";
			session_destroy();
			header("Location: index.php");
		} 

	}

?>