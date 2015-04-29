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
		//open the databas
		$db = new PDO("mysql:dbname=soundpod", 'root');
		// Set errormode to exceptions
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<legend>Your Shows</legend>";
		//now output the data to a simple html table...
		if (isset($_SESSION['email'])) { $myemail = $_SESSION['email']; }
		$shows = $db -> query ("SELECT * FROM radioShow NATURAL JOIN dj WHERE email='$myemail'");

		if($shows->rowCount() < 1)
		{
			?>
			<p>You don't have a show in the schedule :(  ...maybe you should make one? <a href="/add-show.php"> Click Here for show creation</a></p>
			<?php
		}
		else{
			echo '<table class="table table-bordered" border="1">';
			echo '<tr><th>Show Title</th><th>Genre</th><th>Show Time(s)</th><th></th></tr>';
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
					echo "<br />";
				}
				echo "</td>";

				echo "<td><form id='sub_request_$showid' method='post' action='/requestSub.php'>";
				echo "<input type='hidden' name='showid' value='$showid' />";
				echo "<input type='submit' name='submit_$showid' value='Request Sub' /></form></td>";

				echo "</tr>";
			}
			echo "</table>";
		}
		echo "<br /><br /><br /><br />";
 
		//$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active=1) AS rqs NATURAL JOIN radioShow");
		$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest) AS rqs NATURAL JOIN radioShow");
		if($subRequests->rowCount() < 1){
			print "There are zero active subRequests...";
		}
		else {
			?>
			<h2>Sub Requests! Help someone out!</h2>
			<table class="table table-bordered" border="1">
				<tbody align="center">
			<tr><th>Show Title</th><th>Genre</th><th>Show Time(s)</th><th>Posting DJ</th><th>Subbing DJ</th><th>Active</th><th></th></tr>
			<?php
			foreach ($subRequests as $sub) {
				$showid = $sub['showid'];
				$title = $sub['title'];
				// get_genre method found in helpers
				$genre = get_genre($sub['genre']);
				$weekday = get_weekday($sub['weekday']);
				$time = $sub['time'];
				$month = $sub['month'];
				$day = $sub['day'];
				$comment = $sub['comment'];
				$active = $sub['active'];
				$origdj = $sub['origdj'];
				$subdj = $sub['subdj'];

				echo "<td>".$title."</td>";
				echo "<td>".$genre."</td>";
				echo "<td>$weekday, $month $day, $time</td>";

				$origdjs = $db -> query ("SELECT * FROM user WHERE email='$origdj'");
				$theorigdj = $origdjs -> fetch();
				echo "<td>".$theorigdj['name']."</td>";

				$subdjs = $db -> query ("SELECT * FROM user WHERE email='$subdj'");
				$thesubdj = $subdjs -> fetch();
				echo "<td>".$thesubdj['name']."</td>";

				// echo "<td>".$comment."</td>";
				if($active == 0)
					echo "<td> Subbed! </td>";
				if($active == 1)
					echo "<td> I need a sub! </td>";
				//I changed it from binary to text for humans
				//echo "<td>".$active."</td>";

				// This is where you select
				if ($active == 1) {
					echo "<td><form id='sub_accept_$showid' method='post' action='/_acceptSub.php'>";
					echo "<input type='hidden' name='showid' value='$showid'/>";
					echo "<input type='hidden' name='month' value='$month'/>";
					echo "<input type='hidden' name='day' value='$day'/>";
					echo "<input type='submit' name='submit_$showid' value='Sub this Show' /></form></td>";
				}

				echo "</tr>";
			}
			echo "</table>";
			echo "</tbody>";
		}

		$db = NULL;
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
echo "</div>";
?>