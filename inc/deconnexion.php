<?php
$connexion=mysqli_connect("localhost","root","") or die("erreur");
mysqli_select_db($connexion,"gc") or die ("erreur base");
session_start();

session_unset();

session_destroy();

echo "
        <script>
		document.location.href='../index.php';
		</script>
        ";
?>