<?php
// This form processes shows to be added

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["name"]) && !empty($_POST["show"]) && !empty($_POST["genre"]) && !empty($_POST["datetimepicker1"])) {
		try {
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO radioShow(genre,title) VALUES ($_POST['genre'],$_POST['name'])";
			// insert
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /index.php");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>