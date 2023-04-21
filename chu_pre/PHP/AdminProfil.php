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
        <link rel="stylesheet" href="../CSS/ProfilStyle.css">
        <link rel="icon"       href="../Images/Icon.jpg">
        <title>CHU - Profil</title>
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
                        <a href="AdminProfil.php" style="color:rgb(180, 240, 250);">
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
                        <a href="Accueil.php">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="item">Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionUtilisateur.php">
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
                            <span class="icon"> <i class="bi bi-eyedropper"></i></span>
                            <span class="item">Gestion des tubes</span>
                        </a>
                    </li>
                    <li>
                    <a href="AdminGestionService.php">
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
                $r = $s = $n = "";
                $tag     = $_SESSION['tag_rfid'];
                $request = "SELECT * FROM utilisateurs where TAG_RFID='".$tag."'";
                $result  = mysqli_query($con, $request);                    
                if ($result)
                {
                    while($ligne = mysqli_fetch_object($result)) 
                    {
                        $idu = $ligne->id_user;
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
                    } 
                }
            ?>
            <div class="body-content">
                <div class="body">
                    <span id="titre">Votre Profil</span>
                </div>
                <div class="content">
                    <form name="form" action="" method="POST">
                        <h4 class="titres">Vos Informations :</h4>
                        <label class="labels">TAG_RFID :</label>
                        <input class="inputs" type="text" name="tag_rfid"    value="<?php echo $_SESSION['tag_rfid']; ?>" readonly>
                        <br>
                        <label class="labels">Nom :</label>
                        <input class="inputs" type="text" name="nom_uti"     value="<?php echo $_SESSION['nom']; ?>"      readonly class="input">
                        <br>
                        <label class="labels">Prénom :</label>
                        <input class="inputs" type="text" name="prenom_uti"  value="<?php echo $_SESSION['prenom']; ?>"   readonly>
                        <br>
                        <label class="labels">Role :</label>
                        <input class="inputs" type="text" name="role_uti"    value="<?php echo $r; ?>"  readonly class="input">
                        <br>
                        <label class="labels">Service :</label>
                        <input class="inputs" type="text" name="service_uti" value="<?php echo $s; ?>"  readonly>

                        <h4 class="titres titre">Tâches Effectuées :</h4>
                        <label class="labels">Nombre Demandes :</label>
                        <input class="inputs" type="text" name="nbr_dem" value="<?php echo $n; ?>" readonly class="input">
                        <br>
                        <label class="labels">Demandes Erronées :</label>
                        <input class="inputs" type="text" name="dem_err" value="" readonly>

                        <a href="javascript:history.go(-1)">
                            <input type="button" name="Retour" value="Retour" id="Retour" class="Retour">
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/Menu.js"></script>
        <script src="../JS/script.js"></script>
    </body>
</html>