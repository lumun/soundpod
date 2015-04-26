
<?php 
include '_helpers.php';
$category = getCurrentUri();
// we need to pull posts from database to fill this page, 
try {
//open the database
$db = new PDO("mysql:dbname=soundpod", 'root');
// Set errormode to exceptions
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db -> query("SELECT * from category where name == ".$category);

if(trim($category) == '')//I might use this to make sure there is no
{
	//if they don't have any extra url send them to forum topics list
	header("Location: /forumTopics.php");
	die();
}
if($result.rowCount() < 1)
{
	//404 if that wasn't a real category
	header("Location: /404.php");
	die();
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
		<a href = "/forumTopics.php">Back to Forum Topics</a>
	<?php
	
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}


<<<<<<< HEAD


include '_footer.php'; ?>
=======
function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}
>>>>>>> b9e2b090bb0fe8d3d9a0a8141259223cd0f8fd57
