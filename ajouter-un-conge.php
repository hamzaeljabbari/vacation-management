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


        if(isset($_POST['du']) && $_POST['du']!="" && isset($_POST['au']) && $_POST['au']!="" ){
         /*echo utf8_encode( strip_tags(addslashes( $_POST['commantaire']))); die();*/
             
         
            $tmp_file= $_FILES['img']['tmp_name'];
            $name= $_FILES['img']['name']; 
            $content_dir = './piece_joint/'; 
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

            function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
} 
            $du=date($_POST['du']); 
            $au=date($_POST['au']);
            $type=addslashes($_POST['type']); 
           
            $nbr_jrs=addslashes($_POST['nbr_jrs']); 
            $commantaire=addslashes($_POST['commantaire']);
            $user=$_SESSION['email'];
            $date_insertion=date('Y-m-d H:i:s');
         
           
            $dateDiff = dateDiffInDays($du, $au); 
  

            $data_nbr_jrs=$dateDiff;

        
            $year_now=date('Y');
            $year_old=date('Y')-1;


            $idemploye=$_SESSION['email'];
  
            $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where email='$idemploye'"));

     
            $id_employe=$data_employe['id'];
           
          
              
        function dateDiffInDays2($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return $diff; 
} 

      
            $date_now =date('Y-m-d');
            $dateDiff = dateDiffInDays2($du, $au); 
            $dateDiff2 = dateDiffInDays2($date_now, $du); 
           

           
               if($dateDiff>=0 and $dateDiff2>=0 ){

              
              
           
            $jrs=1;
            
            $data_conge=mysqli_fetch_array(mysqli_query($connexion,"select sum(au-du) as jrs from conge where etat=1 and user='$user' and type=1 and YEAR(du)=$year_now"));
            $data_conge_old=mysqli_fetch_array(mysqli_query($connexion,"select sum(au-du) as jrs from conge where etat=1 and user='$user' and type=1 and YEAR(du)=$year_old"));
            $congeold=0;
            $congenow=$nbr_jrs_conge-$data_conge['jrs'];

            if($data_conge_old['jrs']<$nbr_jrs_conge)
            {
            $congeold=$nbr_jrs_conge-$data_conge_old['jrs'];

            }
            $conge_disponible=$congenow;   


            if ($data_nbr_jrs>$conge_disponible or $conge_disponible==0)
            {
               $jrs=0;
            } else if($nbr_jrs>$data_nbr_jrs and $nbr_jrs>0 or  $nbr_jrs<$data_nbr_jrs and $nbr_jrs>0){
                 $jrs=2;
            } else {
                    $requete="INSERT INTO `conge` (`id`,`employe`, `du`, `au`, `type`, `certificat`, `etat`, `commantaire`, `date_insertion`, `user`) VALUES (DEFAULT,'$id_employe', '$du', '$au', '$type', '$db_name', 0, '$commantaire', '$date_insertion', '$user')";
          
            mysqli_query($connexion,$requete);
            $i=1;
            $data_conge=mysqli_fetch_array(mysqli_query($connexion,"select * from type_conge where id='$type'"));
          
            $lien=$data_conge['lettre'];
            $titre=$data_conge['titre'];

            $msg="http://localhost/conge/demande/".$lien."?id=$id_employe&du=$du&au=$au&nbr=$data_nbr_jrs&type=$type";
          

            //mail('rh@ecamaroc.com','Demande congé',$msg);


      
            $subject = "New Message from " . strip_tags(htmlentities(addslashes($user)));
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header .= 'From:'. strip_tags(htmlentities(addslashes($user)))  . " \r\n";
        
            
            
            $message = "Bonjour  <br>

            Veuillez trouver ci-joint ma demande de congé : <a href='".$msg."' >Consulter</a> <br> ";
            $message.="Type congé : $titre <br> Cordialement " ;
            
        
            
            mail('tiroxaam.96@gmail.com',
            $subject,
            $message,
            $header); 



          
            }

             

 } else { $verif=2;}


           
       

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
<?php 
             $year_now=date('Y');
             $year_old=date('Y')-1;
             $user=$data_employe['email'];
             $nbr_jr_fr=0;
             $jrs_fr=array();

            $req_ferier=mysqli_query($connexion,"select * from jour_ferier ");
            while ($data_ferier=mysqli_fetch_array($req_ferier)) {

                $req_c=mysqli_query($connexion,"select * from conge where etat=1 and user='$user'  and type=1 and YEAR(du)=$year_now ");
                        while ($data_c=mysqli_fetch_array($req_c)) {
                            if($data_c['du']<=$data_ferier['date'] and $data_c['au']>=$data_ferier['date'] ){
                                $nbr_jr_fr++;
                                $jrs_fr[]=$data_ferier['id'];
                            }
              
                                 }



                                 $req_c2=mysqli_query($connexion,"select * from conge where etat=1 and user='$user'  and type=1 and YEAR(du)=$year_old ");
                        while ($data_c2=mysqli_fetch_array($req_c2)) {
                            if($data_c2['du']<=$data_ferier['date'] and $data_c2['au']>=$data_ferier['date'] ){
                                $nbr_jr_fr++;
                                $jrs_fr[]=$data_ferier['id'];
                            }
              
                                 }
              
            }
          
            $data_conge=mysqli_fetch_array(mysqli_query($connexion,"select sum(au-du) as jrs from conge where etat=1 and user='$user'  and type=1 and YEAR(du)=$year_now "));
            $data_conge_old=mysqli_fetch_array(mysqli_query($connexion,"select sum(au-du) as jrs from conge where etat=1 and user='$user'  and type=1  and YEAR(du)=$year_old"));
       
            $congeold=0;
            $congenow=$nbr_jrs_conge-$data_conge['jrs'];

            if($data_conge_old['jrs']<$nbr_jrs_conge)
            {
            $congeold=$nbr_jrs_conge-$data_conge_old['jrs'];

            }
            $conge_disponible=$congenow-$nbr_jr_fr;





             ?>

             
    <section class="content" style="margin: 70px 15px 0 315px;">
        <?php   
            if($i==1){
?>
       
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #15ae60;">
                        <b>Felicitation !</b> cong&#233; bien ajouter
                    </p>
          
                            <?php
    }

if($i==3){
?>
       
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #f16e04;"><b>Erreur !</b> Ce cong&#233;  existe d&#233;ja</p>
              
        <?php
}

if($jrs==0){
?>
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #f16e04;"><b>Erreur !</b> Vous avez terminé le nombre de jours dont vous disposez</p>
             
        <?php
}

if($jrs==2){
?>
       
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #f13232;"><b>Erreur !</b> Le nombre de jours est incorrect</p>
         
        <?php
}

if($verif==1){
?>
         
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #f13232;"><b>Erreur !</b> Cette p&#233;riode est indisponible</p>
            
        <?php
}

if($verif==2){
?>
        
                    <p style="color: white;padding: 10px 8px 10px 13px;background: #f13232;"><b>Erreur !</b> Cette date est indisponible</p>
           
        <?php
}

?>
        <div class="container-fluid">
            <div class="block-header">
                <h3>
    Cong&#233;s
    <small>
       D&#233;clarer un cong&#233;
     
    </small>
    <h5 style="float: right;">Vous avez le droit de <label style="color: white;
    font-weight: 700;
    background: #f44336;
    padding: 5px;">   <?php echo $conge_disponible; ?> Jours  </label></h5>
     <br>
 
</h3>


            </div>

            


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                        <form name="frm"  method="post" action="" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p>
                                        <b>Type :</b>
                                    </p>
                                    <select onchange="affiche_jr(this.value)" name="type" class="form-control show-tick"  data-selected-text-format="count" tabindex="-98">
                                        <option value="0">...</option>
                                           <?php
                   
                                            $select ="select * from type_conge order by id asc";
                                            $resultat=mysqli_query($connexion,$select); 
                                            while($data_type=mysqli_fetch_array($resultat)){
                    
                                              ?>  
                                             <option value="<?php echo $data_type['id']; ?>">
                                                    <?php echo html_entity_decode($data_type['titre']); ?>
                                            </option>
                                               <?php } ?>
                                    </select>
                                    <br>
                                <label id="msg" style="font-size: 10px; color: red; display: none;">Vous avez le droit de <span id="nbr_jr"></span> jours</label>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Commantaire :</b>
                                    </p>
                                    <input type="text" name="commantaire" class="form-control" placeholder="Username">
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p>
                                        <b>Du :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="du" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <p>
                                        <b>Au :</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="au" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <input required type="hidden" name="nbr_jrs" id="nbr_jrs" style="width:250px;">
                            <div class="row clearfix">
                                <div class="col-md-6"  id="certificat" style="display: none;">
                                    <p>
                                        <b>Certificat :</b>
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
    <script type="text/javascript">
         function affiche_jr(id){
                        if(id=='2'){document.getElementById('certificat').style.display='';} 
                            else {document.getElementById('certificat').style.display='none';}
                    num = 1;
                    $.post("./aide.php",{id:id,num:num},function(data){
                   
                      
                       if(data>0)
                       {
                         document.getElementById("nbr_jr").innerHTML=data;
                            document.getElementById("nbr_jrs").value=data;
                             document.getElementById("msg").style.display='block';
                            
                       }else {
                         document.getElementById("msg").style.display='none';
                       }
                           

                        
                      

                    });
                       }
                
            
</script>
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
