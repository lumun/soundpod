<?php
echo "<div class='content left-float'>";
	try 
	{
		//open the database
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//now output the data to a simple html table...
		echo '<table border="1">';
		echo '<tr><td>ID</td><td>Title</td><td>Genre</td><td></td><td></td></tr>';
		$result = $db -> query ("SELECT * FROM radioShow");
		foreach ($result as $tuple)
		{
			$id = $tuple['showid'];
			$title = $tuple['title'];
			$genre = $tuple['genre'];
			echo "<tr><td>".$id."</td>";
			echo "<td>".$title."</td>";
			echo "<td>".$genre."</td></tr>";
		}
		echo "</table>";

	 	// close the database connection
		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
?>