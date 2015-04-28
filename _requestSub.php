<?php
include '_helpers.php';

if(!empty($_POST["date"])){
	$dateInfo = explode(",", $_POST["date"]);
	$dayOfWeek = $dateInfo[0];
	$monthInfo = explode(" ", $dateInfo[1]);
	$time = $dateInfo[2];
	$currentDj = $_SESSION['email'];

	$db = new PDO("mysql:dbname=soundpod", 'root');
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO subRequest(showid,,title) VALUES ('$showID','$genre','$title')";
	// insert

	origdj VARCHAR(30),
	subdj VARCHAR(30),
	comment VARCHAR(2000),
	showid INT,
	weekday VARCHAR(10),
	time VARCHAR(10),
	month VARCHAR(10),
	day VARCHAR (5),
	active TINYINT(2) DEFAULT 1,

	$db -> exec($sql);


	//close connection
	$db = NULL;

}

?>