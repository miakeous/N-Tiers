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
$conn = new mysqli($servername, $username, $password,'archi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}

if($resultat = $conn->query("Delete from archi.event where idEvent=".$id)){
  	header("location: resultat.php");
}

 ?>
