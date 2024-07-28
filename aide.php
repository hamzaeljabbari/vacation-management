<?php 
session_start();
include("inc/securite/conexion.php");

$num =strip_tags(htmlentities(addslashes( $_POST['num'])));

if($num == 1){
	 $id =strip_tags(htmlentities(addslashes( $_POST['id'])));

	 $select ="select * from type_conge where id= $id";
	 $resultat=mysqli_query($connexion,$select); 
	 $data_type=mysqli_fetch_array($resultat); 
	
	echo $data_type['nbr_jrs'];
}

if($num == 2){
	 $id =strip_tags(htmlentities(addslashes( $_POST['id'])));

	 $select ="DELETE from employe where id=$id";
	 $resultat=mysqli_query($connexion,$select); 
	 $data_type=mysqli_fetch_array($resultat); 
	
	echo 1;
}


?>