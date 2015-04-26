<?php include '_header.php'; ?>


<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<form action="" method="POST" role="form">
		<legend>Add Your Show</legend>



		<div class="form-group">
			<label for="">Is your show an hour or two hours a week?</label>

			<label class="radio-inline"><input type="radio" name="show" id="oneHour" value="1">One</label>
			<label class="radio-inline"><input type="radio" name="show" id="twoHour" value="2">Two</label>

		</div>

		<div class="form-group">
			<label for="">What is the name of your show?</label>
			<input type="text" name="name" class="form-control">
		</div>

		<div class="form-group">
			<label for="">Genre?</label>

			<label class="radio-inline"><input type="radio" name="genre" value="alt">Alternative</label>
			<label class="radio-inline"><input type="radio" name="genre" value="hip">Hip Hop</label>
			<label class="radio-inline"><input type="radio" name="genre" value="loud">Loud Rock</label>
			<label class="radio-inline"><input type="radio" name="genre" value="ele">Electronic</label>
			<label class="radio-inline"><input type="radio" name="genre" value="spe">Specialty</label>
		
		</div>

		<div class='input-group date' >
			<label for="password">Show Time</label>
	        <input type='text' class="form-control" id="datetimepicker1"/>
		</div>

		<div id="extraHour" class='input-group date' >
			<label for="password">Show Time</label>
	        <input type='text' class="form-control" id="datetimepicker2"/>
		</div>



		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#extraHour').hide();
	});

	$('#oneHour').click(function(){
		$('#extraHour').hide();
	});

	$(function () {
	    $('#datetimepicker1').datetimepicker();
	});
	$(function () {
	    $('#datetimepicker2').datetimepicker();
	});

	$('#twoHour').click(function(){
		$('#extraHour').show();
	});

</script>

<?php include '_footer.php'; ?>