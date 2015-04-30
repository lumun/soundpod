<?php 

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath)+12);
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		//$uri = '/' . trim($uri, '/');
		return $uri;
	}

function get_genre($shortform) {
	if ($shortform == 'alt') {
		return "Alternative";
	}
	else if ($shortform == 'hip') {
		return "Hip Hop";
	}
	else if ($shortform == 'loud') {
		return "Loud Rock";
	}
	else if ($shortform == 'ele') {
		return "Electronic";
	}
	else if ($shortform == 'spe') {
		return "Specialty";
	}
	else {
		return "N/A";
	}
}

function get_weekday($shortform) {
	if ($shortform == 'Mon') {
		return "Monday";
	}
	else if ($shortform == 'Tue') {
		return "Tuesday";
	}
	else if ($shortform == 'Wed') {
		return "Wednesday";
	}
	else if ($shortform == 'Thu') {
		return "Thursday";
	}
	else if ($shortform == 'Fri') {
		return "Friday";
	}
	else if ($shortform == 'Sat') {
		return "Saturday";
	}
	else if ($shortform == 'Sun') {
		return "Sunday";
	}
	else {
		return "Unknown";
	}
}

// Must return an array where:
// [0] is disabled days of week '[0,1,3]'
// [1] is disabled hours '[1,2,3,5,6,7,8,9,21,22,23]'
// [2] is enabled hours '[20]'
// function get_show_day_and_hours($showid) {
// 	try {
// 		//open the databas
// 		$db = new PDO("mysql:dbname=soundpod", 'root');
// 		// Set errormode to exceptions
// 		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$shows = $db -> query ("SELECT * FROM showInstance WHERE showid=$showid");
// 		$todaynum = intval(date("w"));

// 		foreach ($shows as $show) {
// 			$weekday = $show['weekday'];
// 			$wdnum = get_weekday_numeral($weekday);
// 			// How long until the next show?
// 			$diff = $wdnum - $todaynum;

// 			if ($diff == 0) {
// 				$soonestdiff = $diff;
// 				$soonestwdnum = $wdnum;
// 				break;
// 			}

// 			if (isset($soonestdiff)) {
// 				if (($soonestdiff > $diff)) {
// 					// This means that the current showtime being looked at is sooner
// 					$soonestdiff = $diff;
// 					$soonestwdnum = $wdnum;
// 				}
// 				else {
// 					// This means the current showtime being looked at is later
// 					// Do nothing
// 				}
// 			}
// 			else {
// 				$soonestdiff = $diff;
// 				$soonestwdnum = $wdnum;
// 			}
// 		}

// 		$db = NULL;
// 		return $soonestwdnum;
// 	}
// 	catch(PDOException $e) {
// 		print 'Exception : '.$e -> getMessage();
// 	}
// }

function get_weekday_numeral($weekday) {
	switch ($weekday) {
	    case 'Sun':
	        return 0;
	        break;
	    case 'Mon':
	        return 1;
	        break;
	    case 'Tue':
	        return 2;
	        break;
	    case 'Wed':
	        return 3;
	        break;
	    case 'Thu':
	        return 4;
	        break;
	    case 'Fri':
	        return 5;
	        break;
	    case 'Sat':
	        return 6;
	        break;
	}
}

function get_weekday_str($wdnum) {
	switch ($wdnum) {
	    case 0:
	        return 'Sun';
	        break;
	    case 1:
	        return 'Mon';
	        break;
	    case 2:
	        return 'Tue';
	        break;
	    case 3:
	        return 'Wed';
	        break;
	    case 4:
	        return 'Thu';
	        break;
	    case 5:
	        return 'Fri';
	        break;
	    case 6:
	        return 'Sat';
	        break;
	}
}

?>