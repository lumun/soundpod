<?php
echo "<div class='well'>";
	echo '<table class="table table-bordered table-striped" border="1">';
	echo '<tr><th>Name</th><th>Email</th><th>Admin?</th><th></th><th></th></tr>';
	$result = $db -> query ("SELECT * FROM user ORDER BY name");
	foreach ($result as $tuple)
	{
		$email = $tuple['email'];
		echo "<tr><td>".$tuple['name']."</td>";
		echo "<td>".$email."</td>";
		$me = ($email == $_SESSION["email"]);
		$admin = $tuple['admin'];
		if ($admin == 1) {
			echo "<td>Yes</td><td>";
			if (!$me) { 
				echo "<form id='admin_form_$email' method='post' action='/_admin-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' class='btn btn-md btn-primary' name='submit_$email' value='Revoke' /></form>"; 
			} else { echo "That's you!"; }
			echo "</td>";
		}
		else {
			echo "<td>No</td><td>";
			echo "<form id='admin_form_$email' method='post' action='/_admin-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' class='btn btn-md btn-primary' name='submit_$email' value='Make Admin' /></form>";
			echo "</td>";		
		}
		echo "<td>";
		if (!$me) { 
			echo "<form id='delete_form_$email' method='post' action='/_delete-user.php'><input type='hidden' name='email' value='$email' /><input type='submit' class='btn btn-md btn-primary' name='submit_$email' value='Delete' /></form>"; 
		} else { echo "That's you!"; }
		echo "</td></tr>";
	}
	echo "</table>";
echo "</div>";
?>