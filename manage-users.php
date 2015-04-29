<?php
include '_session.php';

include '_header.php';

// If there was a successful deletion or update, let the user know
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["delete"])) {
		// echo "<h1 class='center small-caps'>User ".$_GET["delete"]." successfully deleted</h1>";
		?>
		<div class="alert alert-info fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> User <?php echo $_GET["delete"] ?> deleted from database</p>
		</div>
		<?php
	}
	else if (isset($_GET["update"])) {
		// echo "<h1 class='center small-caps'>User ".$_GET["update"]." successfully made admin</h1>";
		?>
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> <?php echo $_GET["update"] ?> admin role changed</p>
		</div>
		<?php
	}
}

include '_display-users.php';
include '_footer.php';
?>