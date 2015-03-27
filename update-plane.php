<?php
include '_helpers.php';

// define variables and set to empty values
$tail_no = $make = $model = $capacity = $mph = "";
$tail_noErr = $makeErr = $modelErr = $capacityErr = $mphErr = "";

// If we have just arrived here (no submission)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET["tail_no"]) {
		$tail_no = $_GET["tail_no"];
		try {
			$db = new PDO('mysql:database/airport.db');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $db -> query ("SELECT * FROM plane WHERE tail_no=$tail_no");
			$tuple = $result->fetch(PDO::FETCH_ASSOC);
			// set all the variables
			$make = $tuple['make'];
			$model = $tuple['model'];
			$capacity = $tuple['capacity'];
			$mph = $tuple['mph'];

			// disconnect
			$db = NULL;
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	}
}

// If this is a submission update post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// security and error checking
  	if (empty($_POST["tail_no"])) {
  		$tail_noErr = "Tail No. is required";
  	} 
  	else {
  		$tail_no = clean_input($_POST["tail_no"]);
  		if (!preg_match("/^[\d]*$/",$tail_no)) {
				$tail_noErr = "Only numbers allowed";
		}
	}
  	if (empty($_POST["make"])) {
  		$makeErr = "Make is required";
  	} 
  	else {
  		$make = clean_input($_POST["make"]);
  		if (!preg_match("/^[a-zA-Z -\d]*$/",$make)) {
				$makeErr = "Only letters and numbers allowed";
		}
	}
  	if (empty($_POST["model"])) {
  		$modelErr = "Model is required";
  	} 
  	else {				
		$model = clean_input($_POST["model"]);
  		if (!preg_match("/^[a-zA-Z -\d]*$/",$model)) {
				$modelErr = "Only letters and numbers allowed";
		}
	}
  	if (!empty($_POST["capacity"])) {			
		$capacity = clean_input($_POST["capacity"]);
  		if (!preg_match("/^[\d]*$/",$capacity)) {
				$capacityErr = "Only numbers allowed";
		}
	}
  	if (!empty($_POST["mph"])) {			
		$mph = clean_input($_POST["mph"]);
  		if (!preg_match("/^[\d]*$/",$mph)) {
				$mphErr = "Only numbers allowed";
		}
	}

	// Successful form submission is handled here
	if (!empty($tail_no) AND !empty($make) AND !empty($model) AND empty($tail_noErr) AND empty($makeErr) AND empty($modelErr) AND empty($capacityErr) AND empty($mphErr)) {
		// First, change any lack of make to a NULL before we insert
		if (empty($capacity)) { $capacity = NULL; }
		if (empty($mph)) { $mph = NULL; }
		// Attempt to insert the data
		try {
			$db = new PDO('sqlite:database/airport.sqlite3');
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Get the original tail num (necessary if it was changed)
			$original_tail_no = $_POST["original_tail_no"];

			$sql = "UPDATE plane
					SET tail_no='$tail_no', make='$make', model='$model', capacity='$capacity', mph='$mph'
					WHERE tail_no='$original_tail_no'";
			// update
			$db -> exec($sql);
			// disconnect
			$db = NULL;

			//redirect to success page
			header("Location: /view-planes.php?update='$tail_no'");
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
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
			<h2 style="text-decoration: underline">Flight Update Form</h2>
			<br/>
			<form id="data-input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<input type="hidden" name="original_tail_no" value="<?php echo $tail_no;?>" />
				<p>Tail No.:</p> <input type="text" name="tail_no" value="<?php echo $tail_no;?>">*<span class="input-error"> <?php echo $tail_noErr;?></span>
				<br/>
				<p>Make:</p> <input type="text" name="make" value="<?php echo $make;?>">*<span class="input-error"> <?php echo $makeErr;?></span>
				<br/>
				<p>Model:</p> <input type="text" name="model" value="<?php echo $model;?>">*<span class="input-error" > <?php echo $modelErr;?></span>
				<br/>
				<p>Capacity:</p> <input type="text" name="capacity" value="<?php echo $capacity;?>"><span class="input-error"> <?php echo $capacityErr;?></span>
				<br/>
				<p>Speed (MPH):</p> <input type="text" name="mph" value="<?php echo $mph;?>"><span class="input-error"> <?php echo $mphErr;?></span>
				<br/>
				<input type="submit" name="submit" value="Save">
			</form>
		</div>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>

</html>