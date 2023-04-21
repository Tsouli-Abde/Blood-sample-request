<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $i = $_POST['ipp']; 
            $n_p = $_POST['nom_pat']; 
            $p_p = $_POST['prenom_pat']; 
            $a_p = $_POST['age_pat']; 
            $s_p = $_POST['sexe_pat']; 

            $result = mysqli_query($con, "UPDATE patient SET IPP='$i', nom_P='$n_p', prenom_P='$p_p', age='$a_p', sexe='$s_p' WHERE IPP='$i'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=UserGestionPatient.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=UserGestionPatient.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>