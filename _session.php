<?php
// This code is run everytime
session_start();
if (isset($_SESSION["loggedin"])) {
	$loggedin = true;
}
else {
	$loggedin = false;
}

if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
	$isAdmin = true;
}
else {
	$isAdmin = false;
}

?>