<!DOCTYPE html>
<html>

<head>
	<title>KUPS DJ Portal</title>
	<link rel="shortcut icon" href="/assets/images/kups.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="assets/js/datepicker.js"></script>
	<!-- kups stuff -->
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
		<link rel="stylesheet" href="/assets/stylesheets/datepicker.css">
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-id">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		    </button>
		    <a href="<?php if ($loggedin) { echo '/index.php'; } else { echo '/index.php'; } ?>" style="float:left">
				<img src="/assets/images/kups.png" alt="DJ Portal" style="height:40px;margin:5px;float:left">
			</a>
		    <a class="navbar-brand" href="<?php if ($loggedin) { echo '/index.php'; } else { echo '/index.php'; } ?>">
		      	<p> KUPS DJ Portal</p>
			</a>
	    </div>
	    <div class="collapse navbar-collapse" id="navbar-collapse-id">
	      <ul class="nav navbar-nav">
	      	<?php if ($loggedin) { ?>
		        <li><a href="/forums.php">Forums</a></li>
		        <?php if ($isAdmin) { ?>
	            	<li><a href="/manage-shows.php">Manage Shows</a></li>
	            <?php } else { ?>
	            	<li><a href="/manage-shows.php">Shows</a></li>
	            <?php } ?>
	        	<?php if ($isAdmin) { ?>
	            	<li><a href="/manage-users.php">Manage Users</a></li>
	            <?php } ?>
		        <li><a href="/substitutions.php">Sub Requests</a></li>
		        <li><a href="/resources.php">Resources</a></li>
		    <?php } ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<?php if ($loggedin) { ?>
	        	<li><a href="/_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	        <?php } else { ?> 
	        	<li><a href="/sign-up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	        	<li><a href="/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        <?php } ?>
	      </ul>
	    </div>
	  </div>
	</nav>

<!-- because of the carousel on the index page, we want slighly different css on the container -->
<div <?php if(htmlspecialchars($_SERVER['PHP_SELF']) != '/index.php') { echo "class='container-fluid'"; } else { echo "class='container-fluid container-fluid-index'"; } ?> >


<!-- container div closed in footer -->