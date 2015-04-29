<?php 
include '_session.php';
include '_helpers.php';
include '_header.php'; 
$nameErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["topic"])) {
  		$nameErr = "Forum name is required";
  	} 
	else{
		$rawtopic = $_POST['topic'];
  		try {
	 	$db = new PDO("mysql:dbname=soundpod", 'root');
	 	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$topic = $db->quote($rawtopic);
	 	$sql = $db -> prepare("INSERT INTO category(name) VALUES ($topic)");
		// insert
		$sql->execute();
	 	// disconnect
		$db = NULL;

		?>
		<br />
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> You added a new forum topic: <?php echo htmlspecialchars_decode($_POST["topic"]) ?>. <a href="/forums.php?category=<?php echo $rawtopic ?>">Click here</a> to add your first post.</p>
		</div>
		<?php
		}
		catch(PDOException $e) {
		 	print 'Exception : '.$e -> getMessage();
		}
	}
}

if($isAdmin)
{
	?>
	<br />
	<div class='col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6'>
		<div class='well well-add'>
			<form id="data-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
				<p>Admins, please only add a new topic if you're sure it's needed</p>
				<div class="form-group">
					<input type="text" placeholder="Topic" class="form-control" name="topic" >
				</div>
				<button  type="submit" class="btn btn-primary">Add New Topic</button>
			</form>
		</div>
	</div>
	<?php
}

try {
	//open the database
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$categories = $db -> query("SELECT DISTINCT name From category ORDER BY name");
	?>
	
	<div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
		<h1 class='text-center' style='margin-top:10px'>DJ Forum</h1>
		<div class='well'>
			<?php
			foreach($categories as $category) {
				$cName = $category['name']; 
				?>
				<!-- <div class="container">
				<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
				<a class="text-center" href="/forums.php?category=<?php echo htmlspecialchars($cName) ?>"><h2 ><?php echo stripslashes($cName) ?></h2 class="text-center"></a>
				<?php 	
				$cName = $db->quote($cName);
				$posts = $db -> query("SELECT count(*) AS 'num' FROM post WHERE category=$cName");
				$pNum = $posts -> fetch();
				$n = $pNum['num'];
				echo "<p class='text-center'>";
				echo $n;
				echo " post";
				if ($n != 1) { echo "s"; }
				echo "</p>";
			} ?>
			</div>
		</div>
	</div>
<?php }
catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
}

include '_footer.php'; ?>