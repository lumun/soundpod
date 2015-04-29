<?php
include '_session.php';
include '_helpers.php';
include '_header.php'; 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["add-show"])) {
		?>
		<br />
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><strong>Success!</strong> You added your show <?php echo stripslashes($_GET["add-show"]) ?>. See the full list of shows <a href="/manage-shows.php">here</a></p>
		</div>
		<?php
	}
}
else {
	header('Location: /404.php');
}

include '_footer.php';
?>