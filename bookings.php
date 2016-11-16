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

function getServices() {
	$username = $_SESSION['username'];

	global $conn;

	$query = "SELECT cs.* FROM User_CompanyService ucs, CompanyService cs WHERE ucs.username='$username' AND ucs.service_id = cs.id;";

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$company = mysqli_query($conn, "SELECT companyName FROM Company WHERE id=". $row['company'] . ";");
			$company = mysqli_fetch_assoc($company)['companyName'];
			?>

			<div class="col-md-3 col-xs-12">
				<div class="thumbnail">
					<img src="http://placehold.it/242x200" alt="placeholder">
					<h3><?php echo $row["name"];?></h3>
					<p><?php echo "Company: ". $company; ?></p>
					<p><a href="#" class="btn btn-default" role="button">Book</a></p>
				</div>
			</div>
			<?php 
		}
	}
}
?>