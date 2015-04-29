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
$filesOnServer = scandir($dir);


include '_header.php'; 
echo "<br />"; ?>

<div class = "container">
<div class="row">
<div class="col-md-3 col-lg-3"></div>
<div class="col-md-6 col-lg-6">

	<?php
	if ($successfulUpload) { 
		?>
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> You uploaded a new resource: <?php echo $filename ?></p>
		</div>
		<?php
	}
	else if ($errorMessage != "") {
		?>
		<div class="alert alert-error fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Error!</strong> <?php echo $errorMessage ?></p>
		</div>
	<?php }

	if($isAdmin) { ?>
		<div class="well well-add">
		<legend>Resource Upload Form</legend>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<p>Upload a file</p>
			<p>Max file size: <?php echo $maxFileSize ?> bytes</p>
	   		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize ?>" />
			<input type="file" name="fileUpload" id="fileUpload">
			<br/>
			<input type="submit" name="submit" value="Upload">
		</form>
		</div>
	<?php }//for admin only uploads ?>

</div></div>
<div class="col-md-3 col-lg-3"></div>
</div>
</div>

<div class = "container">
<div class = "row">
<div class="col-md-3 col-lg-3"></div>

<div class="col-md-6 col-lg-6">

	<div class="well">
		<legend>DJ Resources</legend>
		<?php
		if (count($filesOnServer) < 3) {
			print "The admins haven't uploaded any resources to the server.";
		}
		else { ?>
			<table class="table table-bordered table-striped" border="1">
			<tbody align="center">
			<tr><th>File (click to access)</th></tr>
			
			<?php	
			foreach ($filesOnServer as $f => $s) {
				if($s != "." && $s != "..")
					echo "<tr><td><a href='uploads/" . $s . "'>" . $s . "</a></td></tr>"; 
			}
		}
		?>
	</tbody></table>
	</div>

</div>
<div class="col-md-3 col-lg-3"></div>
</div>
</div>



<div class = "row">
<div class = "container">
<div class="col-md-2 col-lg-2"></div>

<div class="col-md-8 col-lg-8">
<img style="float:center" src="/assets/images/kids.jpg" class="center-block img-responsive" alt="Image">
</div>
<div class="col-md-2 col-lg-2"></div>
</div>
</div>

<br />

<?php include '_footer.php'; ?>