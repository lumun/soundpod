<?php
session_start();
if (isset($_SESSION["loggedin"])) {
	$loggedIn = true;
}
else {
	$loggedIn = false;
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>KUPS DJ Portal</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="assets/js/datepicker.js"></script>
	<!-- kups stuff -->
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
		<link rel="stylesheet" href="/assets/stylesheets/datepicker.css">
</head>

<body>
	


<div id="header">
	<a href="<?php if ($loggedIn) { echo '/index.php'; } else { echo '/index.php'; } ?>">
		<p>KUPS DJ Portal</p>
		<img src="/assets/images/kups.png" alt="Sound Pod" class="left-float" style="height:52px">
	</a>
	<?php 
	if ($loggedIn) { ?>
		<a class="nav-button" id="logout" href="/_logout.php">Logout</a>
		<?php if ($_SESSION["admin"] == 1) { ?>
			<a class="nav-button" id="manage" href="/manage_users.php">Manage Users</a>
		<?php }
	}
	else { ?>
		<a class="nav-button" id="login" href="/login.php">Login</a>
		<a class="nav-button" id="sign-up" href="/sign-up.php">Sign Up</a>
	<?php } ?>
</div>