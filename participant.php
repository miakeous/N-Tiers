<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="participant.css">
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
<h2>Participants</h2>



<?php

session_start();
if ( $_SESSION['LDAP']['login'] !== true) {
   header('Location: login.html');
   exit; // dont forget the exit here...
}else{

  $servername = "localhost";
  $username = "root";
  $password = "Tseinfo42";
  $conn = new mysqli($servername, $username, $password,'archi');

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error . "<br>");
  }
  $id = $_POST["id"];
  echo "idEvent ".$id;
  $query = "SELECT p.EMAIL,p.NOM,p.PRENOM,p.DATEN,p.id,l.quantite from archi.liaison l join archi.personne p on l.idPersonne = p.id where l.idEvent =".$id." GROUP BY p.id,l.quantite";
  //echo $query;
  echo "<table class='table table-bordered'>
    <thead>
      <tr>
      <th scope='col'>#</th>
        <th scope='col'>Email</th>
        <th scope='col'>Nom</th>
        <th scope='col'>Prenom</th>
        <th scope='col'>Date de naissance</th>
        <th scope='col'>Nombre de personne</th>
        <th scope='col'>Désinscription</th>
      </tr>
    </thead>
    <tbody>";
  if ($result = $conn->query($query)) {
    $i = 1;
      while ($row = $result->fetch_row()) {

            echo "<tr>";
            echo "<th scope='row'>".$i."</th>";
            echo "<td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[2]."</td>";
            echo "<td>".$row[3]."</td>";
            echo "<td>".$row[5]."</td>";
            if($row[4]==$_SESSION['LDAP']['id']){
              echo "<td>";
              echo "<form method ='POST' action='desinscription.php'>";
              echo "<input type='hidden' name ='idEvent' value='$id'>";
              echo "<button type='submit' class='btn'><i class='fa fa-close'></i></button>";
              echo "</form>";
              echo "</td>";
            }else{
              echo "<td></td>";
            }
            echo"</tr>";
            $i=$i+1;


      }


  }
  echo" </tbody>
  </table>";
}
 ?>

 </body>
 </html>
