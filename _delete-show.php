<?php
// This form processes tuples to be deleted from the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["showid"]) {
		$showid = $_POST["showid"];
		try {
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM show WHERE showid='$showid'";
			// delete
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /manage-shows.php?delete='$showid'");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>