<?php
include '_session.php';
include '_helpers.php';

if(!empty($_POST["showid"]) && !empty($_POST["month"]) && !empty($_POST["day"])){
	$db = new PDO("mysql:dbname=soundpod", 'root');
	$guestDJ = $_SESSION["email"];
	$showID = $_POST["showid"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE subRequest SET subdj='$guestDJ', active=0 WHERE showid=$showID AND month='$month' AND day='$day'";
	print $sql;
	$shows = $db -> query ($sql);

	$db = null;
}
?>