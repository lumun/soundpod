<div class="well">
	<legend>All Shows</legend>
	<table class="table table-bordered table-striped" border="1">
	<tbody align="center">
	<tr><th>Title</th><th>Genre</th><th>DJ(s)</th><th>Showtime(s)</th>
	<?php if ($isAdmin) {
		echo "<th></th>"; }
	echo "</tr>";
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
			echo "<input type='submit' class='btn btn-md btn-primary' name='submit_$showid' value='Delete' /></form></td>";
		}

		echo "</tr>";
	}
	?>
	</tbody>
	</table>
</div>