<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
	login();
}

if (isset($_POST['logout'])) {
	logout();
}

function login() {
	$servername = "155.4.151.120";
	$db_user = "bookster";
	$db_pw = "bokanu";
	$db_name = "bookster";
	$table_name = "Users";

// Create connection
	$conn = mysqli_connect($servername, $db_user, $db_pw, $db_name);

// Check connection
	if (mysqli_connect_errno()) {
		die("Connection failed: " . mysqli_connect_error());
	} else {
		echo "Connected successfully";
	}


// Credentials from form
	$username = $_POST['username'];
	$password = $_POST['password'];

// Protect from MySQL injection
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	$query = "SELECT * FROM $table_name WHERE username='$username' and password='$password'";
	$result = mysqli_query($conn, $query);

	$count = mysqli_num_rows($result);

	if($count == 1) {
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		header('Location: index.php');  
	}
}

function logout() {
	session_start();
	unset($_SESSION['loggedin']);
	unset($_SESSION['username']);
	header('Location: index.php');
}
?>