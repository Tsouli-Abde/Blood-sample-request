<?php
 include("connectionBD.php");
 if(isset($_GET['id']) && !empty($_GET['id']))
 {
     $getid  = $_GET['id'];
     $update = "UPDATE demande SET Etat='1' WHERE num_demande='".$getid."'";
     $result = mysqli_query($con, $update);
     if ($result)
     {
         echo "<script>alert('Demande traitée !');</script>";
         header("refresh: 0, url=AdminGestionDemande.php");
         exit;
     }
     else
     {
         echo "<script>alert('Traitement a échoué !');</script>";
         header("refresh: 0, url=AdminGestionDemande.php");
         exit;        }
 }
 else
 {
     echo "Aucun identifiant trouvé !";
 }
?>