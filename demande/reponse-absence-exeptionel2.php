
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
<br/>
<p dir="ltr" style="float: right;">
    Réf : 061/2020
</p><br><br>
<br/>
<br/>
<p dir="ltr">
    Expéditeur : Responsable des Ressources Humaines
</p>
<p dir="ltr" style="float: right;">
    Destinataire : <?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?>
</p><br><br>
<p dir="ltr">
    A FES , le <?php echo date('Y-m-d'); ?>
</p>
<p dir="ltr">
    Objet : réponse à votre demande d’absence exceptionnelle (Circoncision
    enfant)
</p>

<p dir="ltr">
     A la suite de votre courrier , vous avez sollicité une autorisation exceptionnelle
      d'absence de <?php echo $_GET['nbr']; ?> jours. à l’occasion de la circoncision de
    votre (ou vos) enfant (s).
</p>
<p dir="ltr">
    Nous avons le plaisir de vous confirmer notre accord.
</p>
<p dir="ltr">
    Nous notons que votre congé démarrera le <?php echo $_GET['du']; ?> pour se terminer le <?php echo $_GET['au']; ?>.
</p>
<p dir="ltr">
    Durant cette période, votre contrat de travail sera réputé suspendu, nous
    nous permettons de vous rappeler que :
</p>
<p dir="ltr">
    Lors de votre retour dans l’entreprise, vous voudrez bien nous fournir un
    document attestant de la circoncision de votre enfant.
</p>
<p dir="ltr">
    Nous vous adressons, Mr/MMe toutes nos félicitations.
</p>
<p dir="ltr">
    Veuillez agréer l’expression de nos salutations distinguées.
</p>
<p dir="ltr">
    Signature
</p>
<br/>

</div>



</body>
</html>