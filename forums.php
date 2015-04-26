<?php include '_header.php'; ?>

<div class="container">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<h1>Forums<br><small>Talk to Each Other!</small></h1>
	</div>
	<hr>
</div>
<?php 

include '_helpers.php';

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
// we need to pull posts from database to fill this page, 
try {
//open the database
$db = new PDO("mysql:dbname=soundpod", 'root');
// Set errormode to exceptions
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db -> query("SELECT * from category where name = '$category'");


if($result->rowCount() < 1)
{
	//404 if that wasn't a real category
	// header("Location: /404.php");
	// die();
	print "Sorry, there's nothing here";
	echo "<a href='/forumTopics.php'>Forums</a>";
}



//We have to do the redirection above before any <!doctype stuff happens
include '_header.php'; 



?>



<hr>
<div class="container">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
<div class="well col-xs-4 col-sm-4 col-md-4 col-lg-4">
<?php
	
$result = $db -> query("SELECT * from posts where category == ".$category);
foreach ($result as $thisPost)
{
	$content = $thisPost['content'];
	$email = $thisPost['email'];
	$user = $db -> query("SELECT * from user where email == ".$email);
	?>
	<p class='text-left'> <?php echo $content ?> </p>;
	<p class='text-left'>By <?php echo $user['name'] ?></p>;
	<p class='text-left'>Posted at <?php echo $thisPost['time'] ?> to <?php echo $category ?></p>;
	<?php
}
		// close the db
	$db = NULL;	
	?>

		</div>
		<div class="well col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<?php
		$result = $db -> query("SELECT * from post where category == '$category['name']'");
		foreach ($result as $tuple)
		{
			$content = $tuple['content'];
			$email = $tuple['email'];
			$user = $db -> query("SELECT * from user where email == '$email'");
			echo "<p class='text-left'>" . $content . "</p>";
			echo "<p class='text-left'>By " . $user['name'] . "</p>";
			echo "<p class='text-left'>Posted at " . $tuple['time'] . " to " . $category . "</p>";

		}
		// close the db
		$db = NULL;	
		echo "</div> </div>";
	}
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

include '_footer.php'; ?>
