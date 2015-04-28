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

?>