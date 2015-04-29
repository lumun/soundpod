<?php
include '_session.php';
include '_helpers.php';
if (!$loggedin) { 
	header("Location: /login.php"); 
	die(); 
}

include '_header.php';

echo "<span class='col-xs-2 col-sm-2 col-md-2 col-lg-2'></span>";
echo "<div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>";
	try 
	{
		//open the databas
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// If there was a sub request or accept, notify the user
		echo "<br />";

		if (isset($_GET["request"])) {
			$showid = $_GET["request"];
			?>
			<div class="alert alert-info fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><strong>Success!</strong> Your sub request has been posted</p>
			</div>
			<?php
		}
		else if (isset($_GET["accept"])) {
			$showid = $_GET["accept"];
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><strong>Thank you for accepting a sub request!</strong> Please take note of its date and time so you're sure not to miss it</p>
			</div>
			<?php
		}

		// include '_my-shows.php';

		include '_display-sub-accepts.php';
 
		include '_display-sub-requests.php';

		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
echo "</div>";

?>