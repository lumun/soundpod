<?php include '_header.php'; ?>


<div class="container">
	<div class="center col-lg-offset-3 col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<form action="" method="POST" role="form">
			<legend>When Do You Need A Sub?</legend>
		
	

	    	<div class='input-group date' >
	    		<label for="password">Show Time</label>
                <input type='text' class="form-control" id="datetimepicker1"/>
	    	</div>

	    	
	    	

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>	
	</div>
	

</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

</script>
