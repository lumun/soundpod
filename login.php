<?php
	if (setcookie("LoggedIn", "true")) {
		header('Location: /account.php');
	}
	else {
		echo "There was an error logging in";
	}
?>