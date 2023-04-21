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
        <title>CHU - Gestion Patient</title>
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
                    <span id="titre">Listes des patients</span>
                    <span id="ajout"><span>+</span> <a href="NouveauPatientUser.php">Nouveau Patient</a></span>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>IPP    </th>
                                <th>Nom    </th>
                                <th>Prénom </th>
                                <th>Sexe   </th>
                                <th>Age    </th>
                                <th>Actions</th>
                                <th>Autres </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("connectionBD.php");
                                $resultat = mysqli_query($con ,"SELECT * FROM patient"); 
                                if($resultat) 
                                { 
                                    while($ligne = mysqli_fetch_object($resultat))
                                    {
                                        if($ligne->sexe == 'M')
                                        {
                                            $sexe = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16" style="color: rgb(0, 120, 220);">
                                                        <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                                     </svg>';
                                        }
                                        else
                                        {
                                            $sexe = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" fill="currentColor" class="bi bi-gender-female" viewBox="0 0 16 16" style="color: rgb(280, 120, 150);">
                                                        <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                                                     </svg>';
                                        }
                                        echo '<tr>
                                                <td>'.$ligne->IPP .    '</td>
                                                <td>'.$ligne->nom_P .  '</td>
                                                <td>'.$ligne->prenom_P.'</td>
                                                <td align = "center">'.$sexe.'</td>
                                                <td>'.$ligne->age .    '</td>
                                                <td>
                                                    <a href="VoirPatientUser.php?id='.$ligne->IPP.'">Détail</a>
                                                </td>
                                                <td class="icons">
                                                    <a href="ModifierPatientUser.php?id='.$ligne->IPP.'" class="update">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="SupprimerPatientUser.php?id='.$ligne->IPP.'">
                                                        <i class="bi bi-trash delete"></i>
                                                    </a>
                                                </td>
                                            </tr>';
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