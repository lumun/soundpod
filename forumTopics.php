<?php include '_header.php'; ?>

<?php
try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$categories = $db -> query("SELECT DISTINCT category From post");
	foreach($categories as $category)
	{
	?>
		<div class="container">
		<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<?php
			echo '<a href=""><h4>'.$category.' Discussion</h4></a>';
			echo '<p class="text-left">What is happening in '.$category.'? Have your say!</p>';
			?>
				</div>
<?php
}catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

include '_footer.php';

function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}
?>