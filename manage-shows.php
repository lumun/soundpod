<?php
include '_session.php';
?>
	<!-- Header inserter here -->
	<?php include '_header.php'; ?>

	<?php
	// If there was a successful deletion or update, let the user know
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["delete"])) {
    		echo "<h1 class='center small-caps'>Radio show ".$_GET["delete"]." successfully deleted</h1>";
		}
		else if (isset($_GET["update"])) {
			echo "<h1 class='center small-caps'>Radio show ".$_GET["update"]." successfully updated</h1>";
		}
    }
	?>

	<?php include '_display-shows.php';?>
