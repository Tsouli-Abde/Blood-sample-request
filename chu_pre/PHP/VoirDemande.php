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
        <title>CHU - Demande</title>
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
                        <a href="AdminGestionDemande.php" class="active">
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
                $get_num_dem = "";
               $tag = $nu = $pu = $ipp = $np = $pp = $idd = $nd = $dd = $dp = $e = $uu = $du = $f_b = $f_h = $f_p = "";
               $tab = array();
                if(isset($_GET['id']) && !empty($_GET['id']))
                {
                    $get_num_dem = $_GET['id'];
                    $request     = "SELECT * FROM demande where num_demande='".$get_num_dem."'";
                    $result      = mysqli_query($con, $request);
                    if ($result)
                    {
                        while($ligne = mysqli_fetch_object($result))
                        {
                            $idu = $ligne->id_user;
                            $idp = $ligne->id_patient;
                            $res_u = mysqli_query($con ,"SELECT * FROM utilisateurs WHERE id_user='$idu'");
                            $res_p = mysqli_query($con ,"SELECT * FROM patient WHERE id_patient='$idp'");
                            while($ligne_u = mysqli_fetch_object($res_u))
                            {
                                while($ligne_p = mysqli_fetch_object($res_p))
                                {
                                    $tag = $ligne_u->TAG_RFID;
                                    $nu  = $ligne_u->nom;
                                    $pu  = $ligne_u->prenom;

                                    $ipp = $ligne_p->IPP;
                                    $np  = $ligne_p->nom_P;
                                    $pp  = $ligne_p->prenom_P;

                                    $idd = $ligne->id_demande;
                                    $nd  = $get_num_dem;
                                    $dd  = $ligne->date_demande;
                                    $dp  = $ligne->date_prelevement;

                                    $res_c = mysqli_query($con ,"SELECT * FROM conteneur WHERE id_demande='$idd'");
                                    while($ligne_c = mysqli_fetch_object($res_c))
                                    {
                                        $e = $ligne_c->id_examen.' '.$e;
                                    }
                                
                                        $tab = explode(" ", $e);
                                        $tab[0] = trim($tab[0]);
                                        $tab[1] = trim($tab[1]);
                                        $tab[2] = trim($tab[2]);
                                    $res_eB = mysqli_query($con ,"SELECT * FROM examens WHERE id_examen='$tab[2]'");
                                    $res_eH = mysqli_query($con ,"SELECT * FROM examens WHERE id_examen='$tab[1]'");
                                    $res_eP = mysqli_query($con ,"SELECT * FROM examens WHERE id_examen='$tab[0]'");
                                    while($eb = mysqli_fetch_object($res_eB))
                                    {
                                        while($eh = mysqli_fetch_object($res_eH))
                                        {
                                            while($ep = mysqli_fetch_object($res_eP))
                                            {
                                                $f_b = $eb->code_E;
                                                $f_h = $eh->code_E;
                                                $f_p = $ep->code_E;
                                            }

                                        }

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
                    }
                }
                else
                {
                    echo "Aucun identifiant trouvé !";
                }
            ?>
            <div class="body-content">
                <div class="body">
                    <span id="titre">Voici les détails de la demande</span>
                </div>
                <div class="content">
                    <form name="form" action="Etat.php" method="POST">
                        <h4 class="titres">Informations Demande :</h4>
                        <label>Numero Demande :</label>
                        <input type="text" name="num_dem"  value="<?php echo $nd; ?>" readonly>
                        <br>
                        <label>Date Demande :</label>
                        <input type="text" name="date_dem" value="<?php echo $dd; ?>" readonly class="input">
                        <label>Date Prélèvement :</label>
                        <input type="text" name="date_pre" value="<?php echo $dp; ?>" readonly>

                        <h4 class="titres titre">Informations Préleveur :</h4>
                        <label>TAG_RFID :</label>
                        <input type="text" name="tag_rfid"   value="<?php echo $tag; ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_pre"    value="<?php echo $nu; ?>"  readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_pre" value="<?php echo $pu; ?>"  readonly>

                        <h4 class="titres titre">Informations Patient :</h4>
                        <label>IPP :</label>
                        <input type="text" name="ipp"        value="<?php echo $ipp; ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_pat"    value="<?php echo $np; ?>"  readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_pat" value="<?php echo $pp; ?>"  readonly>

                        <h4 class="titres titre">Examens :</h4>
                        <label class="label">Biochimie :</label>
                        <input type="text" name="biochimie"     value="<?php echo $f_b; ?>" readonly class="select">
                        <label class="label">Hémathologie :</label>
                        <input type="text" name="hémathologie"  value="<?php echo $f_h; ?>" readonly class="select">
                        <label class="label">Parasitologie :</label>
                        <input type="text" name="parasitologie" value="<?php echo $f_p; ?>" readonly class="select">

                        <h4 class="titres titre">Conformité :</h4>
                        <label class="label">Ordre :</label>
                        <input type="text" name="ordre"   value="Respecté"  readonly class="select">
                        <label class="label">Volume :</label>
                        <input type="text" name="volume"  value="Respecté"  readonly class="select">
                        <label class="label">Couleur :</label>
                        <input type="text" name="couleur" value="Respectée" readonly class="select">

                        <h4 class="titres titre">Modification :</h4>
                        <label>Effectuée par :</label>
                        <input type="text" name="num_dem"  value="<?php echo $uu; ?>" readonly class="input">
                        <label>Date Modification :</label>
                        <input type="text" name="date_dem" value="<?php echo $du; ?>" readonly>

                        <a href="ModifierDemande.php?id=<?php echo $get_num_dem; ?>">
                            <input type="button" name="Modifier" value="Modifier" id="modifier">
                        </a>
                        <a href="Etat.php?id=<?php echo $get_num_dem; ?>">
                        <input type="button" name="Valider"  value="Valider"  id="valider">
                        </a>                    
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/Menu.js"></script>
        <script src="../JS/script.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
    </body>
</html>