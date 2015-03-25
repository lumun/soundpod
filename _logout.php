<?php
session_start();
if(isset($_SESSION['loggedin'])) {
	// remove all session variables
	session_unset(); 
	// destroy the session 
	session_destroy();
	
	header('Location: /index.php');
}
?>