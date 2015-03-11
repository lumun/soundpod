<?php
// Set the image width
$imageWidth = "160px";
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

    	<h1 class="center small-caps" style="margin-bottom:10px">Welcome to Sound Pod</h1>
    	<img src="/assets/images/orca.gif" alt="Sound Pod" class="center" style="width:<?php echo $imageWidth ?>; padding:20px">

    	<?php
    	if (!$loggedIn) {
	    	echo "<div class='center' style='width:$imageWidth'>";
	    		echo "<a class='nav-button left-float' href='sign-up.php'>Sign Up</a>";
				echo "<a class='nav-button right-float' href='login.php'>Login</a>";
			echo "</div>";
		}
		else {
			echo "<h2 class='center small-caps'>you are logged in</h2>";
		}
		?>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>
</html>