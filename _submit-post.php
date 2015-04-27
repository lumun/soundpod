<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_SESSION['email'];
	$content = $_POST['content'];
	$category = $_POST['category'];
	$sql = "INSERT INTO post(email,content,category) values('$email','$content','$category')";
	echo $sql;
	try{
	$db = new PDO("mysql:dbname=soundpod", 'root');
	// Set errormode to exceptions
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