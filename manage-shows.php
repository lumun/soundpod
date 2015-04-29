<?php
include '_session.php';
include '_header.php'; 
include '_helpers.php';

echo "<span class='col-xs-2 col-sm-2 col-md-2 col-lg-2'></span>";
echo "<div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>";
echo "<br />";

// If there was a successful deletion or update, let the user know
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["delete"])) {
		?>
		<div class="alert alert-error fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Radio show deleted</strong></p>
		</div>
		<?php
	}
	else if (isset($_GET["update"])) {
		?>
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> Radio show <?php echo $_GET["update"] ?> updated</p>
		</div>
		<?php
	}
	else if (isset($_GET["add-show"])) {
		$showName = $_GET['add-show'];
		?>
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> You've added your show <?php echo stripslashes($showName) ?> to the portal</p>
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

	include '_my-shows.php';

	include '_display-shows.php';

	// close the database connection
	$db = NULL;
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

echo '<br /></div>';

include '_footer.php'
?>