<?php

$server = "127.0.0.1";
$port = "389";
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password = $_POST["password"];
$date = $_POST["date"];
$uid = $prenom.".".$nom;
$servername = "localhost";
$username = "root";
$password = "Tseinfo42";
$rootdn = "uid=pierre.tardiveau,ou=person,o=tse,c=fr";
$userdn = "uid='$uid',ou=person,o=tse,c=fr";
$rootpw ="19932393aqw";
$info["cn"]=$nom;
$info["mail"]=$email;
$info["objectClass"][0]="person";
$info["objectClass"][1]="inetOrgPerson";
$info["objectClass"][2]="organizationalPerson";
$info["sn"]=$prenom;
$info["title"]="User";
$info["uid"]=$uid;
$info["userPassword"]=$password;
$ldapconn = ldap_connect($server, $port)
		  or die("Impossible de se connecter au serveur LDAP $ldaphost");

if ($ldapconn) {
	echo "connexion reussi </br>";
  if (ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
        //  echo "Utilisation de LDAPv3 </br>";
       } else {
          echo "Impossible d'utiliser LDAP V3 </br>";
          exit;
       }
  //Connexion annonyme
  $ldapbind = ldap_bind($ldapconn,$rootdn,$rootpw);
  // Vérification de l'authentification

  if ($ldapbind) {
		echo "User auth </br>";
    $r = ldap_add($ldapconn, $userdn, $info);

    $conn = new mysqli($servername, $username, $password,'archi');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "<br>");
    }

    $sql = "INSERT INTO archi.personne (NOM,uid,PRENOM,EMAIL,DATEN)
    VALUES ('$nom','$uid','$prenom','$email','$date');";





    if ($conn->query($sql)) {
      	//header("location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  }
  }
	 ldap_close($conn);

 ?>
