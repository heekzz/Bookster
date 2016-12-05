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
                            <li><a href="#">Lägg till/ta bort bokningsobjekt</a></li>
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
        <?php 
        if($_SESSION['loggedin'] == true) {
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

            $query = "SELECT * FROM Company;";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $companyName = $row['companyName'];
                    $description = $row['description'];
                    $companyid = $row['id'];
                    $img = "http://placehold.it/242x200";
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src=<?php echo "'".$img."';" ?> alt="placeholder" >
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $companyName ?></h4>
                            <?php echo $description; ?>
                            <a role="button" class="btn btn-primary pull-right" href=<?php echo '"addService.php?companyid=' . $companyid . '"'; ?> >Visa bokningsobjekt</a>
                        </div>
                    </div>
                    <?php
                }

            } else {
                echo "Didn't find any companies ";
            }
        } else {
            echo "<p>Not logged in!</p>";
        }
        ?>



    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js "></script>
</body>

</html>