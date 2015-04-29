<?php
echo "<div class='well'>";
echo "<legend>Your Shows  <p style='display:inline'><a class='btn btn-sm' href='/add-show.php' role='button'>Add a Show</a></p></legend>";
//now output the data to a simple html table...
if (isset($_SESSION['email'])) { $myemail = $_SESSION['email']; }
$shows = $db -> query ("SELECT * FROM radioShow NATURAL JOIN dj WHERE email='$myemail'");

if($shows->rowCount() < 1)
{
	?>
	<p>You don't have a show in the schedule.<a href="/add-show.php"> Click here to add a show</a></p>
	<?php
}
else{
	echo '<table class="table table-bordered table-striped" border="1">';
	echo "<tbody align='center'>";
	echo '<tr><th>Show Title</th><th>Genre</th><th>Showtime(s)</th><th></th></tr>';
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
			echo get_weekday($day)."s at ";
			echo $time;
			echo "<br />";
		}
		echo "</td>";

		echo "<td><form id='sub_request_$showid' method='post' action='/requestSub.php'>";
		echo "<input type='hidden' name='showid' value='$showid' />";
		echo "<input type='submit' class='btn btn-md btn-primary' name='submit_$showid' value='Request Sub' /></form></td>";

		echo "</tr>";
	}
	echo "</tbody></table>";
}
echo "</div>";
?>