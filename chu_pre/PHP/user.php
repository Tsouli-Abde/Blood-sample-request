<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $tag_rfid = $_POST['tag_rfid'];
        $nom_pre = $_POST['nom_pre'];
        $prenom_pre = $_POST['prenom_pre'];
        $role_pre = $_POST['role_pre'];
        $user_c = $_POST['nom_cre'].' '.$_POST['prenom_cre'];
        $date_c = $_POST['date_cre'];
        $id_s = $_POST['select_s'];
        $actif = 1;
        
        $query = mysqli_query($con,"INSERT INTO utilisateurs (login, mdp, nom, prenom, TAG_RFID, role, 
        User_creation, Date_creation, User_update, Date_update, Actif, id_service) 
        VALUES ('$login','$mdp','$nom_pre','$prenom_pre','$tag_rfid','$role_pre','$user_c','$date_c','Aucun','','$actif','$id_s')");
        mysqli_close($con);
        header("location: AdminGestionUtilisateur.php");
    }
?>		
