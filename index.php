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

    <!-- Footer stylesheet -->
    <link href="css/footer.css" rel="stylesheet">

    <!-- Custom stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom script -->
    <script type="text/javascript" src="js/script.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">

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
                    <a class="navbar-brand" href="#">Bookster</a>
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
                            <button type="submit" class="btn btn-default">Logga in!</button>
                        </form>
                        <!-- When logged in -->
                        <?php 
                    } else  { 
                        ?>

                        <ul class="nav navbar-nav">
                            <li><a href="service/service.php">Lägg till/ta bort bokningsobjekt</a></li>
                            <li><a href="calendar/showCalendar.php">Kalender</a></li>
                            <li><a href="#">Mina inställingar</a></li>
                        </ul>

                        <form class="navbar-right navbar-form" method="post" action="login.php">
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
            if($_SESSION['loggedin'] == true) {
                ?>
                <div class="input-group searchbargroup">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    <input type="text" class="form-control searchbar" id="searchAndHide" onkeyup="search()" placeholder="Sök efter objekt..." aria-describedby="basic-addon1">
                </div>
                <div class="row">
                    <?php
                    include('booking/bookings.php');
                    getServices();
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Välkommen till Bookster!</h1>
                    </div>
                    <div class="panel-body">
                        <p>Vänligen logga in ovan.</p>
                    </div>
                </div>
                <hr>
                <div id="slides" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                      <li data-target="#slides" data-slide-to="0" class="active"></li>
                      <li data-target="#slides" data-slide-to="1"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="img/cal1.jpg" alt="Bok">
                      <div class="carousel-caption">
                        <h1>Samla alla bokingar på ett och samma ställe</h1>
                    </div>
                </div>
                <div class="item">
                  <img src="img/cal2.jpg" alt="Skriva">
                  <div class="carousel-caption">
                    <h1>Var produktiv</h1>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#slides" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#slides" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
}
?>

</div><!-- Container-fluid (main content) -->
</div><!-- Container -->

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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js "></script>
<!-- Custom scripts -->
<script type="text/javascript" src="js/script.js"></script>
</body>

</html>