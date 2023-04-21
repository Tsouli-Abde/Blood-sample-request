<?php
    session_start(); 
    if(!isset($_SESSION['nom']))  echo "<script> window.location.replace('login.php'); </script>";
?>
<?php
                include("connectionBD.php");
                $get_ipp = "";
                if(isset($_GET['id']) && !empty($_GET['id']))
                {
                    $get_ipp = $_GET['id'];
                }
                else
                {
                    echo "Aucun identifiant trouvé !";
                }
            ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"              content="width=device-width, initial-scale=1.0">
        <link href="../CSS/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="../CSS/bootstrap.min.css"             rel="stylesheet">
        <link rel="stylesheet" href="../CSS/AjouterStyle.css">
        <link rel="icon"       href="../Images/Icon.jpg">
        <title>CHU - Modifier Patient</title>
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
            <?php include("sidebarUser.php"); ?>
                <ul>
                    <li>
                        <a href="Accueil.php">
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
            <div class="body-content">
                <div class="body">
                    <span id="titre">Modification de la demande</span>
                </div>
                <div class="content">
                    <form name="form" action="UpdatePatient.php" method="POST">
                    <h4 class="titres">Informations Modificateur :</h4>
                        <label>Date Modification :</label>
                        <input type="text" name="date_cre"   value="<?php echo date("H:i:s - d/m/Y"); ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_cre"    value="<?php echo $_SESSION['nom']; ?>" readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_cre" value="<?php echo $_SESSION['prenom']; ?>" readonly>

                        <h4 class="titres titre">Modifier Patient :</h4>
                        <label>IPP :</label>
                        <input type="text" name="ipp"   value="<?php echo $get_ipp; ?>"  readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text"  name="nom_pat"    placeholder="Nom" class="input" required>
                        <label>Prénom :</label>
                        <input type="text"  name="prenom_pat" placeholder="Prénom" required>
                        <label>Age :</label>
                        <input type="text"  name="age_pat"    placeholder="Age" class="input" required>
                        <label>Sexe :</label>
                        <input type="radio" name="sexe_pat"  value="F" required>Femme
                        <input type="radio" name="sexe_pat"  value="M" required>Homme
            
                        <input type="reset"  name="Annuler" value="Annuler">
                        <input type="submit" name="Valider" value="Valider">
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/script.js"></script>
        <script src="../JS/Main.js"></script>
        <script src="../JS/Menu.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
    </body>
</html>