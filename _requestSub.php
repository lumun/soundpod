<?php
include '_helpers.php';
include '_session.php';

if(isset($_POST["date"])) {
	try {
		$showid = $_POST['showid'];
		$dateInfo = explode(",", $_POST["date"]);
		$weekday = $dateInfo[0];
		$monthAndDate = explode(" ", $dateInfo[1]);
		$month = $monthAndDate[1];
		$day = $monthAndDate[2];
		$time = $dateInfo[2];
		$currentDj = $_SESSION['email'];

		$db = new PDO("mysql:dbname=soundpod", 'root');
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $db->prepare("INSERT INTO subRequest(origdj,showid,weekday,time,month,day,active) VALUES ('$currentDj', $showid, '$weekday','$time','$month','$day',1)");
		$sql -> execute();

		//close connection
		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
}

//redirect
header("Location: /substitutions.php?request=$showid");

?>