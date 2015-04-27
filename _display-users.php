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
		$result = $db -> query ("SELECT * FROM user ORDER BY name");
		foreach ($result as $tuple)
		{
			$email = $tuple['email'];
			echo "<tr><td>".$tuple['name']."</td>";
			echo "<td>".$email."</td>";
			$me = ($email == $_SESSION["email"]);
			$admin = $tuple['admin'];
			if ($admin == 1) {
				echo "<td>Yes</td><td>";
				if (!$me) { echo "<form id='admin_form_$email' method='post' action='/_admin-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' name='submit_$email' value='Unmake' /></form>"; }
				echo "</td>";
			}
			else {
				echo "<td>No</td><td>";
				echo "<form id='admin_form_$email' method='post' action='/_admin-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' name='submit_$email' value='Make Admin' /></form>";
				echo "</td>";		
			}
			echo "<td>";
			if (!$me) { echo "<form id='delete_form_$email' method='post' action='/_delete-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' name='submit_$email' value='Delete' /></form>"; }
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