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
		echo '<tr><td>ID</td><td>Name</td><td>Password</td><td>Username</td><td>Admin?</td></tr>';
		$result = $db -> query ("SELECT * FROM user");
		foreach ($result as $tuple)
		{
			echo "<tr><td>".$tuple['uid']."</td>";
			echo "<td>".$tuple['name']."</td>";
			echo "<td>".$tuple['password']."</td>";
			echo "<td>".$tuple['email']."</td>";
			echo "<td>".$tuple['admin']."</td>";
			echo "</tr>";
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
