<!DOCTYPE html>
<html>

<head>
	<title>Group 5: University of Puget Sound Databases 2015</title>
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
</head>

<body>
	<!-- faitwrapper class is necessary on ALL pages for sticky footer -->
    <div id="faitwrapper">
    	<!-- Header inserter here -->
    	<?php include '_header.php'; ?>

    	<?php
    	// If there was a successful deletion or update, let the user know
    	if ($_SERVER["REQUEST_METHOD"] == "GET") {
    		if (isset($_GET["delete"])) {
	    		echo "<h1 class='center small-caps'>Plane ".$_GET["delete"]." successfully deleted</h1>";
    		}
    		else if (isset($_GET["update"])) {
				echo "<h1 class='center small-caps'>Plane ".$_GET["update"]." successfully updated</h1>";
    		}
	    }
    	?>

		<?php include '_display-planes.php'; ?>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>
</html>