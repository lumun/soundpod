<?php
include '_helpers.php';
include '_session.php';


// This form processes shows to be added

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["name"]) && !empty($_POST["show"]) && !empty($_POST["genre"]) && !empty($_POST["show1"])) {
		try {
			// random 8 digit number
			$digits = 8;
			$showID = rand(pow(10, $digits-1), pow(10, $digits)-1);

			$genre = $_POST['genre'];
			$title = clean_input($_POST['name']);
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $db -> prepare("INSERT INTO radioShow(showid,genre,title) VALUES ($showID,'$genre','$title')");
			// insert
			$sql->execute();
			// now insert showID into DJ
			$userEmail = $_SESSION["email"];
			echo $userEmail . " - > user email!!";
			$sql2 = "INSERT INTO dj(email,showid) VALUES ('$userEmail',$showID)";
			$db -> exec($sql2);

			// now we need to add a "show instance", first check if they have 2 differnt times.
			$showTime1 = $_POST["show1"];
			echo $showTime1;
			$dateTime1 = explode(",", $showTime1);
			$sql3 = "INSERT INTO showInstance(showid,day,time) VALUES ('$showID', '$dateTime1[0]', '$dateTime1[1]')";
			$db -> exec($sql3);
			if($_POST["show"] == 2){
				$showTime2 = $_POST["show2"];
				echo $showTime2;
				$dateTime2 = explode(",", $showTime2);
				$sql4 = "INSERT INTO showInstance(showid,day,time) VALUES ('$showID', '$dateTime2[0]', '$dateTime2[1]')";
				$db -> exec($sql4);
			}


			// disconnect
			$db = NULL;


			//redirect to success page
			header("Location: /manage-shows.php");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>