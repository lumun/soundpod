<?php include '_header.php'; include '_helpers.php';
$nameErr;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["topic"])) {
  		$nameErr = "Forum name is required";
  	} else{
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

include '_footer.php';


?>