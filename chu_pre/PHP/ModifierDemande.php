<?php
    session_start(); 
    if(!isset($_SESSION['nom']))  echo "<script> window.location.replace('login.php'); </script>";
    include("connectionBD.php");
    $get_num_dem = "";
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $get_num_dem = $_GET['id'];
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
        <title>CHU - Modifier Demande</title>
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
            <div class="body-content">
                <div class="body">
                    <span id="titre">Modification de la demande</span>
                </div>
                <div class="content">
                    <form name="form" action="UpdateDemande.php" method="POST">
                        <h4 class="titres">Informations Demande :</h4>
                        <label>Numero Demande :</label>
                        <input type="text" name="num_dem"  value="<?php echo $get_num_dem; ?>"            readonly class="input">
                        <label>Date Modification :</label>
                        <input type="text" name="date_mod" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly>

                        <h4 class="titres titre">Informations Modificateur :</h4>
                        <label>TAG_RFID :</label>
                        <input type="text" name="tag_rfid"   value="<?php echo $_SESSION['tag_rfid']; ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_mod"    value="<?php echo $_SESSION['nom']; ?>"      readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_mod" value="<?php echo $_SESSION['prenom']; ?>"   readonly>

                        <h4 class="titres titre">Informations Patient :</h4>
                        <label>IPP :</label>
                        <input type="text" name="ipp"    id="ipp"    placeholder="IPP"    autofocus required onkeyup="GetDetail(this.value)">
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom"    id="nom"    placeholder="Nom"    readonly  required class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom" readonly  required>

                        <h4 class="titres titre">Types Examens :</h4>
                        <label class="label">Biochimie :</label>
                        <select name="select_bio" class="select" required>
                            <option value="" disabled selected >Sélectionner un examen</option>
                            <?php
                                $sql = "SELECT * FROM examens WHERE id_labo='1'";  
                                $req = mysqli_query($con,$sql);
                                while($row=mysqli_fetch_assoc($req))
                                { 
                                    echo '<option value="'.$row['id_examen'].'">'.$row['code_E'].'</option>'; 
                                }
                            ?>       
                        </select>
                        <label class="label">Hémathologie :</label>
                        <select name="select_hem" class="select" required>
                            <option value="" disabled selected>Sélectionner un examen</option>
                            <?php
                                $sql = "SELECT * FROM examens WHERE id_labo='2'";  
                                $req = mysqli_query($con,$sql);
                                while($row=mysqli_fetch_assoc($req))
                                { 
                                    echo '<option value="'.$row['id_examen'].'">'.$row['code_E'].'</option>'; 
                                }
                            ?>                        
                        </select>
                        <label class="label">Parasitologie :</label>
                        <select name="select_par" class="select" required>
                            <option value="" disabled selected>Sélectionner un examen</option>
                            <?php
                                $sql = "SELECT * FROM examens WHERE id_labo='3'";  
                                $req = mysqli_query($con,$sql);
                                while($row=mysqli_fetch_assoc($req))
                                { 
                                    echo '<option value="'.$row['id_examen'].'">'.$row['code_E'].'</option>'; 
                                }
                            ?>                               
                        </select>

                        <input type="reset"  name="Annuler" value="Annuler">
                        <input type="submit" name="Valider" value="Valider">
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/Main.js"></script>
        <script src="../JS/script.js"></script>
        <script src="../JS/Menu.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
        <script src="../JS/Affiche.js"></script>
    </body>
</html>