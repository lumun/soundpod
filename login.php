<?php
include '_session.php';
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
		 	$results = $db -> query ("SELECT * FROM user WHERE email='$email'");
		 	$tuple = $results -> fetch();

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

    	if ($loggedin) {
    		echo "<h2 class='center small-caps'>YOU ARE ALREADY LOGGED IN</h2>";
		}
		else { ?>
			<div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
				<br />
			    <div class="well">
			    	<form id="data-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
			    		<legend>Log In</legend>
			    	
			    		<div class="form-group">
			    			<label for="email">Email</label>
			    			<input type="text" placeholder="Enter Email" class="form-control" name="email" value=<?php echo "\"".$email."\"";?>>
			    		</div>
				    	<div class="form-group">
				    		<label for="password">Password</label>
				    		<input type="password" class="form-control" name="password" placeholder="Enter Password">
				    	</div>
			    	
			    		<button  type="submit" class="btn btn-primary" name="submit">Log In</button>
			    	</form>
				</div>
			</div>
		<?php
		}
		if (isset($error)) {
			echo "<p>$error</p>";
		}
		?>
</body>
</html>
