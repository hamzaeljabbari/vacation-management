<?php 
session_start();
include("inc/securite/conexion.php");

$i=0;
$jrs=1;
 function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
} 


if(!isset($_SESSION['loginAdmin'])){
     
header("Location: index.php");
}
        if(isset($_GET['valider2']))
{
    $id=html_entity_decode(strip_tags(addslashes($_GET['valider2'])));
    mysqli_query($connexion,"update conge set etat=1 where id=$id");


    $data_conge=mysqli_fetch_array(mysqli_query($connexion,"select * from conge where id='$id'"));

    $du=$data_conge['du'];
    $au=$data_conge['au'];
    $type=$data_conge['type'];
    $email=$data_conge['user'];
    $emeteur="rh@ecamaroc.com";
    $data_nbr_jrs= dateDiffInDays($du, $au); 


    

    $data_type_conge=mysqli_fetch_array(mysqli_query($connexion,"select * from type_conge where id='$type'"));
    $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$email'"));
    $lien=$data_type_conge['accord'];
    $id_employe=$data_employe['id'];
    $titre=$data_type_conge['titre'];


$subject = "New Message from " . strip_tags(htmlentities(addslashes($emeteur)));
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header .= 'From:'. strip_tags(htmlentities(addslashes($emeteur)))  . " \r\n";
        
            
             $msg="http://localhost/conge/demande/$lien?id=$id_employe&du=$du&au=$au&nbr=$data_nbr_jrs&type=$type";
            $message = "Bonjour ; <br>

Veuillez trouver ci-joint la réponse de votre demande de congé : <a href='".$msg."' >Consulter</a> <br> ";
            $message.="Type congé : $titre <br> Cordialement " ;
            
        
            
            mail($email, $subject,
            $message,
            $header); 


   
   
}

if(isset($_GET['annuler']))
{
    $id=html_entity_decode(strip_tags(addslashes($_GET['annuler'])));
    mysqli_query($connexion,"update conge set etat=2 where id=$id");


     $data_conge=mysqli_fetch_array(mysqli_query($connexion,"select * from conge where id='$id'"));
    
    $du=$data_conge['du'];
    $au=$data_conge['au'];
    $type=$data_conge['type'];
    $email=$data_conge['user'];
    $emeteur="tarik.amoum@gmail.com";
    $data_nbr_jrs=dateDiffInDays($du, $au);
    
    $data_type_conge=mysqli_fetch_array(mysqli_query($connexion,"select * from type_conge where id='$type'"));
    $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$email'"));
    $lien=$data_type_conge['refus'];
    $id_employe=$data_employe['id'];
    
    
    $msg="http://localhost/conge/demande/$lien?id=$id_employe&du=$du&au=$au&nbr=$data_nbr_jrs&type=$type";
    if($type==1)
    {

        $subject = "New Message from " . strip_tags(htmlentities(addslashes($emeteur)));
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header .= 'From:'. strip_tags(htmlentities(addslashes($emeteur)))  . " \r\n";
        
            
             $msg="http://localhost/conge/demande/$lien?id=$id_employe&du=$du&au=$au&nbr=$data_nbr_jrs&type=$type";
            $message = "Bonjour  <br>

            Veuillez trouver ci-joint ma demande de congé : <a href='".$msg."' >Consulter</a> <br> ";
            $message.="Type congé : $titre <br> Cordialement " ;
            
        
            /*
            mail($email,
            $subject,
            $message,
            $header); */


    }


 
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Gestion Congés</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script type="text/javascript">
         function supprimer(id){
                if(confirm('Voulez vous vraiment supprimer ?')){
                    num = 2;
                    $.post("./aide.php",{id:id,num:num},function(data){
                    
                            var ligne = document.getElementById(id);
                            document.getElementById("example1").deleteRow(ligne.rowIndex);
                            alert("Merci ,Employe bien supprime !");
                        

                    });
                }
            }
</script>
  


</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html"><?php echo $title_header; ?></a>
            </div>
           
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
       <?php include('header.php'); ?>
     
    </section>

             
    <section class="content" style="margin: 70px 15px 0 315px;">
        <?php   
            if($i==1){
        ?>
       
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #15ae60;">
                        <b>Felicitation !</b> Employée bien ajouter
                    </p>
          
                            <?php
    }


?>
        <div class="container-fluid">
            <div class="block-header">
                <h3>
    Congé
    <small>
       Liste des Congés en attente
     
    </small>
    
 
</h3>


            </div>

            


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                      <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="example1">
                                    <thead>
                                        <tr>
                                              <th></th>
                                              <th>Employ&#233;</th>
                                              <th>Du</th>
                                              <th>Au</th>
                                              <th>Type</th>
                                              <th>Commentaire</th>
                                             
                                              <th></th>
                                 
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                       <?php

                                $select = "select * from conge where etat=0 order by id desc ";

                                $resultat = mysqli_query($connexion,$select);
                                while ($data_group = mysqli_fetch_array($resultat)) {
                                    $id_employe = $data_group['user']; ?>   
                        
                                            <tr id="<?php echo $data_group["id"]; ?>">
                                            <td><?php echo $data_group["id"]; ?></td>
                                            <td  align="left">  <?php
                                            $id_type = $data_group['type'];
                                            $data_employe = mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$id_employe'"));
                                            echo html_entity_decode($data_employe['nom'] . ' ' . $data_employe['prenom']);
                                            ?> 
                                            </td>
                                            <td  align="left"> <?php echo $data_group['du']; ?>  </td>
                                            <td  align="left">  <?php echo $data_group['au']; ?> </td>
                                        

                                                <td  align="left"> 

                                                  <?php
                                                  $select2 = "select * from type_conge order by id asc";
                                                  $resultat2 = mysqli_query($connexion,$select2);
                                                  while ($data_type = mysqli_fetch_array($resultat2)) {
                                                      if ($data_type['id'] == $data_group['type']) {
                                                          echo html_entity_decode($data_type['titre']);
                                                      }
                                                  }
                                            ?>
                                            </td>
                                        
                                    
                                                
                                                
                                                <td  align="left">  <?php echo $data_group['commantaire']; ?> </td>
                                            
                                        
                                        
                                        <td class="text-left hidden-mobile" style="width:300px;">
                                           
                        
                                            <a  href="liste-conge.php?valider2=<?php echo html_entity_decode($data_group['id']); ?>"   class="btn medium primary-bg">
                                             <span class="button-content"> <?php if ($data_group['type'] == 2) {
                                                    echo "Accuser r&#233;ception";
                                                } else {
                                                    echo "Valider";
                                                } ?>     </span> 
                                            </a>
                    
                                                
                                            <a   href="liste-conge.php?annuler=<?php echo html_entity_decode($data_group['id']); ?>" class="btn medium primary-bg">
                                             <span class="button-content"> Refuser </span> </a>
                                             <?php
                                                   
                                                $id = $data_group['id'];

                                                $data_conge = mysqli_fetch_array(mysqli_query($connexion,"select * from conge where id='$id'"));

                                                $du = $data_conge['du'];
                                                $au = $data_conge['au'];
                                                $type = $data_conge['type'];
                                                $email = $data_conge['user'];
                                                 
                                                $data_nbr_jrs = dateDiffInDays($du,$au);


                                                $data_type_conge = mysqli_fetch_array(mysqli_query($connexion,"select * from type_conge where id='$type'"));
                                                $data_employe = mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$email'"));
                                                $lien = $data_type_conge['lettre'];
                                                $id_employe = $data_employe['id'];

                                                $msg = "http://localhost/conge/demande/$lien?id=$id_employe&du=$du&au=$au&nbr=$data_nbr_jrs&type=$type";
                                                ?>
                                                <a   href="<?php echo $msg; ?>" target="_blank" class="btn medium primary-bg">
                                                 <span class="button-content"> Consulter </span> </a>

                                                 <?php if ($data_group['certificat'] != "") { ?>
                                                 <a  style="margin-top: 10px;"  href="./piece_joint/<?php echo ($data_group['certificat']); ?>" target="_blank" class="btn medium primary-bg">
                                                 <span class="button-content"> consulter certificat medical </span> </a>
                                             <?php } ?>
                                                
                                        </td>
                                   </tr>
                            
                            
                            
                        <?php  } ?>

                                   
                                   
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
