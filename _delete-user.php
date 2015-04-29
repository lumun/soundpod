<?php
// This form processes tuples to be deleted from the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["email"]) {
		$email = $_POST["email"];
		$name = $_POST['name'];
		try {
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "DELETE FROM user WHERE email='$email'";
			// delete
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /manage-users.php?delete=$name");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>