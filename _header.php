<?php 
if (isset($_COOKIE["LoggedIn"])) {
	$loggedIn = true;
}
else {
	$loggedIn = false;
}
?>

<div id="header">
	<a href="<?php if ($loggedIn) { echo '/account.php'; } else { echo '/index.php'; } ?>">
		<p>Sound Pod</p>
		<img src="/assets/images/orca.gif" alt="Sound Pod" class="left-float" style="height:52px">
	</a>
	<?php if ($loggedIn) { ?>
		<a class="nav-button" href="/insert-data.php">Insert Data</a>
		<a class="nav-button" href="/upload.php">File Uploads</a>	
		<a class="nav-button" href="/view-passengers.php">Passengers</a>
		<a class="nav-button" href="/view-planes.php">Planes</a>
		<a class="nav-button" href="/view-flights.php">Flights</a>	
		<!-- <a class="nav-button" href="/view-database.php">Joined Database</a>	 -->

		<!-- Because both these are float: right, the LAST item goes first -->
		<a class="nav-button" id="logout" href="/_logout.php">Logout</a>
		<a class="nav-button" id="my-account" href="/account.php">My Account</a>
	<?php } 
	else { ?>
		<a class="nav-button" id="login" href="/login.php">Login</a>
	<?php } ?>
</div>