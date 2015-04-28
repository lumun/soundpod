<?php
include '_session.php';
include '_helpers.php';


if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["showid"]) && !empty($_POST["month"]) && !empty($_POST["day"])){
	$db = new PDO("mysql:dbname=soundpod", 'root');
	$guestDJ = $_SESSION["email"];
	$showID = $_POST["showid"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE subRequest SET subdj='$guestDJ', active=0 WHERE showid=$showID AND month='$month' AND day='$day'";
	$shows = $db -> query ($sql);

	$db = null;
}

include '_header.php';
?>

<p> Wowwwweeeeee thanks so much for subbing the show! Here's the details of the show you agreed to sub, ROCKSTAR</p>
<p> It is on <?php echo "$month $day";?></P>
	<p>To go back to the subrequests page, <a href="/substitutions.php">click here!</a></p>