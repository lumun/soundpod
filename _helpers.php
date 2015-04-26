<?php
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

<<<<<<< HEAD
// Returns an array with filename as key, filesize as value
function get_files_in_directory($dir) {
	$filesOnServer = array(); // create a new array for filenames
	if (is_dir($dir)) {
		if ($directoryHandle = opendir($dir)) {
			while (($file = readdir($directoryHandle)) !== false) {
				$filetype = filetype($dir . $file);
				$filesize = filesize($dir . $file);
				if ($filetype !== "dir") {
					$filesOnServer[$file] = $filesize;
				}
			}
		closedir($directoryHandle);

		// return files
		return $filesOnServer;
		}
		else {
			return NULL;
		}
	}
	else {
		return NULL;
=======
function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath)+11);
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		//$uri = '/' . trim($uri, '/');
		return $uri;
>>>>>>> f4e4b5d83ec91e89829929e10cb4c4004ad018c1
	}
}

function is_admin() {
	if ($_SESSION["loggedIn"] && $_SESSION["admin"] == 1) {
		return true;
	}
	else {
		return false;
	}
}
?>