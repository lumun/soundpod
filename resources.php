<?php 
include '_session.php';
include '_header.php';

if (!$loggedin) {
	header('Location: /login.php');
	die();
}
?>
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
<?php }//for admin only uploads ?>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

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


<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

<img style="float:right" src="/assets/images/kids.jpg" class="center-block img-responsive" alt="Image">

</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
	

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

<h3>Contact us!</h3>
<p class='text-left'>The Spot ~ <br><a href="https://www.google.com/maps/place/KUPS+90.1FM+Tacoma+%22The+Sound%22/@47.26322,-122.478836,17z/data=!3m1!4b1!4m2!3m1!1s0x549054e23edb113d:0x2295ea3f4cc7466a">1500 N Warner Street
Tacoma, WA 98416</a></p>
<p class='text-left'>The phone <br>253-879-2415</p>

</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
