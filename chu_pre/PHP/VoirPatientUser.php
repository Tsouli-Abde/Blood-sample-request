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
        <title>CHU - Patient</title>
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
                        <a href="UserProfil.php">
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
            <?php include("sidebarUser.php"); ?>
                <ul>
                    <li>
                        <a href="AdminAccueil.php">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="item">Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="UserGestionPatient.php" class="active">
                            <span class="icon"><i class="bi bi-person-lines-fill"></i></span>
                            <span class="item">Gestion des patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="UserGestionDemande.php" >
                            <span class="icon"><i class="bi bi-journals"></i></span>
                            <span class="item">Gestion des demandes</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php                  
                include("connectionBD.php");
                $idp = $ipp = $np = $pp = $ap = $sp = $s = $n = "";
                if(isset($_GET['id']) && !empty($_GET['id']))
                {
                    $get_ipp = $_GET['id'];
                    $request = "SELECT * FROM patient where IPP='".$get_ipp."'";
                    $result  = mysqli_query($con, $request);                    
                    if ($result)
                    {
                        while($ligne = mysqli_fetch_object($result)) 
                        {
                            $ipp = $get_ipp;
                            $idp = $ligne->id_patient;
                            $np  = $ligne->nom_P;
                            $pp  = $ligne->prenom_P;
                            $ap  = $ligne->age;
                            $sp  = $ligne->sexe;

                            $res_n = mysqli_query($con ,"SELECT COUNT(*) AS nbr FROM demande WHERE id_patient='$idp' AND Actif='1'");
                            while($ligne_n = mysqli_fetch_object($res_n)) 
                            {
                                $n = $ligne_n->nbr;
                            }

                            if($sp == 'M')
                            {
                                $s = 'Homme';
                            }
                            else
                            {
                                $s = 'Femme';
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
                    <span id="titre">Voici les détails de ce patient</span>
                </div>
                <div class="content">
                    <form name="form" action="" method="POST">
                        <h4 class="titres">Informations Demandes :</h4>
                        <label>Nombre Demandes :</label>
                        <input type="text" name="nbr_dem" value="<?php echo $n; ?>" readonly>

                        <h4 class="titres titre">Information Patients :</h4>
                        <label>IPP :</label>
                        <input type="text" name="ipp"        value="<?php echo $ipp; ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_pat"    value="<?php echo $np; ?>"  readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_pat" value="<?php echo $pp; ?>"  readonly>
                        <label>Age :</label>
                        <input type="text" name="age_pat"    value="<?php echo $ap; ?>"  readonly class="input">
                        <label>Sexe :</label>
                        <input type="text" name="sexe_pat"   value="<?php echo $s; ?>"   readonly>
                        
                        <a href="ModifierPatientUser.php?id=<?php echo $ipp; ?>">
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