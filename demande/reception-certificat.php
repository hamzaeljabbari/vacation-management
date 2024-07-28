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
    Réf : 069/2020
</p> <br>
<br/>
<p dir="ltr">
    Destinataire : <?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?>
</p>
<p dir="ltr">
    A FES le <?php echo date('Y-m-d'); ?>
</p>
<p dir="ltr">
    Objet : Accusé de réception d’un certificat médical
</p>

<p dir="ltr">
    Je me permets de vous informer que nous avons bien reçu votre certificat
    médical.
</p>
<br/>
<p dir="ltr">
    La durée de votre congé maladie débutera donc le <?php echo $_GET['du']; ?> pour se terminer le <?php echo $_GET['au']; ?> .
</p>
<br/>
<p dir="ltr">
    Lors de votre retour dans l’entreprise, vous voudrez bien nous fournir
    l’originale de votre certificat médical.
</p>
<br/>
<p dir="ltr">
    Nous vous souhaitons, <?php echo $data_employe['sexe']; ?>, un bon rétablissement.
</p>
<br/>
<p dir="ltr">
    Je vous prie de croire, Mr/MMe à l'assurance de mes salutations
    distinguées.
</p>
<br/>
<p dir="ltr" style="float: right;">
    Signature
</p>
<br/>


</div>



</body>
</html>