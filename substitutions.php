<?php
include '_session.php';
include '_helpers.php';
if (!$loggedin) { 
	header("Location: /login.php"); 
	die(); 
}

include '_header.php';

echo "<div class='content left-float'>";
	try 
	{
		//open the database
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<legend>Your Shows</legend>";
		//now output the data to a simple html table...
		if (isset($_SESSION['email'])) { $myemail = $_SESSION['email']; }
		$shows = $db -> query ("SELECT * FROM radioShow NATURAL JOIN dj WHERE email='$myemail'");
		echo '<table border="1">';
		echo '<tr><td>Show Title</td><td>Genre</td><td>Show Time(s)</td><td></td></tr>';
		foreach ($shows as $show) {
			$showid = $show['showid'];
			$title = $show['title'];
			// get_genre method found in helpers
			$genre = get_genre($show['genre']);
			echo "<td>".$title."</td>";
			echo "<td>".$genre."</td>";

			$showtimes = $db -> query ("SELECT * FROM showInstance WHERE showid=$showid");
			echo "<td>";
			foreach ($showtimes as $showtime) {
				$day = $showtime['day'];
				$time = $showtime['time'];
				echo $day."s at ";
				echo $time;
			}
			echo "</td>";

			// This is all the delete button
			echo "<td><form id='sub_request_$showid' method='post' action='/requestSub.php'>";
			echo "<input type='hidden' name='showid' value='$showid' />";
			echo "<input type='submit' name='submit_$showid' value='Request Sub' /></form></td>";

			echo "</tr>";
		}
		echo "</table>";

		$subRequests = $db -> query ("SELECT * FROM subRequest WHERE active=1");

		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
?>