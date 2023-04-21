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
        <title>CHU - Gestion Demandes</title>
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
                    <span id="titre">Listes des demandes ajoutées</span>
                    <span id="ajout"><span>+</span> <a href="NouvelleDemande.php">Nouvelle Demande</a></span>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Numéro Demande</th>
                                <th>Date Demande  </th>
                                <th>Préleveur     </th>
                                <th>Patient       </th>
                                <th>Etat          </th>
                                <th>Action        </th>
                                <th>Autres        </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $user = '';
                                $patient = '';
                                $resultat = mysqli_query($con ,"SELECT * FROM demande"); 
                                if($resultat) 
                                { 
                                    while($ligne = mysqli_fetch_object($resultat)) 
                                    { 
                                        if($ligne->Actif)
                                        {
                                            $user = $ligne->id_user;
                                            $patient = $ligne->id_patient;
                                            if($ligne->Etat)
                                            {
                                                $etat = 'Traitée';
                                            }
                                            else
                                            {
                                                $etat = 'En cours..';
                                            }
                                            $res  = mysqli_query($con ,"SELECT nom,prenom FROM utilisateurs WHERE id_user='$user'");
                                            if($res)
                                            {
                                                while($ligne_u = mysqli_fetch_object($res))
                                                {
                                                    $res_p  = mysqli_query($con ,"SELECT nom_P,prenom_P FROM patient WHERE id_patient='$patient'");
                                                    if($res_p)
                                                    {
                                                        while($ligne_p = mysqli_fetch_object($res_p))
                                                        {
                                                            echo '<tr>
                                                                    <td>'. $ligne->num_demande .'                   </td>
                                                                    <td>'. $ligne->date_demande .'                  </td>
                                                                    <td>'. $ligne_u->nom.' '.$ligne_u->prenom.'     </td>
                                                                    <td>'. $ligne_p->nom_P.' '.$ligne_p->prenom_P .'</td>
                                                                    <td>'. $etat .'                                 </td>
                                                                    <td>
                                                                        <a href="VoirDemande.php?id='.$ligne->num_demande.'">Détail</a>
                                                                    </td>
                                                                    <td class="icons">
                                                                        <a href="ModifierDemande.php?id='.$ligne->num_demande.'" class="update">
                                                                            <i class="bi bi-pencil-square"></i>
                                                                        </a>
                                                                        <a href="SupprimerDemande.php?id='.$ligne->num_demande.'">
                                                                            <i class="bi bi-trash delete"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>';
                                                        }
                                                    }
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