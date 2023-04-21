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
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/Style.css">
        <link rel="icon"       href="../Images/icon.jpg">
        <title>CHU - Gestion Utilisateurs</title>
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
                        <a href="Accueil.php">
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
            <div class="body-content">
                <div class="body">
                    <span id="titre">Listes des utilisateurs</span>
                    <span id="ajout"><span>+</span> <a href="NouveauUtilisateur.php">Nouveau Utilisateur</a></span>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>TAG_RFID               </th>
                                <th>Nom       </th>
                                <th>Prénom         </th>
                                <th>Role    </th>
                                <th>Service    </th>
                                <th>Actions</th>
                                <th>Autres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("connectionBD.php");
                                $resultat = mysqli_query($con ,"SELECT * FROM utilisateurs"); 
                                if($resultat) 
                                { 
                                    while($ligne = mysqli_fetch_object($resultat))
                                    {
                                        if($ligne->Actif)
                                        {
                                            $service = $ligne->id_service;
                                            if($ligne->role == 'A')
                                            {
                                                $role = 'Administrateur';
                                            }
                                            else
                                            {
                                                $role = 'Préleveur';
                                            }
                                            $res  = mysqli_query($con ,"SELECT code_S FROM service WHERE id_service='$service'");
                                            if($res)
                                            {
                                                while($ligne_s = mysqli_fetch_object($res))
                                                {
                                                    echo '<tr>
                                                            <td>'.$ligne->TAG_RFID.'</td>
                                                            <td>'.$ligne->nom.     '</td>
                                                            <td>'.$ligne->prenom.  '</td>
                                                            <td>'.$role.           '</td>
                                                            <td>'.$ligne_s->code_S.'</td>
                                                            <td>
                                                                <a href="VoirUtilisateur.php?id='.$ligne->TAG_RFID.'">Détail</a>
                                                            </td>
                                                            <td class="icons">
                                                                <a href="ModifierUser.php?id='.$ligne->TAG_RFID.'" class="update">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                                <a href="SupprimerUtilisateur.php?id='.$ligne->TAG_RFID.'">
                                                                    <i class="bi bi-trash delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>';
                                                }
                                            }
                                        }
                                    }
                                }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="../JS/script.js"></script>
        <script src="../JS/libscripts.bundle.js"></script>
        <script src="../JS/datatablescripts.bundle.js"></script>
        <script src="../JS/jquery-datatable.js"></script>
    </body>
</html>