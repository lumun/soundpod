<?php
// security and error checking
// define variables and set to empty values
$name = $email  = $password = "";
$emailErr = $usernameErr = $passwordErr = "";

include '_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	if (empty($_POST["name"])) {
  		$nameErr = "Name is required";
  	} 
  	else {
  		$name = clean_input($_POST["name"]);
  		if (!preg_match("/^[a-zA-Z '-]+$/",$name)) {
				$nameErr = "Only letters and white space allowed";
		}
	}
  	if (empty($_POST["email"])) {
  		$emailErr = "Email is required";
  	} else {				
		$email = clean_input($_POST["email"]);

  		if (!preg_match("/^[A-Za-z0-9._%+-]+@(pugetsound\.edu|ups\.edu)$/",$email)) {
				$emailErr = "Required format: username@pugetsound.edu";
		}
	}
  	if (empty($_POST["password"])) {
  		$passwordErr = "Password is required";
  	} 
  	else {
  		$password = clean_input($_POST["password"]);
  		if (!preg_match("/^[\w]+$/",$password)) {
				$passwordErr = "Only valid symbols allowed";
		}
	}
}

// Successful form submission is handled here
if (!empty($name) AND !empty($email) AND !empty($password) AND empty($nameErr) AND empty($emailErr) AND empty($passwordErr)) {
	// Attempt to insert the data
	try {
		//TODO::: fix this line to be relevant to OUR database AND mysql
		$db = new PDO('sqlite:database/airport.sqlite3');
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//everyone starts out as an admin, admins must promote them?
		$sql = "INSERT INTO users VALUES ( ".$name.", 0, ".$password.", ".$email")";
		// insert'
		$db -> exec($sql);
		// disconnect
		$db = NULL;

		//redirect to login page
		header('Location: /login.php');
	}
	catch(PDOException $e) {
		print 'Exception : '.$e -> getMessage();
	}
}

?>
    	<!-- Header inserter here -->
    	<?php include '_header.php'; ?>
<div class="col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-6 col-sm-6 col-md-6 col-lg-6">
    	<form id="data-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
    		<legend>Sign Up</legend>
    	
    		<div class="form-group">
    			<label for="name">First Name</label>
    			<input type="text" placeholder="Name" class="form-control" name="name" value=<?php echo "\"".$name."\"";?>><span class="input-error"> <?php echo $f_nameErr;?></span>
    		</div>
	    	<div class="form-group">
	    		<label for="lname">Last Name</label>
	    		<input type="text" placeholder="Last Name" class="form-control" name="l_name" value=<?php echo "\"".$l_name."\"";?>><span class="input-error" > <?php echo $l_nameErr;?></span>
	    	</div>
	    	<div class="form-group">
	    		<label for="email">Email</label>
	    		<input type="text" class="form-control" name="email" placeholder="you@pugetsound.edu" <?php if (!empty($email)) { echo "value=\"".$email."\""; } ?> ><span class="input-error"> <?php echo $emailErr;?></span>
	    	</div>
	    	<div class="form-group">
	    		<label for="password">Password</label>
	    		<input type="password" class="form-control" name="password" value=<?php echo "\"".$password."\"";?>><span class="input-error" > <?php echo $passwordErr;?></span>
	    	</div>

	    	<div class='input-group date' >
	    		<label for="password">Show Time</label>
                <input type='text' class="form-control" id="datetimepicker1"/>
	    	</div>

	    	<!-- <a id="add"  class="btn btn-primary">Add Show Time</a> -->
    		
    	
    		<button  type="submit" class="btn btn-primary">Submit</button>
    	</form>
	
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

    // $('#add').click(function(){
    // 	// $('#data-input').append("<div class='input-group date' ><label for='password'>Show Time</label><input type='text' class='form-control' id='datetimepicker1'/></div>");
    // })
</script>

    	




