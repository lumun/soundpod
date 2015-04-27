<?php
include '_helpers.php';

// This form processes shows to be added

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["name"]) && !empty($_POST["show"]) && !empty($_POST["genre"])) {
		try {
			$genre = $_POST['genre'];
			$title = clean_input($_POST['name']);
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO radioShow(genre,title) VALUES ('$genre','$title')";
			// insert
			$db -> exec($sql);
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