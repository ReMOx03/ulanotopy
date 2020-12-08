<?php
	$a = "hujdsdsdsdsds";
	$b = "hujdsdsdsdsds";

		$a = password_hash($a, PASSWORD_DEFAULT);
		if (password_verify($b, $a)) {
		  echo 'Password is valid!';
		} else {
		  echo 'Invalid password.';
		}

	echo hash_equals ("da", "cas");


?>