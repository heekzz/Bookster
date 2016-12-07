<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bookster</title>

	<!-- Bootstrap -->
	<link href="../css/bootstrap.css" rel="stylesheet">

	<!-- Custom stylesheet -->
	<link href="../css/style.css" rel="stylesheet">

	<!-- Footer stylesheet -->
    <link href="../css/footer.css" rel="stylesheet">

	<script type="text/javascript" src="../js/script.js"></script>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<?php
	session_start();
	?>
	<div class="container">
		<!-- Full Width Image Header -->
		<header class="header-image">
			<div class="headline">
				<div class="container">
					<h1 class="sr-only">Bookster</h1>
				</div>
			</div>
		</header>


		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="../index.php">
						Bookster
					</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<!-- When NOT logged in -->
					<?php
					if($_SESSION['loggedin'] == false) { 
						?>
						<form class="navbar-form navbar-right" method="post" action="../login.php">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username" required="true">
								<input type="password" name="password" class="form-control" placeholder="Password" required="true">
							</div>
							<button type="submit" class="btn btn-default">Logga in!</button>
						</form>
						<!-- When logged in -->
						<?php 
					} else  { 
						?> 

						<ul class="nav navbar-nav">
							<li><a href="service.php">Lägg till/ta bort bokningsobjekt</a></li>
							<li><a href="../calendar/showCalendar.php">Kalender</a></li>
							<li><a href="#">Mina inställningar</a></li>
						</ul>

						<form class="navbar-right navbar-form" method="post" action="../login.php">
							<span>Inloggad som <?php echo $_SESSION['username']?>!</span>
							<button type="submit" name="logout" class="btn btn-default">Logga ut</button>
						</form>
						<?php
					} 
					?>
				</div>
			</div>
			<!-- Container fluid -->
		</nav>
		<!-- Navbar default -->

		<!-- Main content -->
		<div class="container-fluid">
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


			if($_SESSION['loggedin'] == true && isset($_GET['companyid']) && !empty($_GET['companyid'])) {
				$companyid = $_GET['companyid'];
				$username  = $_SESSION['username'];
				$username = mysql_real_escape_string($username);

				// Select services for specific company
				$query = "SELECT * FROM Service WHERE company=".$companyid.";";
				$result = mysqli_query($conn, $query);

				// Select a set of services belonging to the logged in user
				$query = 'SELECT service FROM User_Service WHERE username="'.$username.'";';
				$exists = mysqli_query($conn, $query);

				$serviceArray = array();
				$index = 0;

				// Fill the array with existing services for the user
				while ($r = mysqli_fetch_assoc($exists)) {
					$serviceArray[$index] = $r['service'];
					$index++; 
				}


				if(mysqli_num_rows($result) > 0) {
					?>
					<div class="row">
						<?php
						$index = 0;
						while ($row = mysqli_fetch_assoc($result)) {
							$serviceid = $row['id'];
							$serviceName = $row['serviceName'];
							$description = $row['description'];
							$img = "http://lorempixel.com/484/400/business/4";
							?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="thumbnail ">
									<img class="media-object img-responsive" src=<?php echo "'".$img."'";?> alt="placeholder">
									<div class="caption">
										<h3><?php echo $serviceName; ?></h3>
										<p>
											<?php echo $description; ?>
										</p>
										<?php 
										if (in_array($serviceid, $serviceArray)) {
											?>
											<button type="button" id="deleteButton" onclick="removeService(this,<?php echo $serviceid . ",'" . $username . "'"; ?>)" class="btn btn-danger" >Ta bort från mina bokningar</button>
											<?php
										} else {
											?>
											<button type="button " id="addButton" onclick="addService(this,<?php echo $serviceid . ",'" . $username . "'"; ?>)" class="btn btn-success" >Lägg till i mina bokningar</button>
											<?php
										}
										?>
									</div>
								</div>
							</div>
							<?php 
						}
						if ((++$index % 4) == 0) {
							echo '<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>';
						}else if (($index %2) == 0) {
							echo '<div class="clearfix visible-sm-block"></div>';
						}
						?>
					</div>
					<?php
				} else {
					echo "<p>Didn't find any services</p>";
				}
			} else {
				echo "<p>Not logged in!</p>";
			}
			?>
		</div>



	</div>

	<footer class="footer-distributed">

		<div class="footer-left">

			<h3>Bookster<span>.se</span></h3>

			<p class="footer-links">
				<a href="#">Hem</a>
				·
				<a href="#">Om företaget</a>
				·
				<a href="#">Kontakt</a>
			</p>

			<p class="footer-company-name">Bookster &copy; 2016</p>
		</div>

		<div class="footer-center">

			<div>
				<i class="fa fa-map-marker"></i>
				<p><span>Studievägen 9A</span> 583 29 Linköping, Sverige</p>
			</div>

			<div>
				<i class="fa fa-phone"></i>
				<p>+46 70-111 22 33</p>
			</div>

			<div>
				<i class="fa fa-envelope"></i>
				<p><a href="mailto:mail@bookster.se">mail@bookster.se</a></p>
			</div>

		</div>

		<div class="footer-right">

			<p class="footer-company-about">
				<span>Om företaget</span>
				Bookster är en bokningstjänst online där du kan boka alla dina lokaler eller aktiviteter på en och samma tjänst
			</p>

			<div class="footer-icons">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-github"></i></a>
			</div>

		</div>

	</footer>


	<!-- Custom scripts -->
	<script>
		function addService(e, id, user) {
			var request = $.ajax({
				url: 'serviceMethods.php',
				type: 'POST',
				data: {
					action: 'addService',
					serviceid: id, 
					username: user
				}
			}).done(function() {
				$(e).toggleClass('btn-success');
				$(e).toggleClass('btn-danger');

				var classList = e.className.split(/\s+/);

				for (var i = 0; i <classList.length; i++) {
					if (classList[i] == 'btn-success') {
						e.innerHTML = "Lägg till i mina bokningar";
					} else if (classList[i] == 'btn-danger') {
						e.innerHTML = "Ta bort från mina bokningar";
					}
				}
			}).fail(function() {
				console.log("Failed add request");
			});
		}

		function removeService(e, id, user) {
			$.ajax({
				url: "serviceMethods.php",
				type: "POST",
				data: {
					action: "removeService",
					serviceid: id,
					username: user
				}
			}).done(function() {
				$(e).toggleClass('btn-success');
				$(e).toggleClass('btn-danger');

				var classList = e.className.split(/\s+/);

				for (var i = 0; i <classList.length; i++) {
					if (classList[i] == 'btn-success') {
						e.innerHTML = "Lägg till i mina bokningar";
					} else if (classList[i] == 'btn-danger') {
						e.innerHTML = "Ta bort från mina bokningar";
					}
				}
			}).fail(function() {
				console.log("Failed remove request");
			});
		}
	</script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../js/bootstrap.min.js "></script>
</body>

</html>