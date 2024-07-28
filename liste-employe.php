<?php 
session_start();
include("inc/securite/conexion.php");

$i=0;
$jrs=1;



if(!isset($_SESSION['loginAdmin'])){
     
header("Location: index.php");
}
        $idemploye=$_SESSION['email'];
        $id=$idemploye; 
        $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$id'"));

        $nbr_jrs_conge=$data_employe['base_taux'];
        $id_employe=$data_employe['id'];
         $verif=0;
         $i=0;
         $jrs=100;
          $verif2=0;

if(isset($_POST['update'])){


        if(isset($_POST['nom']) && $_POST['nom']!="" && isset($_POST['email']) && $_POST['email']!="" ){
        

           
            $nom=addslashes($_POST['nom']); 
            $prenom=addslashes($_POST['prenom']);   
            $adresse=addslashes($_POST['adresse']); 
            $tel=addslashes($_POST['tel']); 
            $email=addslashes($_POST['email']);
            $cin=addslashes($_POST['cin']); 
            $date_naissance=addslashes($_POST['date_naissance']); 
            $fix=addslashes($_POST['fix']); 
            $base_taux=addslashes($_POST['base_taux']); 
            $password= sha1(md5($_POST['password']));

            $etat=1; 
            $user=$_SESSION['email'];
            $date=date('Y-m-d H:i:s');
            
  
            
             $requete="INSERT INTO `gc`.`employe` (`id`, `nom`, `prenom`, `date_naissance`, `adresse`, `cin`, `tel`, `base_taux`, `email`, `password`, `etat`, `user`, `date_insertion`) VALUES (DEFAULT, '$nom', '$prenom', '$date_naissance', '$adresse', '$cin', '$tel', '$base_taux', '$email', '$password', '$etat', '$user', '$date')";
          
            mysqli_query($connexion,$requete);
           $i=1;
          
           
       

            }else{
                $i=2;
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
    Employés
    <small>
       Listes employé
     
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
                                            <th>Nom & Prenom</th>
                                            <th>Adresse</th>
                                            <th>Téléphone</th>
                                            <th>CIN</th>
                                            <th>Email</th>
                                            <th></th>
                                 
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php
       
                                            $select ="select * from employe order by id desc";
                                            $resultat=mysqli_query($connexion,$select); 
                                            while($data_group=mysqli_fetch_array($resultat)){
                                        
                                         ?>
                                        <tr id="<?php echo $data_group['id']; ?>">
                                            <td><?php echo html_entity_decode($data_group['nom'].' '.$data_group['prenom']); ?></td>
                                            <td><?php echo html_entity_decode($data_group['adresse']); ?></td>
                                            <td><?php echo html_entity_decode($data_group['tel']); ?></td>
                                            <td><?php echo html_entity_decode($data_group['cin']); ?></td>
                                            <td><?php echo html_entity_decode($data_group['email']); ?></td>
                                            <td>
                                                <a style="text-decoration: underline;" href="modifier-employe.php?id=<?php echo html_entity_decode($data_group['id']); ?>"   class="">
                                                    <span class="">
                                                         Modifier
                                                     </span>
                                                 </a>
                                                 <a  style="text-decoration: underline; color: red;" href="#"   onClick="supprimer('<?php echo html_entity_decode($data_group['id']); ?>');" class="">
                                                    <span class="">
                                                        Supprimer
                                                    </span>
                                                 </a>
                                                  <a style="text-decoration: underline;" href="ajouter-absence.php?id=<?php echo html_entity_decode($data_group['id']); ?>"   class="">
                                                    <span class="">
                                                         Déclarer absence
                                                     </span>
                                                 </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                   
                                   
                                         
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
