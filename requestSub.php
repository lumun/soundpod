<?php 
include '_session.php';
include '_header.php';
include '_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['showid'])) {
	$showid = $_POST['showid'];
}

?>

<div class="container">
	<span class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></span>
	<br>
	<br>

	<div class="well col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<form action="/_requestSub.php" method="POST" role="form">
			<legend>When Do You Need A Sub?</legend>

	    	<div class='input-group date' >
	    		<label for="password">Show Time</label>
                <input type='text' name="date" class="form-control" id="datetimepicker1"/>
	    	</div>
	    	<br>
	    	<br>
	    	<input type='hidden' name='showid' value='<?php echo $showid ?>' />
			<button type="submit" class="text-center btn btn-primary">Submit</button>
		</form>	
	</div>
	

</div>

<?php
// $getShowDayAndHours = get_show_day_and_hours($showid);
// $disabledDaysOfWeek = $getShowDayAndHours[0];
// $disabledHours = $getShowDayAndHours[1];
// $enabledHours = $getShowDayAndHours[2];
?>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({format: "ddd, MMMM Do, hA"});
        // $('#datetimepicker1').datetimepicker({format: "ddd, MMMM Do, hA", disabledHours:"<?php echo json_encode($disabledHours) ?>", enabledHours:"<?php echo json_encode($enabledHours) ?>", daysOfWeekDisabled:"<?php echo json_encode($disabledDaysOfWeek) ?>", });
    });

</script>