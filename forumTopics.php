<?php 
include '_session.php';
include '_helpers.php';
include '_header.php'; 
$nameErr="";

if($_SESSION["admin"] == 1)
{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["topic"])) {
  		$nameErr = "Forum name is required";
  	} 
	else{
		$topic = $_POST['topic'];
  		try {
	 	$db = new PDO("mysql:dbname=soundpod", 'root');
	 	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$topic = $db->quote($topic);
	 	$sql = $db -> prepare("INSERT INTO category(name) VALUES ($topic)");
		// insert
		$sql->execute();
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

	if($isAdmin)
	{
		?>
		<form id="data-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
    	<legend>Add a topic</legend>
    	
    	<div class="form-group">
    		<label for="name">Topic</label>
    		<input type="text" placeholder="Topic" class="form-control" name="topic" >
    	</div>
    	<button  type="submit" class="btn btn-primary">Submit</button>
    </form>
    	<?php
    
	}




	$categories = $db -> query("SELECT DISTINCT name From category");
	
	echo "<div class='jumbotron'>";
		echo "<div class='container'>";
			echo "<h1 class='text-center'>DJ Forum</h1>";
				echo "<hr>";

	foreach($categories as $category) { ?>
<!-- 		<div class="container">
		<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
		<a class="text-center" href="/forums.php?category=<?php echo $category['name'] ?>"><h2 ><?php echo stripslashes($category['name']) ?></h2 class="text-center"></a>	
	<?php

	}
		echo "</div>";
	echo "</div>";
}
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}
?>