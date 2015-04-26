<?php include '_header.php'; include '_helpers.php';
$nameErr;

if(is_admin())
{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["topic"])) {
  		$nameErr = "Forum name is required";
  	} 
	else{
  		try {
	 	$db = new PDO("mysql:dbname=soundpod", 'root');
	 	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$sql = "INSERT INTO category VALUES ('$topic')";
	 	// insert
	 	$db -> exec($sql);
	 	// disconnect
		$db = NULL;
	}
	catch(PDOException $e) {
	 	print 'Exception : '.$e -> getMessage();
	}
	}
}

}
try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(is_admin())
	{
		?>
		<form id="data-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
    	<legend>Add a topic</legend>
    	
    	<div class="form-group">
    		<label for="name">Topic</label>
    		<input type="text" placeholder="Topic" class="form-control" name="topic" ><span class="input-error"> <?php echo $nameErr;?></span>
    	</div>
    	<?php
    
	}




	$categories = $db -> query("SELECT DISTINCT name From category");
	foreach($categories as $category)
	{
	?>
		<div class="container">
		<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a href="/forums.php?category=<?php echo $category ?>"><h4><?php echo $category ?></h4></a>;
			
		
<?php
}catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

<<<<<<< HEAD
include '_footer.php';


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
?>