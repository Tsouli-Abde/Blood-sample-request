<?php
    include("connectionBD.php");
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $getid  = $_GET['id'];
        $update = "UPDATE demande SET Actif='0' WHERE num_demande='".$getid."'";
        $result = mysqli_query($con, $update);
        if ($result)
        {
            echo "<script>alert('Suppression avec succés !');</script>";
            header("refresh: 0, url=UserGestionDemande.php");
            exit;
        }
        else
        {
            echo "<script>alert('La suppression a échoué !');</script>";
            header("refresh: 0, url=UserGestionDemande.php");
            exit;        }
    }
    else
    {
        echo "Aucun identifiant trouvé !";
    }
?>