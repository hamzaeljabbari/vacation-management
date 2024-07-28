<?php
session_start();

$title_header="Gestion Congés";
 
$connexion=mysqli_connect("localhost","root","") or die("erreur");
mysqli_select_db($connexion,"gc") or die ("erreur base");

//


if(isset($_POST['email']) && isset($_POST['pass']) && $_POST['email']!='' && $_POST['pass']!=''){

  

    $email= strip_tags(htmlentities(addslashes($_POST['email'])));
    $pass= sha1(md5($_POST['pass']));
   $requet="select * from `employe` where `email`='$email' and password='$pass'  ";
   
    $result_login=mysqli_query($connexion,$requet) or die(mysql_error());
    $data=mysqli_fetch_assoc($result_login);
    
    if($data['email']==null){ 

    $message_erreur='Email introuvable ou mot de passe incorrecte !';
   } else{
            $_SESSION['thedate']=date('Y-m-d H:i:s');
            $_SESSION['loginAdmin']=$data['id'];
            $_SESSION['id_employe']=$data['id'];
            $_SESSION['email']=$data['email'];
            $date_now=date('Y-m-d').' / '.date('H:i:s');
            $_SESSION['last_visit']=$date_now;
            if($data['etat']==0)
            {
                echo " <script> document.location.href='liste-conge-valide.php';</script>";
            } else
            {
               
                echo " <script> document.location.href='dashboard.php';</script>";
            }
            
        }
 

    
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
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

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>GC</b></a>
            <small><?php echo $title_header; ?></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg" style="color:red"><?php if(isset($message_erreur)){echo $message_erreur;}  ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>