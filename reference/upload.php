<?php
include '_helpers.php';
include '_session.php';
// Directory for uploads, to read and write
$dir = "uploads/";
// Set this to true if upload is successful
$successfulUpload = false;
// Set a maximum filesize in bytes
$maxFileSize = 10000000;
// Error message string
$errorMessage = "";

// This section deals with file uploads
if(isset($_POST["submit"])) {
	$filename = basename($_FILES["fileUpload"]["name"]);
	$target_file = $dir . $filename;
	$uploadOk = true; // maintains whether this file uploaded OK
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check file size
	if ($_FILES["fileUpload"]["size"] > $maxFileSize) {
	    $uploadOk = false;
	}

	// Check if $uploadOk has found an error
	if ($uploadOk && move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
		$successfulUpload = true;
	} 
	else {
		$errorCode = $_FILES["fileUpload"]["error"];
		if ($errorCode == 1 || $errorCode == 2) {
			$errorMessage = "ERROR: The uploaded file exceeds the maximum filesize of " . $maxFileSize . " bytes";
		}
		else if ($errorCode == 3) {
			$errorMessage = "ERROR: The uploaded file was only partially uploaded";
		}
		else if ($errorCode == 4) {
			$errorMessage = "ERROR: No file was uploaded";
		}
		else {
			$errorMessage = "ERROR: There was an error uploading your file.";
		}
	}
}

// This section deals with finding the files currently in the directory
// helper method located in _helpers
$filesOnServer = scandir($dir);

?>
<!-- Header inserter here -->
<?php include '_header.php'; ?>
<!-- If there was a successful upload, let the user know -->
<!-- If not, display an error message -->
<?php
if ($successfulUpload)
	echo "<h1 class='center'>" . $filename . " uploaded successfully</h1>";
if ($errorMessage !== "") 
	echo "<h1 class='center' style='color:red'>" . $errorMessage . "</h1>";
	

if($isAdmin)
{	
?>

<div class="content left-float">
	<h2 style="text-decoration: underline">File Upload Form</h2>
	<br/>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<p>Upload a file</p>
		<p>Max file size: <?php echo $maxFileSize ?> bytes</p>
		<br/>
		<!-- MAX_FILE_SIZE must precede the file input field -->
   		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize ?>" />
		<input type="file" name="fileUpload" id="fileUpload">
		<br/>
		<br/>
		<input type="submit" name="submit" value="Upload">
	</form>
</div>
<?php }//for admin only uploads ?>
<div class="content left-float">
	<h2 style="text-decoration: underline">Helpful KUPS resources!</h2>
	<br/>
	<table>
		<tr><td><p style="text-decoration: underline">File (click to access)</p></td><td><p style="text-decoration: underline">Size</p></td></tr>
		<?php 
		foreach ($filesOnServer as $f => $s) {
			if($s != "." && $s != "..")
				echo "<tr><td><a href='uploads/" . $s . "'>" . $s . "</a></td></tr>"; 
		}
		?>
	</table>
</div>

<div class="container">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/air.jpg" class="center-block img-responsive" alt="Image">
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/kids.jpg" class="center-block img-responsive" alt="Image">
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/tom.jpg" class="center-block img-responsive" alt="Image">
	</div>
</div>

<h3>Contact us!</h3>
<p>The Spot<a href="https://www.google.com/maps/place/KUPS+90.1FM+Tacoma+%22The+Sound%22/@47.26322,-122.478836,17z/data=!3m1!4b1!4m2!3m1!1s0x549054e23edb113d:0x2295ea3f4cc7466a">1500 N Warner Street
Tacoma, WA 98416</a></p>
<p>The phone 253-879-2415</p>
