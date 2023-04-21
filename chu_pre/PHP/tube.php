<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $code_t = $_POST['code_t'];
        $couleur = $_POST['couleur'];
        $v = $_POST['volume'];
        $ordre = $_POST['ordre'];
        $query = mysqli_query($con,"INSERT INTO tubes (code_tube, couleur, volume, ordre) VALUES ('$code_t','$couleur','$v','$ordre')");
        mysqli_close($con);
        header("location: AdminGestionTube.php");
    }
?>		
