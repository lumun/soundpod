<?php
// Directory for uploads, to read and write
$dir = "uploads/";
// Set this to true if upload is successful
$successfulUpload = false;
// Set a maximum filesize in bytes
$maxFileSize = 100000;
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
$filesOnServer = []; // create a new array for filenames
if (is_dir($dir)) {
	if ($directoryHandle = opendir($dir)) {
		while (($file = readdir($directoryHandle)) !== false) {
			$filetype = filetype($dir . $file);
			$filesize = filesize($dir . $file);
			if ($filetype !== "dir") {
				$filesOnServer[$file] = $filesize;
			}
		}
	closedir($directoryHandle);
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

    	<!-- If there was a successful upload, let the user know -->
    	<!-- If not, display an error message -->
    	<?php
    	if ($successfulUpload) {
    		echo "<h1 class='center'>" . $filename . " uploaded successfully</h1>";
    	}
    	if ($errorMessage !== "") {
    		echo "<h1 class='center' style='color:red'>" . $errorMessage . "</h1>";
    	}
    	?>

		<div class="content left-float">
			<h2 style="text-decoration: underline">File Upload Form</h2>
			<br/>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<p>Select file to upload</p>
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
		<div class="content left-float">
			<h2 style="text-decoration: underline">Files on Server</h2>
			<br/>
			<table>
				<tr><td><p style="text-decoration: underline">File (click to access)</p></td><td><p style="text-decoration: underline">Size</p></td></tr>
				<?php 
				foreach ($filesOnServer as $f => $s) {
					echo "<tr><td><a href='uploads/" . $f . "'>" . $f . "</a></td><td>" . $s . "</td></tr>"; 
				}
				?>
			</table>
		</div>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>

</html>