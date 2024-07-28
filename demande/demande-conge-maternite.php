
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
    Réf : 064/2020
</p> <br><br>
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
    Objet : Demande de congé maternité
</p>
<p dir="ltr">
    <?php echo $data_employe['sexe']; ?>,
</p>
<p dir="ltr">
    J’ai l’honneur de vous informer par la présente que j’attends un heureux
    événement / que je suis enceinte.
</p>
<p dir="ltr">
     mon congé
    maternité débutera le <?php echo $_GET['du']; ?> et prendra fin le <?php echo $_GET['au']; ?>.
</p>
<p dir="ltr">
    Je vous prie d’agréer, Mr/MMe l’assurance de mes sentiments
    distingués.
</p>
<p dir="ltr">
    Signature
</p>
<br/>

</div>



</body>
</html>