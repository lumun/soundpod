<?php 
include '_session.php';
include '_header.php'; ?>

<div class="container">
	<span class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></span>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<br />
		<div class="well">
			<form action="/_add-show.php" method="POST" role="form">
				<legend>Add Your Show</legend>

				<div class="form-group">
					<label>Is your show an hour or two hours a week?</label>

					<br /><label class="radio-inline"><input type="radio" name="show" id="oneHour" value="1">One</label>
					<br /><label class="radio-inline"><input type="radio" name="show" id="twoHour" value="2">Two</label>
				</div>

				<div class="form-group">
					<label>What is the name of your show?</label>
					<input type="text" name="name" class="form-control">
				</div>

				<div class="form-group">
					<label>Genre?</label>

					<br /><label class="radio-inline"><input type="radio" name="genre" value="alt">Alternative</label>
					<br /><label class="radio-inline"><input type="radio" name="genre" value="hip">Hip Hop</label>
					<br /><label class="radio-inline"><input type="radio" name="genre" value="loud">Loud Rock</label>
					<br /><label class="radio-inline"><input type="radio" name="genre" value="ele">Electronic</label>
					<br /><label class="radio-inline"><input type="radio" name="genre" value="spe">Specialty</label>
				</div>

				<div class='input-group date' >
					<label>Show Time</label>
					<p>Please select the date and time of your first scheduled show.</p>
			        <input type='text' name="show1" class="form-control" id="datetimepicker1"/>
				</div>

				<div id="extraHour" class='input-group date' >
					<br />
					<label>Show Time</label>
			        <input type='text' name="show2" class="form-control" id="datetimepicker2"/>
				</div>
				<br>
				<button type="submit" class="text-center btn btn-primary">Add Show</button>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#extraHour').hide();
	});

	$('#oneHour').click(function(){
		$('#extraHour').hide();
	});

	$(function () {
	    $('#datetimepicker1').datetimepicker({
	    	format: "ddd, hA" 
	    });
	});
	
	$(function () {
	    $('#datetimepicker2').datetimepicker({format: "ddd, hA" });
	});

	$('#twoHour').click(function(){
		$('#extraHour').show();
	});
</script>
