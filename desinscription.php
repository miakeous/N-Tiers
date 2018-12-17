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
$idEvent = $_POST["idEvent"];
$idPersonne = $_SESSION['LDAP']['id'];


//require_once( 'check.php');
//echo verifieTable($id,$idPersonne);

$conn = new mysqli($servername, $username, $password,'archi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
echo "Connected successfully <br>" ;

$sql = "DELETE FROM archi.liaison WHERE  idEvent='$idEvent' AND idPersonne='$idPersonne'";




//echo $sql."</br>";


if ($conn->query($sql)) {
    echo "l'user a été inscrit <br>";
} else {
    echo "Error: " . $sql . "<br> User deja inscrit" . mysqli_error($conn);
}

mysqli_close($conn);
header('location: resultat.php');


 ?>
