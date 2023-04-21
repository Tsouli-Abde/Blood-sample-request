<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $ipp = $_POST['ipp'];
        $nom_pat = $_POST['nom_pat'];
        $prenom_pat = $_POST['prenom_pat'];
        $age_pat = $_POST['age_pat'];
        $sexe_pat = $_POST['sexe_pat'];
        $query = mysqli_query($con,"INSERT INTO patient (IPP, nom_P, prenom_P, age, sexe) VALUES ('$ipp','$nom_pat','$prenom_pat','$age_pat','$sexe_pat')");
        mysqli_close($con);
        header("location: AdminGestionPatient.php");
    }
?>		
