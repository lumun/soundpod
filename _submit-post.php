<?php
include '_session.php';
//session_start();
//session_regenerate_id(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_SESSION['email'];
	$content = $_POST['content'];

	$category = $_POST['category'];
	try{
	$db = new PDO("mysql:dbname=soundpod", 'root');
	$content = $db->quote($content);
	$category = $db->quote($category);
	$sql = "INSERT INTO post(email,content,category) values('$email',$content,$category)";
	// Set errormode to exceptionsgi
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec($sql);
	$db=null;
	}catch(PDOException $e) {
	print 'Exception : '.$e -> getMessage();
	}
}

header("Location: /forums.php?category=$category");
die();

?>