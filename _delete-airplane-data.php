<?php
// This form processes tuples to be deleted from the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["tail_no"]) {
		$tail_no = $_POST["tail_no"];
		try {
			$db = new PDO('sqlite:database/airport.sqlite3');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM plane WHERE tail_no=$tail_no";
			// delete
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /view-airplane-data.php?delete='success'");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>