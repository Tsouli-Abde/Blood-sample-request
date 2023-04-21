<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $h =  $_POST['hidden']; 
            $id = '';
            $req = mysqli_query($con, "SELECT * FROM labo WHERE code_L='$h'");
            if($req) 
            { 
                while($ligne = mysqli_fetch_object($req))
                {
                   $id = $ligne->id_labo;
                }
            }
            $c = $_POST['code_l']; 
            $d = $_POST['description_l'];


            $result = mysqli_query($con, "UPDATE labo SET code_L='$c', description_L='$d' WHERE id_labo='$id'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionLabo.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=AdminGestionLabo.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>