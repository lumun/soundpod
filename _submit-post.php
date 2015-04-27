<?php
include '_session.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_SESSION['email'];
	$content = $_POST['content'];
	$category = $_POST['category'];
	$cat = $_POST['categoryClean'];
	try{
	$db = new PDO("mysql:dbname=soundpod", 'root');

	$content = $db->quote($content);
	//$cat = $db->quote($cat);
	$sql = "INSERT INTO post(email,content,category) values('$email',$content,$cat)";
	print($sql);
	// Set errormode to exceptionsgi
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec($sql);
	$db=null;
	}catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
	}
}

//header("Location: /forums.php?category=$category");
//die();

?>