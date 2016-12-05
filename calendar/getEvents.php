<?php
session_start();

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

$username = $_SESSION['username'];

$query = 'SELECT * FROM Events WHERE user="' . $username . '";';

// Execute query
$result = mysqli_query($conn, $query);

// Returning array
$events = array();

// Fetch results from DB
while ($row = mysqli_fetch_assoc($result)) {
	$e = array();

	$e['id'] = $row['id'];
	$e['title'] = $row['title'];
	$e['allDay'] = $row['allDay'];
	$e['startDate'] = $row['startDate'];
	echo "Start date: " . $e['startDate'] ."<br>";
	echo "Start date UTC: " . gmdate("Y-m-dTH:i:s", $e['startDate']) ."<br>";
	echo "End date: " . $e['endDate'] . "<br>";
	echo "End date UTC: " . gmdate("Y-m-dTH:i:s", $e['endDate']) ."<br>";
	$e['endDate'] = $row['endDate'];

	// Merge the event array into the return array
	array_push($events, $e);
}

echo json_encode($events);
exit();
?>