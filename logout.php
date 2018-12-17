<?php
session_start();
$_SESSION['LDAP']['login'] =false;
	header("location: login.html");
?>
