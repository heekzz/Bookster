<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bookster</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom stylesheet -->
    <link href="css/style.css" rel="stylesheet">

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
                    <a class="navbar-brand" href="#">
                        Bookster
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <!-- When NOT logged in -->
                    <?php
                    if($_SESSION['loggedin'] == false) { 
                        ?>
                        <form class="navbar-form navbar-right" method="post" action="login.php">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required="true">
                                <input type="password" name="password" class="form-control" placeholder="Password" required="true">
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                        <!-- When logged in -->
                        <?php 
                    } else  { 
                        ?> 

                        <ul class="nav navbar-nav">
                            <li><a href="account/newBooking.php">Add service</a></li>
                            <li><a href="#">Link</a></li>
                        </ul>

                        <form class="navbar-right navbar-form" method="post" action="login.php">
                            <button type="submit" name="logout" class="btn btn-default">Logout</button>
                        </form>
                        <p class="navbar-text navbar-right">Logged in as <?php echo $_SESSION['username']?>!</p>
                        <?php
                    } 
                    ?>
                </div>
            </div>
            <!-- Container fluid -->
        </nav>
        <!-- Navbar default -->

        <div class="container">
            <div class="row">
                <?php
                if($_SESSION['loggedin'] == true) {
                    include('bookings.php');
                    getServices();
                }
                ?>
            </div>
        </div>

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js "></script>
</body>

</html>