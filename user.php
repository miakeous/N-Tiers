<!DOCTYPE HTML>
<html>
<header>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</header>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="user.php">Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="resultat.php">Event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="event.html">Creation d'event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>

    </ul>
  </div>
</nav>

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
$quantite = $_POST["quantite"];

//require_once( 'check.php');
//echo verifieTable($id,$idPersonne);

$conn = new mysqli($servername, $username, $password,'archi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
echo "Connected successfully <br>" ;

$sql = "INSERT INTO archi.liaison (idEvent,idPersonne,quantite)
VALUES ('$id','$idPersonne','$quantite');";



//echo $sql."</br>";


if ($conn->query($sql)) {
    echo "l'user a été inscrit <br>";
} else {
    echo "Error: " . $sql . "<br> User deja inscrit" . mysqli_error($conn);
}

mysqli_close($conn);




 ?>


 <form action="resultat.php" method="post">

   <input type="submit" class='btn btn-primary btn-md' value="Voir les events">
 </form>
</body>


</html>
