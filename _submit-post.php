<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_SESSION['email'];
	$content = $_POST['content'];
	$category = $_POST['category'];
	$sql = "INSERT INTO post(email,content,category) values($email,$content,$category)";

	$db->exec($sql);
	$db=null;
}

//if they don't have any extra url send them to forum topics list
header("Location: /forums.php?category=$category");
die();

?>