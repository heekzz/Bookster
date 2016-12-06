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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>

    <!-- Custom script -->
    <script type="text/javascript" src="../js/script.js"></script>

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
                    <a class="navbar-brand" href="../index.php">Bookster</a>
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
                            <li><a href="../service/service.php">Lägg till bokningsobjekt</a></li>
                            <li><a href="../calendar/showCalendar.php">Kalender</a></li>
                            <li><a href="#">Mina inställingar</a></li>
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
        if ($_SESSION['loggedin'] == true) {
            ?>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
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

                    $img = "http://placehold.it/400x400";

                    if(isset($_GET['serviceid']) && !empty($_GET['serviceid'])) {

                        $serviceid = $_GET['serviceid'];

                        $query = "SELECT * FROM Service WHERE id=" . $serviceid;

                        $result = mysqli_query($conn, $query);
                        $service = mysqli_fetch_assoc($result);
                        ?>
                        <img src=<?php echo '"'. $img . '"' ?> class="img-responsive img-circle" alt=<?php echo '"' . $service['serviceName'] . '"'; ?> >
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <h1><?php echo $service['serviceName']; ?></h1>
                        <p><?php echo $service['description']; ?></p>
                    </div>
                </div><!-- Row -->
                <br>
                <table class="table table-hover">
                    <tr>
                        <th>Tid</th>
                        <th>Status</th>
                        <th>Boka</th>
                    </tr>
                    <?php
                    $hour = 12; 
                    for ($i=0; $i < 10; $i++) { 
                        $time = $hour . ':00 - ' . ++$hour . ':00';
                        echo '<tr>';
                        echo '<th id="time">' . $time . '</th>';
                        echo '<th>Ledig</th>';
                        echo '<th><button type="button" class="btn btn-success" data-time="'.$time.'" data-toggle="modal" data-service="'.$service['serviceName'].'" data-target="#myModal">Boka objekt</button>';
                        echo '</tr>';
                    }
                    ?>
                </table>
                <!-- Button trigger modal -->
                <p></p>

                <?php
            } else {
                die("<p>Serviceid not set</p>");
            }
        } else {
            echo "<p> Not logged in!</p>";
        }
        ?>

        <!-- Modal -->
        <div  id="myModal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form>
                    <p id="time"></p>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bjud in vänner till din bokning via e-post. Separera flera adresser med ;</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ex. namn1@mail.se;namn2@mail.se">
                  </div>
                  <div class="form-group">
                    <label for="message">Meddelande</label>
                    <textarea type="input" class="form-control" id="message" rows="5" placeholder="Meddelande"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
            <button type="button" class="btn btn-primary">Bekräfta bokning</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</div>
<!-- Container -->

<script>
    $('#myModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              // Extract info from data-* attributes
              var time = button.data('time') 
              var serviceName = button.data('service');
              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('#time').text('Tid ' + time)
              modal.find('.modal-title').text("Bokning för: " + serviceName)
              modal.find('#message').html("Hejsan! &#10;&#10;Jag har bokat "+ serviceName + " klockan " + time +" via Bookster. Hoppas du kan närvara!  &#10;&#10;&#10;&#10;&#10;&#10;&#10;Önskar du att din hyresvärd eller favoritförening också fanns tillgängligt att boka genom Bookster? Skicka ett mail till foretag@bookster.se med deras namn så kontaktar vi dem.")
          });
      </script>
      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/bootstrap.min.js "></script>
      <!-- Custom scripts -->
      <script type="text/javascript" src="../js/script.js"></script>
  </body>

  </html>