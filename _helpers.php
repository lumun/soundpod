<?php
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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