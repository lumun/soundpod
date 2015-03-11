<?php
// security and error checking
// define variables and set to empty values
$f_name = $m_name = $l_name = $ssn = "";
$f_nameErr = $l_nameErr = $ssnErr = "";

include '_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["f_name"])) {
  		$f_nameErr = "Name is required";
  	} 
  	else {
  		$f_name = clean_input($_POST["f_name"]);
  		if (!preg_match("/^[a-zA-Z '-]*$/",$f_name)) {
				$f_nameErr = "Only letters and white space allowed";
		}
	}
	if (!empty($_POST["m_name"])) {
		$m_name = clean_input($_POST["m_name"]);
	}
  	if (empty($_POST["l_name"])) {
  		$l_nameErr = "Name is required";
  	} 
  	else {				
		$l_name = clean_input($_POST["l_name"]);
  		if (!preg_match("/^[a-zA-Z '-]*$/",$l_name)) {
				$l_nameErr = "Only letters and white space allowed";
		}
	}
  	if (empty($_POST["ssn"])) {
  		$ssnErr = "SSN is required";
  	} else {				
		$ssn = clean_input($_POST["ssn"]);
  		if (!preg_match("/^(\d{3}-?\d{2}-?\d{4}|XXX-XX-XXXX)$/",$ssn)) {
				$ssnErr = "Required format: 999-99-9999";
		}
	}
}

// Successful form submission is handled here
if (!empty($f_name) AND !empty($l_name) AND !empty($ssn) AND empty($f_nameErr) AND empty($l_nameErr) AND empty($ssnErr)) {
	// First, change any lack of m_name to a NULL before we insert
	if (empty($m_name)) { $m_name = NULL; }
	// Attempt to insert the data
	try {
		$db = new PDO('sqlite:database/airport.sqlite3');
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO passengers VALUES ('$f_name', '$m_name', '$l_name', '$ssn')";
		// insert
		$db -> exec($sql);
		// disconnect
		$db = NULL;

		//redirect to login page
		header('Location: /login.php');
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
			<h2 style="text-decoration: underline">Data Insertion Form</h2>
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
		</div>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>

</html>