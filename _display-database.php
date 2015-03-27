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
		echo '<tr><td>SSN</td><td>Name</td><td>Seat</td><td>Departure</td><td>Arrival</td></tr>';
		$result = $db -> query ("SELECT * FROM passengers NATURAL JOIN onboard NATURAL JOIN flight");
		foreach ($result as $tuple)
		{
			$ssn = $tuple['ssn'];
			echo "<tr><td>".$ssn."</td>";
			echo "<td>".$tuple['f_name']." ".$tuple['l_name']."</td>";
			echo "<td>".$tuple['seat']."</td>";
			echo "<td>".$tuple['dep_loc']." ".$tuple['dep_time']."</td>";
			echo "<td>".$tuple['arr_loc']." ".$tuple['arr_time']."</td>";
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