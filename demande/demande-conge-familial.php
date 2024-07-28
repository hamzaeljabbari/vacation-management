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
<br/>
<p dir="ltr" style="float: right;">
    Réf : 046/2020
</p>
<br/>
<br/>
<p dir="ltr">
    Expéditeur : <?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?>
</p>
<p dir="ltr">
    Destinataire : Responsable des Ressources Humaines
</p>
<p dir="ltr">
    A FES le <?php echo date('Y-m-d'); ?>
</p>
<p dir="ltr">
    Objet : Demande de congé pour un évènement familial
</p>
<p dir="ltr">
    Monsieur le Directeur,
</p>
<p dir="ltr">
    A la suite de …, je souhaite m’absenter du <?php echo $_GET['du']; ?> au <?php echo $_GET['au']; ?> au titre du congé légal
    prévu par le Code du travail accordé à cette occasion.
</p>
<br/>

<p dir="ltr" <?php if($_GET['type']=='3'){ ?>     style="color:green; text-decoration: underline; " <?php } ?>     >
    □ Naissance : continus ou discontinus, doivent être inclus dans la période
    d'un mois à compter de la date de la naissance : 3 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='4'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Mariage du salarié : 4 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='5'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Mariage d'un enfant du salarié : 2 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='6'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Mariage d'un enfant issu d'un précédent mariage du conjoint du salarié :
    2 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='7'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Décès d'un conjoint : 3 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='8'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Décès d'un enfant, d'un petit enfant : 3 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='9'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Décès d'un ascendant du salarié : 3 jours
</p>


<p dir="ltr"  <?php if($_GET['type']=='10'){ ?> style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Décès d'un enfant issu d'un précédent mariage du conjoint du salarié : 3
    jours
</p>


<p dir="ltr"  <?php if($_GET['type']=='11'){ ?> style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Décès d'un frère, d'une sœur du salarié, d'un frère ou d'une sœur du
    conjoint de celui-ci ou d'un ascendant du conjoint : 2 jours
</p>


<p dir="ltr" <?php if($_GET['type']=='12'){ ?>  style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Circoncision : 2 jours
</p>


<p dir="ltr"  <?php if($_GET['type']=='13'){ ?> style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Opération chirurgicale du conjoint : 2 jours
</p>


<p dir="ltr"  <?php if($_GET['type']=='14'){ ?> style="color:green; text-decoration: underline;" <?php } ?>     >
    □ Opération chirurgicale d'un enfant à charge : 2 jours
</p>

<br/>
<p dir="ltr">
    Vous voudrez bien trouver en pièce jointe, photocopie du justificatif de la
    survenance de l’évènement dont je vous souhaite bonne réception.
</p>
<br/>
<p dir="ltr">
    Je vous prie de croire, Monsieur le Directeur, à l'assurance de mes
    salutations distinguées.
</p>
<br/>
<br/>
<br/>
<p dir="ltr" style="float: right;">
    Signature
</p>
<br/>


</div>



</body>
</html>