<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		header("Location: gamesList.php");
		exit();
	}
	if (!isset($_POST['passcode']) && !isset($_POST['nick'])) {
		session_destroy();
		header("Location: index.php");
		exit();
	}
	require_once "base.php";
	$connection = new mysqli($host,	$db_user, $db_passcode, $db_name);
	if ($connection->connect_errno != 0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$userNum;
		$login = $_POST['nick'];
		$passcode = $_POST['passcode'];
		$sql = "SELECT nickname, mail, id, passcode FROM users WHERE BINARY nickname = ?";
		$stmt = $connection -> prepare($sql);
		$stmt -> bind_param("s", $login);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($nick, $mail, $id, $hash);
		$userNum = $stmt->num_rows;
		$stmt -> fetch();
		$stmt -> close();
		if ($userNum > 0 && password_verify($passcode, $hash)) {
			$_SESSION['id'] = $id;
			$_SESSION['nick'] = $nick;
			$_SESSION['mail'] = $id;
			$_SESSION['logged'] = true;
			header('Location: gamesList.php');
		} else {
			$_SESSION['error'] = "Nie udało się zalogować!";
			header('Location: index.php');
		}
	}
	session_close();


?>