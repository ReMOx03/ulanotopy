<?php
	session_start();
	if (!isset($_SESSION['logged'])) {
		session_destroy();
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista gier</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<header><a href="logout.php"><button>Wyloguj</button></a></header>
</body>
</html>