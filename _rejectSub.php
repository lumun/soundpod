<?php
include '_session.php';
include '_helpers.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["showid"]) && !empty($_POST["month"]) && !empty($_POST["day"])){
	$guestDJ = $_SESSION["email"];
	$showID = $_POST["showid"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	try {
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE subRequest SET subdj='NULL', active=1 WHERE showid=$showID AND month='$month' AND day='$day'";
		$shows = $db -> query ($sql);

		if (empty($shows)) {
			print "Something went wrong.";
			echo "<a href='/index.php'>Back to safety</a>";
		}
		else {
			//redirect
			header("Location: /substitutions.php?revoke=$showID");
		}
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
		echo "<a href='/index.php'>Back to safety</a>";
	}

	$db = null;
}
else {
	print "Something went wrong.";
	echo "<a href='/index.php'>Back to safety</a>";
}