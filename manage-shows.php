<?php
include '_session.php';
include '_header.php'; 
include '_helpers.php';

// If there was a successful deletion or update, let the user know
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["delete"])) {
		// echo "<h1 class='center small-caps'>User ".$_GET["delete"]." successfully deleted</h1>";
		?>
		<div class="alert alert-info fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> Radio show <?php echo $_GET["delete"] ?> deleted</p>
		</div>
		<?php
	}
	else if (isset($_GET["update"])) {
		// echo "<h1 class='center small-caps'>User ".$_GET["update"]." successfully made admin</h1>";
		?>
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> Radio show <?php echo $_GET["update"] ?> updated</p>
		</div>
		<?php
	}
}
?>

<?php 
try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo "<br />";

	include '_my-shows.php';

	include '_display-shows.php';

	// close the database connection
	$db = NULL;
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

echo '<br />';

include '_footer.php'
?>