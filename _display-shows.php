<?php
include '_helpers.php';

echo "<div class='content left-float'>";
	try 
	{
		//open the database
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//now output the data to a simple html table...
		echo '<table  border="1">';
		echo '<tbody align="center">';
		echo '<tr><th>Title</th><th>Genre</th><th>DJ(s)</th><th>Showtime(s)</th><th></th></tr>';
		$shows = $db -> query ("SELECT * FROM radioShow ORDER BY genre, showid");
		foreach ($shows as $show)
		{
			$showid = $show['showid'];
			$title = $show['title'];
			// get_genre method found in helpers
			$genre = get_genre($show['genre']);
			//echo "<tr><td>".$showid."</td>";//we don't need to show users the show ID
			echo "<td>  ".$title."  </td>";
			echo "<td>  ".$genre."  </td>";

			$djs = $db -> query ("SELECT * FROM user NATURAL JOIN dj WHERE showid=$showid ORDER BY name");
			echo "<td>  ";
			foreach ($djs as $dj) {
				$n = $dj['name'];
				echo "$n<br />";
			}
			echo "  </td>";

			$showtimes = $db -> query ("SELECT * FROM showInstance WHERE showid=$showid");
			echo "<td>  ";
			foreach ($showtimes as $showtime) {
				$day = get_weekday($showtime['weekday']);
				$time = $showtime['time'];
				echo $day."s at ";
				echo $time;
				echo "<br />";
			}
			echo "  </td>";

			if ($isAdmin) {
				// This is all the delete button
				echo "<td><form id='delete_form_$showid' method='post' action='/_delete-show.php'>";
				echo "<input type='hidden' name='showid' value='$showid' />";
				echo "<input type='submit' name='submit_$showid' value='Delete' /></form></td>";
			}

			echo "</tr>";
		}
		echo '</tbody>';
		echo "</table>";

		echo "<a href='/add-show.php'>Add a new show</a>";

	 	// close the database connection
		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
?>