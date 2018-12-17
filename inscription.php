<!DOCTYPE HTML>
<html>
<header>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</header>
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

<h2> Inscription : </h2>

<?php
session_start();
//echo "SESSION['LDAP']['login']".$_SESSION['LDAP']['login'];
//echo $_SESSION['LDAP']['login'];
if ( $_SESSION['LDAP']['login'] !== true) {
   header('Location: login.html');
   exit; // dont forget the exit here...
}

$servername = "localhost";
$username = "root";
$password = "Tseinfo42";
$id = $_POST["id"];
$name =  $_POST["nom"];
$prenom =  $_POST["prenom"];
$email =  $_POST["email"];
$idPersonne = $_SESSION['LDAP']['id'];

$conn = new mysqli($servername, $username, $password,'archi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
//echo "Connected successfully <br>" ;
//echo $id."</br>";
$sql = "select idPersonne from archi.liaison where idEvent='$id'";
$t = false;
if ($result =$conn->query($sql)) {
//  echo "idPersonne : ".$idPersonne."</br>";
while ($row = $result->fetch_row()) {
    //echo $row[0];
    if($row[0]==$idPersonne){
      $t=true;
    }
  }
  if($t==true){
    echo "<div> Vous etes deja inscrit</div>";
  }else{
    echo"<form method='post' action='user.php'>";
     echo "Nombres de personne :<input type='text' id='quantite' name='quantite' /> </br>";
    echo "<input type='hidden' required id='id' name='id' value= ".$_POST["id"]." /> </br>";
    echo "<input type='submit' value='Inscription' action=''/> </br>";
    echo "</form> ";
  }
}else{
  echo "connection failed";
}






 ?>


</body>


</html>
