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


include '_header.php'; 

if ($successfulUpload)
	echo "<h1 class='center'>" . $filename . " uploaded successfully</h1>";
if ($errorMessage !== "") 
	echo "<h1 class='center' style='color:red'>" . $errorMessage . "</h1>";
	

if($isAdmin)
{	
?>
<div class = "container">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
</div></div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
</div>
<?php }//for admin only uploads ?>


<div class = "container">
<div class = "row">
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

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
</div></div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
</div>

<div class = "row">
<div class = "container">
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
<img style="float:right" src="/assets/images/kids.jpg" class="center-block img-responsive" alt="Image">
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
</div>
