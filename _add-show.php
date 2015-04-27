<?php
include '_helpers.php';
include '_session.php';


// This form processes shows to be added

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["name"]) && !empty($_POST["show"]) && !empty($_POST["genre"])) {
		try {
			// random 8 digit number
			$digits = 8;
			$showID = rand(pow(10, $digits-1), pow(10, $digits)-1);

			$genre = $_POST['genre'];
			$title = clean_input($_POST['name']);
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO radioShow(showid,genre,title) VALUES ('$showID','$genre','$title')";
			// insert
			$db -> exec($sql);
			// now insert showID into DJ
			$userEmail = $_SESSION["email"];
			echo $userEmail . " - > user email!!";
			$sql2 = "INSERT INTO dj(email,showid) VALUES ('$userEmail','$showID')";
			$db -> exec($sql2);


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