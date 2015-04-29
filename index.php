<?php
include '_session.php';
// Set the image width
$imageWidth = "160px";
?>
<!-- Header inserter here -->
<?php include '_header.php'; ?>
<!--     	<img src="/assets/images/orca.gif" alt="Sound Pod" class="center" style="width:<?php echo $imageWidth ?>; padding:20px"> -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">
	    <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
	        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
	    </ol>
	    <div class="carousel-inner">
	    	<?php
	  //   	if (!$loggedIn) {
	  //   		echo "<div class'item'>";
		 //    		echo " <img data-src='holder.js/900x500/auto/#777:#7a7a7a/text:First slide' alt='First slide' src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojN2E3YTdhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9zdmc+'>";
		 //    		echo "<div class='container'>";
		 //    			echo "<div class='carousel-caption'>";
		 //    				echo "<p><a class='btn btn-lg btn-primary' href='sign-up.php'>Sign Up</a></p>";
			// 				echo "<p><a class='btn btn-lg btn-primary' href='login.php'>Login</a></p>";
			// 			echo "</div>";
			// 		echo "</div>";
			// 	echo "</div>";
			// }
			?>

	        <div class="item active">
	            <img class="caro image-responsive" alt="First slide" src="assets/images/info.jpg">
	            <div class="container">
	                <div class="carousel-caption">
	                    <h1>Station News</h1>
	                    <p>Check the forums to see what is going on!</p>
	                    <p><a class="btn btn-lg btn-primary" href="/forums.php" role="button">Forums</a></p>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img class="caro text-center" alt="Second slide" src="assets/images/sub.jpg">
	            <div class="container">
	                <div class="carousel-caption">
	                    <h1>Request A Sub</h1>
	                    <p>Find a DJ to sub your show!</p>
	                    <p><a class="btn btn-lg btn-primary" href="/substitutions.php" role="button">Requests</a></p>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img class="caro text-center" alt="Third slide" src="assets/images/bear.jpg">
	            <div class="container">
	                <div class="carousel-caption">
	                    <h1>DJ Resources</h1>
	                    <p>Review the DJ handbook, check what is on rotation, and lots of other cool stuff</p>
	                    <p><a class="btn btn-lg btn-primary" href="/resources.php" role="button">Resources</a></p>
	                </div>
	            </div>
	        </div>
	    </div>
	    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>

<?php
	include '_header.php';
?>