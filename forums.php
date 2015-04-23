<?php include '_header.php'; ?>

<div class="container">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<h1>Forums<br><small>Talk to Each Other!</small></h1>
	</div>
	<hr>
</div>
<?php 
// we need to pull posts from database to fill this page, 
try
{
$db = new PDO('mysql:database/kups.mysql')//TODO: we need to put the mysql db stuff in here

$categories = $db -> query("SELECT DISTINCT category From post");
foreach($categories as $category)
{
	?>
	<div class="container">
	<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a href=""><h4>Station Discussion</h4></a>
		<p class="text-left">What is happening in KUPS? Have your say!</p>
	</div>';
<div class="well col-xs-4 col-sm-4 col-md-4 col-lg-4">
<?php
	$result = $db -> query("SELECT * from post where category == ".$category);
	foreach ($result as $tuple)
	{
		$content = $tuple['content'];
		$uid = $tuple['uid'];
		$user = $db -> query("SELECT * from user where uid == ". $uid);
		echo '<p class="text-left">'.$content.' </p>';
		echo '<p class="text-left">By' .$user['name'].' </p>';
		echo '<p class="text-left">Posted at ' .$tuple['time'].' to '.$category'</p>';

	}
?>
</div> </div>
}

<?php
}catch(PDOException $e)
{
	print 'Exception : '.$e -> getMessage();
}
?>

<?php include '_footer.php'; ?>