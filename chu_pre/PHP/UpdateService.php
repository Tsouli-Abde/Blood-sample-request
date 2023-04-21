<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $h =  $_POST['hidden']; 
            $id = '';
            $req = mysqli_query($con, "SELECT * FROM service WHERE code_S='$h'");
            if($req) 
            { 
                while($ligne = mysqli_fetch_object($req))
                {
                   $id = $ligne->id_service;
                }
            }
            $c = $_POST['code_s']; 
            $d = $_POST['description_s'];


            $result = mysqli_query($con, "UPDATE service SET code_S='$c', description_S='$d' WHERE id_service='$id'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionService.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=AdminGestionService.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>