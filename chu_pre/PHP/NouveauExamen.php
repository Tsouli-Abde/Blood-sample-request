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
        <link rel="stylesheet" href="../CSS/AjouterStyle.css">
        <link rel="icon"       href="../Images/Icon.jpg">
        <title>CHU - Nouveau Examen</title>
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
            <?php include("sidebar.php")?>
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
                        <a href="AdminGestionDemande.php">
                            <span class="icon"><i class="bi bi-journals"></i></span>
                            <span class="item">Gestion des demandes</span>
                        </a>
                    </li>
                    <li>
                        <a href="AdminGestionExamen.php" class="active">
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
            <div class="body-content">
                <div class="body">
                    <span id="titre">Nouveau Examen</span>
                </div>
                <div class="content">
                    <form name="form" action="examen.php" method="POST">
                        <h4 class="titres">Informations Créateur :</h4>
                        <label>Date Création :</label>
                        <input type="text" name="date_cre"   value="<?php echo date("H:i:s - d/m/Y"); ?>" readonly>
                        <br>
                        <label>Nom :</label>
                        <input type="text" name="nom_cre"    value="<?php echo $_SESSION['nom']; ?>" readonly class="input">
                        <label>Prénom :</label>
                        <input type="text" name="prenom_cre" value="<?php echo $_SESSION['prenom']; ?>"  readonly>

                        <h4 class="titres titre">Informations Examen :</h4>
                        <label>Code Examen :</label>
                        <input type="text" name="code_e"        placeholder="Code" autofocus required>
                        <br>
                        <label>Description :</label>
                        <input type="text" name="description_e" placeholder="Description" required>
                        <br>
                        <label>Laboratoire :</label>
                        <select name="select_labo" class="input" required>                            
                            <option value="" disabled selected>Choisir un laboratoire</option>
                                                    <?php
                                                        $sql = "SELECT * FROM labo";  
                                                        $req = mysqli_query($con,$sql);
                                                        while($row=mysqli_fetch_assoc($req))
                                                        { 
                                                            echo '<option value="'.$row['id_labo'].'">'.$row['code_L'].'</option>'; 
                                                        }
                                                    ?>            
                        </select>
                        <label>Tube :</label>
                        <select name="select_tube" required>                            
                        <option value="" disabled selected>Choisir un tube</option>
                                                    <?php
                                                        $sql = "SELECT * FROM tubes";  
                                                        $req = mysqli_query($con,$sql);
                                                        while($row=mysqli_fetch_assoc($req))
                                                        { 
                                                            echo '<option value="'.$row['id_tube'].'">'.$row['code_tube'].'</option>'; 
                                                        }
                                                    ?>     
                        </select>
                        <input type="reset"  name="Annuler" value="Annuler">
                        <input type="submit" name="Valider" value="Valider">
                    </form>
                </div>
            </div>
        </div>
        <script src="../JS/main.js"></script>
        <script src="../JS/script.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
    </body>
</html>