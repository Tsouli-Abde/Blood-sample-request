<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $h =  $_POST['hidden']; 
            $id = '';
            $req = mysqli_query($con, "SELECT * FROM examens WHERE code_E='$h'");
            if($req) 
            { 
                while($ligne = mysqli_fetch_object($req))
                {
                   $id = $ligne->id_examen;
                }
            }
            $c = $_POST['code_e']; 
            $d = $_POST['description_e'];

            $s = $_POST['select_labo'];
            $st = $_POST['select_tube'];

            $result = mysqli_query($con, "UPDATE examens SET code_E='$c', description_E='$d', id_labo='$s', id_tube='$st'
            WHERE id_examen='$id'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionExamen.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=AdminGestionExamen.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>