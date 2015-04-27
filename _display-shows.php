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
		echo '<tr><td>ID</td><td>Title</td><td>Genre</td><td>Person</td><td></td></tr>';
		$shows = $db -> query ("SELECT * FROM radioShow");
		foreach ($shows as $show)
		{
			$id = $show['showid'];
			$title = $show['title'];
			$genre = $show['genre'];
			echo "<tr><td>".$id."</td>";
			echo "<td>".$title."</td>";
			echo "<td>".$genre."</td>";
			$djs = $db -> query ("SELECT * FROM user NATURAL JOIN dj WHERE showid=$id");
			echo "<td>";
			foreach ($djs as $dj) {
				$n = $dj['name'];
				echo "<p>$n</p>";
			}
			echo "</td></tr>";
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