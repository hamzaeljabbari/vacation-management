
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
    Réf : 065/2020
</p>
<p dir="ltr">
    <?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?>
</p>

<p dir="ltr">
    <?php echo $data_employe['adresse']; ?>
</p>

<p dir="ltr">
    <?php echo $data_employe['tel']; ?>
</p>
<p dir="ltr">
    <?php echo date('Y-m-d'); ?>
</p>
<p dir="ltr">
    Objet : Demande de congé payé
</p>
<br/>
<p dir="ltr">
    Madame
    <br/>
    <br/>
    Au  <?php echo date('Y-m-d'); ?>, j'ai acquis <?php echo $data_employe['base_taux']; ?> jours de congés payés au titre de l'année
    <?php echo date('Y'); ?>. Je souhaiterais prendre <?php echo $_GET['nbr']; ?> de ces jours pour la
    période allant du <?php echo $_GET['du']; ?> au <?php echo $_GET['au']; ?> inclus.
    <br/>
    <br/>
    Par la présente, je sollicite votre accord pour pouvoir m'absenter à ces
    dates. Je vous prie de bien vouloir m'informer de votre décision par écrit.
    <br/>
    <br/>
    Je vous prie d’agréer, Mr/MMe l’assurance de mes sentiments
    distingués.
</p>
<br/>
<p dir="ltr">
    Signature
</p>

    <br/>
</div>



</body>
</html>