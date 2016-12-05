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

if(isset($_POST['action']) && !empty($_POST['action'])) {
	if (isset($_POST['serviceid']) && !empty($_POST['serviceid'])) {
		$serviceid = $_POST['serviceid'];
		$username = $_POST['username'];
		$username = mysql_real_escape_string($username);
		switch ($_POST['action']) {
			case 'addService':
			$query = 'INSERT INTO User_Service VALUES ('.$serviceid.',"'.$username.'");';
			$result = mysqli_query($conn, $query);
			echo "Success add";
			break;

			case 'removeService':
			$query = 'DELETE FROM User_Service WHERE service='.$serviceid.' AND username="'.$username.'";';
			mysqli_query($conn, $query);
			echo "Success remove";
			break;

			default:
			# code...
			break;
		}
	} else {
		echo "serviceid not set";
	}
} else {
	echo "action not set";
}

?>