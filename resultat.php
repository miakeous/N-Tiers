<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="resultat.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="resultat.php">Event<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="event.html">Creation d'event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="calendrier.php">Calendrier</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

    </ul>
  </div>
</nav>
<h2>Tous les events :</h2>

<?php

session_start();
if ( $_SESSION['LDAP']['login'] !== true) {
   header('Location: login.html');
   exit; // dont forget the exit here...
}else{
//Get User IP
 $ip = $_SERVER['REMOTE_ADDR'];
// echo $ip."</br>";
//echo $PublicIP."</br>";
 echo 'http://ip-api.com/php/'.getenv('REMOTE_ADDR');
 $query = @unserialize (file_get_contents('http://ip-api.com/php/'.getenv('REMOTE_ADDR')));
//echo "Success ".$quer["success"]."</br>";
 $servername = "localhost";
 $username = "root";
 $password = "Tseinfo42";
 //create Mysql Connection
 $conn = new mysqli($servername, $username, $password,'archi');
 //Check if connection is working else we die
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error . "<br>");
 }
 //test if query is accepted
if ($result = $conn->query("SELECT * FROM archi.event LIMIT 100")) {
  $i =0;
    while ($row = $result->fetch_row()) {
      //Check if Geolocation is working else we display only the city
      if ($query && $query['status'] == 'success') {
        echo "Ville : ".$query["city"];
      $address2 = "http://maps.google.fr/maps?hl=fr&amp;saddr=".$row[3]."&amp;daddr=".$query['city']."&amp;dirflg=c&amp;output=embed";
      }
      else{
        $address2 = "https://maps.google.it/maps?q=".$row[3]."&output=embed";
      }
      //Display all result
      echo "<div class='container'>";
      echo "<div class='jumbotron'>";
      echo "<div class='delete'>";
      echo "<form method='POST' action= 'delete.php'>";
      echo "<input type='hidden' id='id' name='id' value= '".$row[0]."' /> ";
      echo "<button type='submit' class='btn'><i class='fa fa-close'></i></button>";
      echo "</form>";
      echo "</div>";
      echo "<div class='gauche'>";
      echo"<form method='post' action='modifie.php'>";
          echo "<div class='form-group'>";
            echo "<input type='hidden' id='id' name='id' value= '".$row[0]."' /> ";
          echo "</div>";
          echo "<div class='form-group'>";
          echo"<span class='label label-default'>Nom de l'évenement</span>";
          echo "<input type='text' class='form-control' id='nom' name='nom' value= '".$row[1]."' />";
        echo "</div>";
        echo "<div class='form-group'>";
          echo "<span class='label label-default'>Date de l'évenement</span>";
          echo "<input type='text' class='form-control' id='date' name='date' value= '".$row[2]."' /> ";
          echo "</div>";
        echo "<div class='form-group'>";
          echo"<span class='label label-default'>Adresse de l'évenement</span>";
          echo "  <input type='text' class='form-control' id='address' name='address' value='".$row[3]."'/>";
        echo "</div>";
          echo "<input type='submit' class='btn btn-primary btn-md' value='Modifier' action=''/> ";
      echo "</form> ";
      echo "</div>";
      //Map
        echo "<div class='droite'>";
          echo "<iframe width='480' height='337' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='$address2'></iframe>";//width='640' height='450'
        echo "</div>";
        //Inscription form
        echo "<form class='inscription' method='post' class='bottom' action='inscription.php'>";
          echo "<input type='hidden' id='id' name='id' value= ".$row[0]." />";
          echo "<input type='submit' class='btn btn-primary btn-md'  value='Inscription'  />";
        echo "</form>";
        //Participations form
        echo "<form class='participation' method='post' class='bottom' action='participant.php'>";
          echo "<input type='hidden' id='id' name='id' value= ".$row[0]." />";
          echo "<input type='submit' class='btn btn-primary btn-md'  value='Voir les participants'  />";
        echo "</form>";
        echo"</div>";
      echo "</div>";

   }
    /* free result set */
    $result->close();
}
//Free connection
$conn->close();
}

 ?>







</body>


</html>
