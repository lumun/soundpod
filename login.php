<?php
include '_helpers.php';

$email = $password = '';

// Successful form submission is handled here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  	$email = clean_input($_POST["email"]);				
		$password = clean_input($_POST["password"]);

		// Attempt to match the data
		try {
		 	$db = new PDO("mysql:dbname=soundpod", 'root');
		 	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 	$result = $db -> query ("SELECT * FROM user WHERE email='$email'");
		 	foreach ($result as $tuple) {
				if ($tuple['password'] == $password) {
			 		session_start();
					session_regenerate_id(true);
					$_SESSION["loggedin"] = "true";
					$_SESSION["email"] = $tuple['email'];
					if ($tuple['admin'] == 1) {
						$_SESSION["admin"] = 1;
					}
					else {
						$_SESSION["admin"] = 0;
					}
			 	}
				else {
					$error = "That email and password combination did not match our records";
				}
			}
	 	// disconnect
		$db = NULL;

		if (isset($_SESSION["loggedin"])) {
			header('Location: /index.php');
		}
		else {
			if (!$error) { $error = "There was an error logging in"; }
		}
	}
	catch(PDOException $e) {
	 	print 'Exception : '.$e -> getMessage();
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Group 5: University of Puget Sound Databases 2015</title>
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
</head>

<body>
    	<!-- Header inserter here -->
		<?php 
		include '_header.php';

    	if (!$loggedIn) { ?>
			<div class="content left-float">
				<form id="data-input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<p>Email:</p> <input type="text" name="email" value="<?php if (!empty($email)){echo $email;}?>">
					<br/>
					<p>Password:</p> <input type="text" name="password">
					<br/>
					<input type="submit" name="submit" value="Log In">
				</form>
			</div>

			<?php
			if ($error) {
				echo "<p>$error</p>";
			}
		}
		else {
			echo "<h2 class='center small-caps'>YOU ARE ALREADY LOGGED IN</h2>";
		}
		?>
</body>
</html>
