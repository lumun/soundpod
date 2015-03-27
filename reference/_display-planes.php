<?php
echo "<div class='content left-float'>";
	try 
	{
		//open the database
		$db = new PDO('sqlite:database/airport.sqlite3');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//now output the data to a simple html table...
		echo '<table border="1">';
		echo '<tr><td>Tail No.</td><td>Make</td><td>Model</td><td>Capacity</td><td>Speed (MPH)</td><td></td><td></td></tr>';
		$result = $db -> query ("SELECT * FROM plane");
		foreach ($result as $tuple)
		{
			$tail_no = $tuple['tail_no'];
			echo "<tr><td>".$tail_no."</td>";
			echo "<td>".$tuple['make']."</td>";
			echo "<td>".$tuple['model']."</td>";
			echo "<td>".$tuple['capacity']."</td>";
			echo "<td>".$tuple['mph']."</td>";
			echo "<td><form id='update_form_$tail_no' method='get' action='/update-plane.php'>";
			echo "<input type='hidden' name='tail_no' value='$tail_no' />";
			echo "<input type='submit' name='submit_$tail_no' value='Update' />";
			echo "</form></td>";
			// echo "<td><a href='update-plane?tail_no='$tail_no''>Update</a></td>";
			echo "<td><form id='delete_form_$tail_no' method='post' action='/_delete-plane.php'>";
			echo "<input type='hidden' name='tail_no' value='$tail_no' />";
			echo "<input type='submit' name='submit_$tail_no' value='Delete' />";
			echo "</form></td>";
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