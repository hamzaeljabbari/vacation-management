<?php
$title_header="Gestion Congés";


$connexion=mysqli_connect("localhost","root","") or die("erreur");
mysqli_select_db($connexion,"gc") or die ("erreur base");
if(!isset($_SESSION['thedate'])){
	header("location: inc/deconnexion.php");
}




?>

