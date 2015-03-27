<div class="content left-float">
	<?php
		try 
		{
			//open the database
			$db = new PDO('sqlite:database/airport.sqlite3');
			// Set errormode to exceptions
			$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//now output the data to a simple html table...
			echo '<table border="1">';
			echo '<tr><td>SSN</td><td>First Name</td><td>Middle Name</td><td>Last Name</td></tr>';
			$result = $db -> query ("SELECT * FROM passengers");
			foreach ($result as $tuple)
			{
				echo "<tr>";
				echo "<td>".$tuple['ssn']."</td>";
				echo "<td>".$tuple['f_name']."</td>";
				echo "<td>".$tuple['m_name']."</td>";
				echo "<td>".$tuple['l_name']."</td>";
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