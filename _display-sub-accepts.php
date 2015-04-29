<?php
echo "<div class='well well-important'>";
$email = $_SESSION['email'];
//$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active=1) AS rqs NATURAL JOIN radioShow");
$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active='0' AND subdj='$email') AS rqs NATURAL JOIN radioShow");
if($subRequests->rowCount() < 1){
	echo "<br />";
}
else {
	?>
	<legend>Your Scheduled Substitutions</legend>
	<table class="table table-bordered table-hover" border="1">
	<tbody align="center">
	<tr><th>Show Title</th><th>Genre</th><th>Showtime(s)</th><th>Posting DJ</th><th></th></tr>
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
		echo "<td><a href='mailto:".$origdj."' target='_blank'>".$theorigdj['name']."</a></td>";

		// This is where you reject
		echo "<td><form id='sub_reject_$showid' method='post' action='/_rejectSub.php'>";
		echo "<input type='hidden' name='showid' value='$showid'/>";
		echo "<input type='hidden' name='month' value='$month'/>";
		echo "<input type='hidden' name='day' value='$day'/>";
		echo "<input class='btn btn-primary' type='submit' name='submit_$showid' value='Revoke' /></form></td></tr>";
	}
	echo "</table>";
	echo "</tbody>";
}
echo "</div>";
?>