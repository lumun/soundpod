<?php
// This form processes tuples to be deleted from the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["email"]) {
		$email = $_POST["email"];
		try {
			$db = new PDO("mysql:dbname=soundpod", 'root');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE user SET admin = (1-admin) WHERE email = '$email'";
			// delete
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /manage_users.php?update='$email'");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}
?>