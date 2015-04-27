<?php 
include '_session.php';
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
try {
//open the database
$db = new PDO("mysql:dbname=soundpod", 'root');
// Set errormode to exceptions
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$category = $db->quote($category);
$result = $db -> query("SELECT * from category where name = $category");




include '_header.php'; 
if($result->rowCount() < 1)
{
	//404 if that wasn't a real category
	// header("Location: /404.php");
	// die();
	//print "Sory, there's nothing here";
	echo "<p>Sorry, there's nothing here. Click <a href='/forumTopics.php'>here</a> to go to the forumsss</p>";
}
?>



<div class="container">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<h1>Forums<br><small>Talk to Each Other about life in the <?php echo $category; ?> world!</small></h1>
	</div>
	<hr>
</div>


<form id="data-input" action="/_submit-post.php" method="POST" role="form">
<div class="form-group">
	<input type="text" class="form-control" name="content" placeholder="Post here" width = "100px" height = "100px" >
</div>

<input type="hidden" name="category" value="<?php echo $category; ?>" class="form-control">

<button  type="submit" class="btn btn-primary">Submit</button>
</form>


<hr>
<div class="container">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
<div class="well col-xs-8 col-sm-8 col-md-8 col-lg-8">
<?php
	
$result = $db -> query("SELECT * from post where category = $category ORDER BY time");
foreach ($result as $thisPost)
{
	$content = $thisPost['content'];
	$email = $thisPost['email'];
	$users = $db -> query("SELECT * from user where email = '$email'");
	$user = $users->fetch();
	?>
	<p class='text-left'> <?php echo $content ?> </p><br>
	<p class='text-left'>By <?php echo $user['name'] ?></p>
	<p class='text-left'>Posted at <?php echo $thisPost['time'] ?> to <?php echo $category ?></p><br><br>
	<?php
}
		// close the db
	$db = NULL;	
	
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}
