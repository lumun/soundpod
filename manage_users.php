<!DOCTYPE html>
<html>

<head>
	<title>Group 5: University of Puget Sound Databases 2015</title>
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
</head>

<body>
	<!-- Header inserter here -->
	<?php include '_header.php'; ?>

	<?php
	// If there was a successful deletion or update, let the user know
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["delete"])) {
    		echo "<h1 class='center small-caps'>User ".$_GET["delete"]." successfully deleted</h1>";
		}
		else if (isset($_GET["update"])) {
			echo "<h1 class='center small-caps'>User ".$_GET["update"]." successfully made admin</h1>";
		}
    }
	?>

	<?php include '_display-users.php'; ?>
</body>
</html>