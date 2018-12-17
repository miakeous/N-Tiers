


<?php
//echo" avant test avant la co \n </br>";

$server = "localhost";
$port = "389";
$racine = "o=tse, c=fr";
$id = $_POST["inputId"];
$dn = "ou=person,o=tse,c=fr";
$rootdn = "uid=".$id.",ou=person,o=tse,c=fr";
$rootpw = $_POST["inputPassword"];
echo $id;
echo $password;
//echo $rootdn."\n </br>";

$ldapconn = ldap_connect($server, $port)
		  or die("Impossible de se connecter au serveur LDAP $ldaphost");
//echo"connexion reussi</br>";
if ($ldapconn) {

	if (ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
  //  echo "Utilisation de LDAPv3 </br>";
 } else {
    echo "Impossible d'utiliser LDAP V3 </br>";
    exit;
 }
    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($ldapconn,$rootdn,$rootpw);

    // Vérification de l'authentification
    if ($ldapbind) {

			$servername = "localhost";
			$username = "root";
			$password = "Tseinfo42";
			$conn = new mysqli($servername, $username, $password,'archi');
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error . "<br>");
			}
			$idUser =0;
			if ($result = $conn->query("SELECT * FROM archi.personne where archi.personne.uid='".$id."'")) {
			  $i =0;
			    while ($row = $result->fetch_row()) {
						$idUser= $row[0];

					}}
			session_start();
			$_SESSION['LDAP']['login'] =true;
			$_SESSION['LDAP']['USER']= $id;
			$_SESSION['LDAP']['Password']= $password;
			$_SESSION['LDAP']['id']= $idUser;
			//echo "apres</br>";
			//echo $_SESSION['LDAP']['login'];
			header("location: resultat.php");
			exit;
    } else {
        echo "Connexion LDAP échouée...";
    }

}
ldap_close($conn);


?>
