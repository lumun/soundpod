<?php
// security and error checking
// define variables and set to empty values
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";

include '_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["name"])) {
  		$nameErr = "Name is required";
  	} 
  	else {
  		$name = clean_input($_POST["name"]);
  		if (!preg_match("/^[a-zA-Z '-]+$/",$name)) {
				$f_nameErr = "Only letters and white space allowed";
		}
	}
  	if (empty($_POST["email"])) {
  		$emailErr = "Email is required";
  	} else {				
		$email = clean_input($_POST["email"]);

  		if (!preg_match("/^[A-Za-z0-9._%+-]+@(pugetsound\.edu|ups\.edu)$/",$email)) {
				$emailErr = "Required format: username@pugetsound.edu";
		}
	}
  	if (empty($_POST["password"])) {
  		$passwordErr = "Password is required";
  	} 
  	else {
  		$password = clean_input($_POST["password"]);
  		if (!preg_match("/^[\w]+$/",$password)) {
				$passwordErr = "Only valid symbols allowed";
		}
	}
}

// Successful form submission is handled here
if (!empty($name) AND !empty($email) AND !empty($password) AND empty($nameErr) AND empty($emailErr) AND empty($passwordErr)) {
	// Attempt to insert the data
	try {
	 	$db = new PDO("mysql:dbname=soundpod", 'root');
	 	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$sql = "INSERT INTO user(name,email,password) VALUES ('$name', '$email', '$password')";
	 	// insert
	 	$db -> exec($sql);
	 	// disconnect
		$db = NULL;

		//redirect to login page
		header('Location: /view-database.php');
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
	<!-- faitwrapper class is necessary on ALL pages for sticky footer -->
    <div id="faitwrapper">
    	<!-- Header inserter here -->
    	<?php include '_header.php'; ?>

		<div class="content left-float">
			<h2 style="text-decoration: underline">Sign Up</h2>
			<br/>
			<form id="data-input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<p>Name:</p> <input type="text" name="name" value="<?php echo $name;?>">*<span class="input-error"> <?php echo $nameErr;?></span>
				<br/>
				<p>Email (pugetsound.edu address):</p> <input type="email" name="email" placeholder="you@pugetsound.edu" <?php if (!empty($email)) { echo "value=".$email; } ?> >*<span class="input-error"> <?php echo $emailErr;?></span>
				<br/>
				<p>Password:</p> <input type="password" name="password" value="<?php echo $password;?>">*<span class="input-error" > <?php echo $passwordErr;?></span>
				<br/>
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>

</html>
