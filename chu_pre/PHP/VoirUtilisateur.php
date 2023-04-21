<?php
    session_start(); 
    if(!isset($_SESSION['nom']))  echo "<script> window.location.replace('login.php'); </script>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"              content="width=device-width, initial-scale=1.0">
        <link href="../CSS/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="../CSS/bootstrap.min.css"             rel="stylesheet">
        <link rel="stylesheet" href="../CSS/VoirStyle.css">
        <link rel="icon"       href="../Images/Icon.jpg">
        <title>CHU - Utilisateur</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="section">
                <div class="top_navbar">
                    <div class="hamburger">
                        <a href="#">
                            <i class="bi bi-list"></i>
                        </a>
                    </div>
                    <div class="hamburger2">
                        <a href="AdminProfil.php">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    </div>
                    <div class="hamburger3">
                        <a href="Logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php include("sidebar.php"); ?>
                <ul>
                    <li>
                        <a href="AdminAccueil.php">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="item">Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionUtilisateur.php" class="active">
                            <span class="icon"><i class="bi bi-people-fill"></i></span>
                            <span class="item">Gestion des utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionPatient.php">
                            <span class="icon"><i class="bi bi-person-lines-fill"></i></span>
                            <span class="item">Gestion des patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionDemande.php">
                            <span class="icon"><i class="bi bi-journals"></i></span>
                            <span class="item">Gestion des demandes</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionExamen.php">
                            <span class="icon"><i class="bi bi-file-earmark-fill"></i></span>
                            <span class="item">Gestion des examens</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionTube.php">
                            <span class="icon"><i class="bi bi-eyedropper"></i></span>
                            <span class="item">Gestion des tubes</span>
                        </a>
                    </li>
                    <li>
                    <a href="AdminGestionService.php" >
                            <span class="icon"><i class="bi bi-building"></i></span>
                            <span class="item">Gestion des services</span>
                        </a> 
                    </li>
                    <li>
                        <a href="AdminGestionLabo.php">
                            <span class="icon"><i class="bi bi-box"></i></span>
                            <span class="item">Gestion des laboratoires</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php                  
                include("connectionBD.php");
                $npc = $dc = $log = $mdp = $idu = $tag = $nu = $pu = $ru = $r = $su = $s = $n = $uu = $du = "";
                if(isset($_GET['id']) && !empty($_GET['id']))
                {
                    $get_tag = $_GET['id'];
                    $request = "SELECT * FROM utilisateurs where TAG_RFID='".$get_tag."'";
                    $result  = mysqli_query($con, $request);                    
                    if ($result)
                    {
                        while($ligne = mysqli_fetch_object($result)) 
                        {
                            $npc = $ligne->User_creation;
                            $dc  = $ligne->Date_creation;
                            $log = $ligne->login;
                            $mdp = $ligne->mdp;
                            $idu = $ligne->id_user;
                            $tag = $ligne->TAG_RFID;
                            $nu  = $ligne->nom;
                            $pu  = $ligne->prenom;
                            $ru  = $ligne->role;
                            $su  = $ligne->id_service;

                            if($ru == 'A')
                            {
                                $r = 'Administrateur';
                            }
                            else
                            {
                                $r = 'Préleveur';
                            }

                            $res_s = mysqli_query($con ,"SELECT * FROM service WHERE id_service='$su'");
                            while($ligne_s = mysqli_fetch_object($res_s))
                            {
                                $s = $ligne_s->code_S;
                            }

                            $res_n = mysqli_query($con ,"SELECT COUNT(*) AS nbr FROM demande WHERE id_user='$idu' AND Actif='1'");
                            while($ligne_n = mysqli_fetch_object($res_n)) 
                            {
                                $n = $ligne_n->nbr;
                            }

                            if($ligne->User_update == 'Aucun')
                            {
                                $uu = $du = 'Aucune modification';
                            }
                            else
                            {
                                $uu = $ligne->User_update;
                                $du = $ligne->Date_update;
                            }
                        } 
                    }
                }
                else
                {
                    echo "Aucun identifiant trouvé !";
                }                
            ?>
            <div class="body-content">
                <div class="body">
                    <span id="titre">Voici les détails de cet utilisateur</span>
                </div>
                <div class="content">
                    <form name="form" action="" method="POST">
                        <h4 class="titres">Informations Créateur :</h4>
                        <label>Nom & Prénom :</label>
                        <input type="text" name="nom_prenom" value="<?php echo $npc; ?>" readonly>

                        <h4 class="titres titre">Informations du Compte :</h4>
                        <label>Date Création :</label>
                        <input type="text" name="date_cre" value="<?php echo $dc; ?>"  readonly>
                        <br>
                        <label>Login :</label>
                        <input type="text" name="login"    value="<?php echo $log; ?>" readonly class="input">
                        <label>Mot de Passe :</label>
                        <input type="text" name="mdp"      value="<?php echo $mdp; ?>" readonly>

                        <h4 class="titres titre">Informations Utilisateur :</h4>
                        <label>TAG_RFID :</label>
                        <input type="text" name="tag_rfid"    value="<?php echo $tag; ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_uti"     value="<?php echo $nu; ?>" readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_uti"  value="<?php echo $pu; ?>" readonly>
                        <label>Role :</label>
                        <input type="text" name="role_uti"    value="<?php echo $r; ?>"  readonly class="input">
                        <label>Service :</label>
                        <input type="text" name="service_uti" value="<?php echo $s; ?>"  readonly>

                        <h4 class="titres titre">Tâches Effectuées :</h4>
                        <label>Nombre Demandes :</label>
                        <input type="text" name="nbr_dem" value="<?php echo $n; ?>" readonly class="input">
                        <label>Demandes Erronées :</label>
                        <input type="text" name="dem_err" value="" readonly>

                        <h4 class="titres titre">Modification :</h4>
                        <label>Effectuée par :</label>
                        <input type="text" name="user_modif" value="<?php echo $uu; ?>" readonly class="input">
                        <label>Date Modification :</label>
                        <input type="text" name="date_modif" value="<?php echo $du; ?>" readonly>

                        <a href="ModifierUser.php?id=<?php echo $tag; ?>">
                            <input type="button" name="Modifier" value="Modifier" id="modifier" class="modifier">
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/script.js"></script>
        <script src="../JS/Menu.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
    </body>
</html>