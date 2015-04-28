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
				$day = $showtime['weekday'];
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

		echo "<br /><br /><br /><br />";
 
		$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active=1) AS rqs NATURAL JOIN radioShow");
		if($subRequests->rowCount() < 1){
			print "There are zero active subRequests...";
		}
		else {
			echo '<table border="1">';
			echo '<tr><td>Show Title</td><td>Genre</td><td>Show Time(s)</td><td>Posting DJ</td><td>Comment</td><td></td></tr>';
			foreach ($subRequests as $sub) {
				$showid = $sub['showid'];
				$title = $sub['title'];
				// get_genre method found in helpers
				$genre = get_genre($sub['genre']);
				$weekday = $sub['weekday'];
				$time = $sub['time'];
				$month = $sub['month'];
				$day = $sub['day'];
				$comment = $sub['comment'];
				$orig = $sub['origdj'];

				echo "<td>".$title."</td>";
				echo "<td>".$genre."</td>";
				echo "<td>$day $month $day at $time</td>";

				$djs = $db -> query ("SELECT * FROM user WHERE email='$orig'");
				$dj = $djs -> fetch();
				echo "<td>".$dj['name']."</td>";
				echo "<td>".$comment."</td>";

				// This is where you select
				echo "<td><form id='sub_accept_$showid' method='post' action='/_acceptSub.php'>";
				echo "<input type='hidden' name='showid' value='$showid'/>";
				echo "<input type='hidden' name='month' value='$month'/>";
				echo "<input type='hidden' name='day' value='$day'/>";

				echo "<input type='submit' name='submit_$showid' value='Sub this Show' /></form></td>";

				echo "</tr>";
			}
			echo "</table>";
		}

		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
?>