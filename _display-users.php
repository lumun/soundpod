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
		echo '<tr><td>Name</td><td>Email</td><td>Admin?</td><td></td><td></td></tr>';
		$result = $db -> query ("SELECT * FROM user");
		foreach ($result as $tuple)
		{
			$email = $tuple['email'];
			echo "<tr><td>".$tuple['name']."</td>";
			echo "<td>".$email."</td>";
			$ad = $tuple['admin'];
			if ($tuple['admin'] == 1) {
				echo "<td>Yes</td>";
				echo "<td><form id='admin_form_$email' method='post' action='/_admin-user.php'>";
				echo "<input type='hidden' name='email' value='$email' />";
				echo "<input type='submit' name='submit_$email' value='Unmake' />";
				echo "</form></td>";
			}
			else {
				echo "<td>No</td>";
				echo "<td><form id='admin_form_$email' method='post' action='/_admin-user.php'>";
				echo "<input type='hidden' name='email' value='$email' />";
				echo "<input type='submit' name='submit_$email' value='Make Admin' />";
				echo "</form></td>";		
			}
			echo "<td><form id='delete_form_$email' method='post' action='/_delete-user.php'>";
			echo "<input type='hidden' name='email' value='$email' />";
			echo "<input type='submit' name='submit_$email' value='Delete' />";
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