<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $h =  $_POST['hidden']; 
            $id = '';
            $req = mysqli_query($con, "SELECT * FROM tubes WHERE code_tube='$h'");
            if($req) 
            { 
                while($ligne = mysqli_fetch_object($req))
                {
                   $id = $ligne->id_tube;
                }
            }
            $c = $_POST['code_t']; 
            $d = $_POST['couleur'];

            $s = $_POST['volume'];
            $st = $_POST['ordre'];

            $result = mysqli_query($con, "UPDATE tubes SET code_tube='$c', couleur='$d', volume='$s', ordre='$st'
            WHERE id_tube='$id'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionTube.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=AdminGestionTube.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>