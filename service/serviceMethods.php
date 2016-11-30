<?php
$servername = "155.4.151.120";
$db_user = "bookster";
$db_pw = "bokanu";
$db_name = "bookster";

// Create connection
$conn = mysqli_connect($servername, $db_user, $db_pw, $db_name);

// Check connection
if (mysqli_connect_errno()) {
	die("Connection failed: " . mysqli_connect_error());
}


function listAllCompanies() {
	global $conn;
	$query = "SELECT * FROM Company;";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$companyName = $row['companyName'];
			$description = $row['description'];
			$img = "http://placehold.it/242x200";
			?>
			<div class="media">
				<div class="media-left">
					<a href="#">
					<img class="media-object" src=<?php echo "\"".$img."\""; ?> alt="placeholder">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><?php echo $companyName ?></h4>
					<?php echo $description; ?>
					<button type="button" class="btn btn-primary pull-right">Visa bokningsobjekt</button>
				</div>
			</div>
			<?php
		}

	} else {
		echo "Didn't find any companies";
	}
}
?>