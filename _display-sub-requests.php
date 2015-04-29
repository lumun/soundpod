<?php
echo "<div class='well'>";
//$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active=1) AS rqs NATURAL JOIN radioShow");
$subRequests = $db -> query ("SELECT * FROM (SELECT * FROM subRequest WHERE active='1') AS rqs NATURAL JOIN radioShow");
if($subRequests->rowCount() < 1){
	print "There are no active sub requests";
}
else {
	?>
	<legend>Substitution Requests: Help Someone Out!</legend>
	<table class="table table-bordered table-striped" border="1">
	<tbody align="center">
	<tr><th>Show Title</th><th>Genre</th><th>Showtime(s)</th><th>DJ</th><!-- <th>Subbing DJ</th> --><th></th></tr>
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

		// $subdjs = $db -> query ("SELECT * FROM user WHERE email='$subdj'");
		// $thesubdj = $subdjs -> fetch();
		// echo "<td>".$thesubdj['name']."</td>";

		// echo "<td>".$comment."</td>";
		// if($active == 0)
		// 	echo "<td> Subbed! </td>";
		// if($active == 1)
		// 	echo "<td> I need a sub! </td>";
		//I changed it from binary to text for humans
		//echo "<td>".$active."</td>";

		// This is where you select
		if ($active == 1) {
			if ($_SESSION['email'] == $origdj) {
				echo "<td>/</td>";
			}
			else {
				echo "<td><form id='sub_accept_$showid' method='post' action='/_acceptSub.php'>";
				echo "<input type='hidden' name='showid' value='$showid'/>";
				echo "<input type='hidden' name='month' value='$month'/>";
				echo "<input type='hidden' name='day' value='$day'/>";
				echo "<input class='btn btn-primary' type='submit' name='submit_$showid' value='Sub this Show' /></form></td>";
			}
		}

		echo "</tr>";
	}
	echo "</table>";
	echo "</tbody>";
}
echo "</div>";
?>