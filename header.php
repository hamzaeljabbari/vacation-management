 <?php 

        $id=strip_tags(htmlentities(addslashes($_SESSION['id_employe']))); 
        $data_employe=mysqli_fetch_array(mysqli_query($connexion,"select * from employe where id=$id"));
        
  ?>
         
<style type="text/css">
    .theme-red .navbar {
    background-color: #357eb9;
}
.navbar-brand {
    margin-left: 550px !important;
}
</style>
<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
               
                <a class="navbar-brand" href="index.html"><?php echo $title_header; ?></a>
            </div>
           
        </div>
    </nav>
 <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <?php if($data_employe['image']==''){ ?>
                    <img src="images/user.png" width="80" height="80" alt="User" style="margin-left: 105px;"  />
                <?php } else { ?>
                    <img src="images_employe/<?php echo $data_employe['image']; ?>" width="80" height="80" alt="User" style="margin-left: 105px;" />
                <?php } ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data_employe['nom'].' '.$data_employe['prenom']; ?></div>
                    <div class="email"><?php echo $data_employe['email']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                           
                           
                            <li><a href="inc/deconnexion.php"><i class="material-icons">input</i>Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <?php 
                    if($data_employe['etat']==1){ ?>
                    <li class="header"></li>
                    <li>
                        <a href="dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>Espace personnelle</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="ajouter-un-conge.php">Déclarer un congé</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="mes_absence.php" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Mes absences</span>
                        </a>
                      
                    </li>


                <?php } ?>
                <?php 
                    if($data_employe['etat']==0){ ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>Gestion des employés</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="ajouter-employe.php">Ajouter un employé</a>
                            </li>
                            <li>
                                <a href="liste-employe.php">Liste des employés</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Gestion des Congés</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="liste-conge.php">Congé en attente</a>
                            </li>
                            <li>
                                <a href="liste-conge-valide.php">Congé validé</a>
                            </li>
                            <li>
                                <a href="liste-conge-refuse.php">Congé refusé</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="liste_absence.php" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Liste absences</span>
                        </a>
                      
                    </li>
                <?php } ?>
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2022 - 2023 <a href="javascript:void(0);">LP TA IAM  SALE 2022 </a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>