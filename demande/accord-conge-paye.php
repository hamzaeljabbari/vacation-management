
<?php 
session_start();
include("../inc/securite/conexion.php");
        $id=strip_tags(htmlentities(addslashes($_GET['id']))); 
        $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where id='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<style type="text/css">
    .main
    {
        -webkit-print-color-adjust: exact; 
             width: 827px;
             height:1170px;
        margin: 0;
        padding: 10px;
        
    }
</style>


<body>



<div class="main">

<p dir="ltr" style="float: right;">
    Réf : 052/2020
</p> <br> <br>
<p dir="ltr">
    Objet : Accord de congés payés
</p>
<p dir="ltr" style="float: right;">
    A FES,
</p> <br> <br><br>
<p dir="ltr" style="float: right;">
    Le <?php echo date('Y-m-d'); ?>
</p>

<p dir="ltr">
    Nous avons bien reçu votre courrier du <?php echo $_GET['date']; ?> dans lequel vous nous
    indiquez que vous souhaitez prendre votre congé principal du <?php echo $_GET['du']; ?>
    au <?php echo $_GET['au']; ?>.
</p>
<p dir="ltr">
    Nous vous informons que nous vous donnons notre accord pour ces dates de
    congé.
</p>
<p dir="ltr">
    Nous vous prions d’agréer,Mr/MMe nos respectueuses salutations
</p>
<br/>
<p dir="ltr" style="float: right;">
    Responsable des Ressources Humaines
</p>
<br/>


</div>



</body>
</html>