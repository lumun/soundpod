<?php 
include '_session.php';
include '_helpers.php';

if (!$loggedin) {
	header('Location: /login.php');
	die();
}

// $category = getCurrentUri();
$category = '';
if (isset($_GET['category'])) {
	$category = $_GET['category'];
}

if(trim($category) == '')//I might use this to make sure there is no
{
	//if they don't have any extra url send them to forum topics list
	header("Location: /forumTopics.php");
	die();
}
try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$cat = $db->quote($category);
	$result = $db -> query("SELECT * from category where name = $cat");
	$cat = stripslashes($cat);

	include '_header.php'; 
	if($result->rowCount() < 1)
	{
		//404 if that wasn't a real category
		// header("Location: /404.php");
		// die();
		//print "Sory, there's nothing here";
		echo "<p>Sorry, there's nothing here. Click <a href='/forumTopics.php'>here</a> to go to the forums</p>";
	}
	else{ ?>
		<div class="container">
			<div class="row">
			<span class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></span> 
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h1><a class="text-center" href="/forumTopics.php"><?php echo $category; ?> Forums</a></h1>
				</div>
			<span class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></span> 
			</div>
			
		</div>

		<div class="container">

				
		
		<?php
		$cat = $db->quote($category);
		$result = $db -> query("SELECT * from post where category = $cat ORDER BY time");
		if($result->rowCount() < 1){
			print "There aren't any posts here yet. Add one above!";
		}
		else {
			foreach ($result as $thisPost)
			{
				$content = $thisPost['content'];
				$email = $thisPost['email'];
				$timestamp = $thisPost['time'];
				$users = $db -> query("SELECT * from user where email = '$email'");
				$user = $users->fetch();
				?>
				<div class="row">
					<span class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></span>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<h4 class='text-left'> <?php echo $content ?> </h4>
							<p class='text-right'>By <?php echo $user['name'] ?></p>
							<p class='text-right'>Posted <?php date_default_timezone_set('UTC'); echo date("F j, g:i:s A", strtotime($timestamp)); ?></p>

						</div>
					<span class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></span>	
				</div>
				<?php
			}
		}
		// close the db
		$db = NULL;	
	}
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

?>
<!-- end container -->
</div>

<div class="container">
	<div class="row">
		<span class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></span>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<form id="data-input" action="/_submit-post.php" method="POST" role="form">
			<div class="form-group">
				<input type="text" class="form-control" name="content" placeholder="Post here" width = "100px" height = "100px" >
			</div>
			<input type="hidden" name="categoryClean" value="<?php echo $cat; ?>" class="form-control">
			<input type="hidden" name="category" value="<?php echo $category; ?>" class="form-control">
			<button  type="submit" class="text-center btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
