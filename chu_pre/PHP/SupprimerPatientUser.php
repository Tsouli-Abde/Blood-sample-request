<?php
    include("connectionBD.php");
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $getid  = $_GET['id'];
        $delete = "DELETE FROM patient WHERE IPP='".$getid."'";
        $result = mysqli_query($con, $delete);
        if ($result)
        {
            echo "<script>alert('Suppression avec succés !');</script>";
             header("refresh: 0, url=UserGestionPatient.php");
             exit;
        }
        else
        {
            echo "<script>alert('La suppression a échoué !');</script>";
            header("refresh: 0, url=UserGestionPatient.php");
            exit;
        }
    }
    else
    {
        echo "Aucun identifiant trouvé !";
    }
?>