<?php
include '_session.php';
include '_header.php';
include '_helpers.php';

echo "<span class='col-md-2 col-lg-2'></span>";
echo "<div class='col-md-8 col-lg-8'>";

try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// If there was a successful deletion or update, let the user know
	echo "<br />";

	if (isset($_GET["delete"])) {
		$name = $_GET["delete"];
		?>
		<div class="alert alert-info fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> <?php echo $name ?> deleted from database</p>
		</div>
		<?php
	}
	else if (isset($_GET["update"])) {
		$email = $_GET["update"];
		$result = $db -> query ("SELECT * FROM user WHERE email=$email");
		$user = $result -> fetch();
		$name = stripslashes($user['name']);
		?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> <?php echo $name ?>'s admin role changed</p>
		</div>
		<?php
	}

	include '_display-users.php';

	// close the database connection
	$db = NULL;
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

echo '<br /></div>';

include '_footer.php'
?>