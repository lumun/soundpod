<?php
	// As of now, this page simple logs the user in (sets loggedin to true, but does not maintain who is logged in).
	// At some point, this page will actually show a login form.

	session_start();
	session_regenerate_id(true);
	$_SESSION["loggedin"] = "true";

	if (isset($_SESSION["loggedin"])) {
		header('Location: /account.php');
	}
	else {
		echo "There was an error logging in";
	}
?>

<!-- <!DOCTYPE html>
<html>

<head>
	<title>Group 5: University of Puget Sound Databases 2015</title>
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
</head>

<body> -->
	<!-- faitwrapper class is necessary on ALL pages for sticky footer -->
    <!-- <div id="faitwrapper"> -->
    	<!-- Header inserter here -->
		<?php 
		// include '_header.php';

    	//if (!$loggedIn) { ?>
			<!-- <div class="content left-float">
				<h2 style="text-decoration: underline">Login Form</h2>
				<br/>
				<form id="data-input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<p>First Name:</p> <input type="text" name="f_name" value="<?php echo $f_name;?>">*<span class="input-error"> <?php echo $f_nameErr;?></span>
					<br/>
					<p>Middle Name:</p> <input type="text" name="m_name" value="<?php echo $m_name;?>">
					<br/>
					<p>Last Name:</p> <input type="text" name="l_name" value="<?php echo $l_name;?>">*<span class="input-error" > <?php echo $l_nameErr;?></span>
					<br/>
					<p>SSN:</p> <input type="text" name="ssn" placeholder="999-99-9999" <?php if (!empty($ssn)) { echo "value=".$ssn; } ?> >*<span class="input-error"> <?php echo $ssnErr;?></span>
					<br/>
					<input type="submit" name="submit" value="Submit">
				</form>
			</div> -->
		<?php // }
		// else {
		// 	echo "<h2 class='center small-caps'>YOU ARE ALREADY LOGGED IN</h2>";
		// }
		?>

		<!-- <div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php // include '_footer.php'; ?>
	</div>
</body>
</html> -->