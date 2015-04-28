<?php
include '_helpers.php';


if(!empty($_POST["showid"]) && !empty($_POST["month"]) && !empty($_POST["day"])){
	$db = new PDO("mysql:dbname=soundpod", 'root');
	$guestDJ = $_SESSION["email"];
	$showID = $_POST["showid"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = $db -> prepare("UPDATE subRequest SET subdj='$guestDJ', active='2' WHERE showid='$showID', month='$month', day='$day'");
	// insert
	$sql->execute();
	$db = null;
}
?>