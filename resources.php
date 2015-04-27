<?php 
include '_session.php';
include '_header.php'; 
if (!$loggedin) { 
	header("Location: /login.php"); 
	die(); 
}
?>


<div class="container">
	<h1>Get all the Resources you need here!</h1>
	<p>
		<a class="btn btn-primary">Handbook</a>
	</p>
</div>


<div class="container">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/air.jpg" class="center-block img-responsive" alt="Image">
		<h3 class="text-center">Upcoming Events</h3>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/kids.jpg" class="center-block img-responsive" alt="Image">
		<h3 class="text-center">Quick Tips</h3>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<img src="/assets/images/tom.jpg" class="center-block img-responsive" alt="Image">
		<h3 class="text-center">Contact</h3>
	</div>
</div>