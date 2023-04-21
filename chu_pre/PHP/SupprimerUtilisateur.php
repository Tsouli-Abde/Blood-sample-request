<?php
    include("connectionBD.php");
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $getid  = $_GET['id'];
        $update = "UPDATE utilisateurs SET Actif='0' WHERE TAG_RFID='".$getid."'";
        $result = mysqli_query($con, $update);
        if ($result)
        {
            echo "<script>alert('Suppression avec succés !');</script>";
            header("refresh: 0, url=AdminGestionUtilisateur.php");
            exit;
        }
        else
        {
            echo "<script>alert('La suppression a échoué !');</script>";
            header("refresh: 0, url=AdminGestionUtilisateur.php");
            exit;        }        
    }
    else
    {
        echo "Aucun identifiant trouvé !";
    }
?>