<?php 
session_start();
include("inc/securite/conexion.php");

$i=0;
$jrs=1;

//$id=$idemploye; 

if(!isset($_SESSION['loginAdmin'])){
     
header("Location: index.php");
}
        
        

if(isset($_POST['update'])){


        if(isset($_POST['date']) && $_POST['date']!=""  ){
      
          
            $date=addslashes($_POST['date']); 
            $type=addslashes($_POST['type']); 
            $etat=addslashes($_POST['etat']); 
            $employe=addslashes($_GET['id']); 
           
            $requete="INSERT INTO `absence` (`id`, `employe`, `date`, `type`, `etat`) VALUES (DEFAULT, '$employe', '$date', '$type', '$etat');";
          
            mysqli_query($connexion,$requete);
            $i=1;
          
          
        
       

            }else{
                $i=2;
                $err="Une erreur s\'est produite lors de la modification du medecin, veuillez verifier les champs";
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
 
    <!-- Top Bar -->
    
    <!-- #Top Bar -->
    <section>
        
       <?php include('header.php'); ?>
     
    </section>
    <section class="content" style="margin: 70px 15px 0 315px;">
        <?php   
            if($i==1){
?>
       
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #15ae60;">
                        <b>Felicitation !</b> Absence bien déclaré
                    </p>
          
                            <?php
    }





?>
        <div class="container-fluid">
            <div class="block-header">
                <h3>
    Absences
    <small>
       Déclarer une absence
     
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
                                        <b>Date :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Type :</b>
                                    </p>
                                    <select  name="type" class="form-control show-tick"  data-selected-text-format="count" tabindex="-98">
                                        <option value="0">Journée</option>
                                        <option value="1">demi-journées</option>
                                          
                                    </select>
                                    <br>
                               
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Etat :</b>
                                    </p>
                                    <select  name="etat" class="form-control show-tick"  data-selected-text-format="count" tabindex="-98">
                                        <option value="0">Justifié</option>
                                        <option value="1">Non Justifié</option>
                                          
                                    </select>
                                    <br>
                               
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
