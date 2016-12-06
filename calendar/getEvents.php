<?php
session_start();

date_default_timezone_set('UTC');

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
	$allDay = ($row['allDay'] == "true") ? true : false;
	$e['allDay'] = $allDay;
	$e['start'] = $row['startDate'];
	$e['end'] = $row['endDate'];

	// Merge the event array into the return array
	array_push($events, $e);
}

echo json_encode($events);


function parseDateTime($string, $timezone=null) {
	$date = new DateTime(
		$string,
		$timezone ? $timezone : new DateTimeZone('UTC')
			// Used only when the string is ambiguous.
			// Ignored if string has a timezone offset in it.
		);
	if ($timezone) {
		// If our timezone was ignored above, force it.
		$date->setTimezone($timezone);
	}
	return $date;
}
?>