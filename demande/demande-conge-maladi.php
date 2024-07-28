
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
    Réf : 070/2020
</p> <br> <br>
<p dir="ltr">
        <?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?>
</p>
<p dir="ltr">
        <?php echo $data_employe['adresse']; ?>
</p>
<p dir="ltr" style="float: right;">
     <?php /*echo $data_employe['sexe']; */?>
</p> <br>
  <br> <br> <br>

<p dir="ltr" style="float: right;">
    Fait à FES , le <?php echo date('Y-m-d'); ?>
</p> 
<br><br>
<p dir="ltr" style="text-align: center;">
    Objet : absence pour cause de maladie
</p>
<p dir="ltr">
     Madame / Monsieur, 

</p>
<p dir="ltr">
    Salarié(e) de votre entreprise, je vous informe par la présente que je
    serai absent(e) à mon poste de travail du <?php echo $_GET['du']; ?> au <?php echo $_GET['au']; ?>
    inclus, pour cause de maladie.
</p>
<p dir="ltr">
    Je reprendrai donc mon activité professionnelle au sein de l'entreprise le
    <?php
$jour = $_GET['au']; // Notre date par default
echo date('Y-m-d', strtotime($jour. ' + 1 days')); // On ajoute 1 jour

?>.
</p>
<p dir="ltr">
    Vous trouverez, joint à cette lettre, l'arrêt de travail qui m'a été
    délivré par mon médecin.
</p>
<p dir="ltr">
    Je vous prie de croire, Mr/MMe à l'assurance de mes salutations
    distinguées.
</p>
<br/>
<p dir="ltr" style="float: right;">
    Signature
</p>
<br/>
<br/>


</div>



</body>
</html>