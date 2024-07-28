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
        


            $tmp_file= $_FILES['img']['tmp_name'];
            $name= $_FILES['img']['name']; 
            $content_dir = './images_employe/'; 
            $i=1;
            if( !is_uploaded_file($tmp_file))
            {
                $i=2;
                $err="Image non trouvée";
            }
                
            $type_file= $_FILES['img']['type'];
            $url_image= $_FILES['img']['name'];
            
                 
                  
          
            $name_file = $_FILES['img']['name'];
            $extention=strrchr($name_file,'.');
            $db_name=md5(rand(1000000,5000000)).$extention;
            if(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file))
            {
                $i=2;
                $err="nom de fichier non valide";
            }
            else if(!move_uploaded_file($tmp_file, $content_dir.$db_name))
            {
                $i=2;
                $err="Impossible de copier le fichier";
            }

            if($i==2) {
                $db_name=NULL;
            }


           
            $nom=addslashes($_POST['nom']); 
            $prenom=addslashes($_POST['prenom']);   
            $adresse= strip_tags(htmlentities(addslashes($_POST['adresse']))); 
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
            
  
            
             $requete="INSERT INTO `gc`.`employe` (`id`, `nom`, `prenom`, `date_naissance`, `adresse`, `cin`, `tel`, `base_taux`, `email`, `password`, `etat`, `user`, `date_insertion`, `image`) VALUES (DEFAULT, '$nom', '$prenom', '$date_naissance', '$adresse', '$cin', '$tel', '$base_taux', '$email', '$password', '$etat', '$user', '$date','$db_name')";
          
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


       <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />




    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

     <!-- Colorpicker Css -->
    <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="plugins/nouislider/nouislider.min.css" rel="stylesheet" />

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
       Nouveau employé
     
    </small>
    
 
</h3>


            </div>

            


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                        <form name="frm"  method="post" action="" enctype="multipart/form-data">
                            <div class="row clearfix">
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Nom :</b>
                                    </p>
                                    <input type="text" name="nom" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>prenom :</b>
                                    </p>
                                    <input type="text" name="prenom" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Téléphone :</b>
                                    </p>
                                    <input type="text" name="tel" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p>
                                        <b>Date naissance :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="date_naissance" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <p>
                                        <b>Adresse :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="">
                                            <input type="text" class="form-control" name="adresse" placeholder="...">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row clearfix">
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>CIN :</b>
                                    </p>
                                    <input type="text" name="cin" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Jours Congés :</b>
                                    </p>
                                    <input type="text" name="base_taux" class="form-control" placeholder="">
                                </div>
                            </div>
                               
                               <div class="row clearfix">
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>Email :</b>
                                    </p>
                                    <input type="text" name="email" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Password :</b>
                                    </p>
                                    <input type="password" name="password" class="form-control" placeholder="">
                                </div>
                               
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6"  id="certificat" >
                                    <p>
                                        <b>Image :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="file" class="form-control" name="img" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                           
                                
                                <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Déclarer</button>
                                </form>
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

     <!-- Bootstrap Colorpicker Js -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>

     <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
