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
	$username = mysql_real_escape_string($username);

	global $conn;

	$query = "SELECT s.* FROM User_Service us, Service s WHERE us.username='$username' AND us.service = s.id;";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$company = mysqli_query($conn, "SELECT companyName FROM Company WHERE id=". $row['company'] . ";");
			$company = mysqli_fetch_assoc($company)['companyName'];
			?>

			<div class="col-md-3 col-sm-6 col-xs-12 bookingobject">
				<div class="thumbnail">
					<img src="http://placehold.it/242x200" alt="placeholder">
					<h3 class="bookingtext"><?php echo $row["serviceName"];?></h3>
					<p class="bookingtext"><?php echo "Företag: ". $company; ?></p>
					<p><a href="#" class="btn btn-default" role="button">Boka</a></p>
				</div>
			</div>
			<?php 
		}
	}
}
?>