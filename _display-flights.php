<div class="content left-float">
	<?php
		try 
		{
			//open the database
			$db = new PDO('mysql:database/airport.db');
			// Set errormode to exceptions
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//now output the data to a simple html table...
			echo '<table border="1">';
			echo '<tr><td>Flight No.</td><td>Departure</td><td>Arrival</td><td>Tail No.</td></tr>';
			$result = $db -> query ("SELECT * FROM flight");
			foreach ($result as $tuple)
			{
				echo "<tr>";
				echo "<td>".$tuple['flight_no']."</td>";
				echo "<td>".$tuple['dep_loc']." ".$tuple['dep_time']."</td>";
				echo "<td>".$tuple['arr_loc']." ".$tuple['arr_time']."</td>";
				echo "<td>".$tuple['tail_no']."</td>";
				echo "</tr>";
			}
			echo "</table>";

		 	// close the database connection
			$db = NULL;
		}
		catch(PDOException $e) {
			print 'Exception : '.$e -> getMessage();
		}
	?>
</div>