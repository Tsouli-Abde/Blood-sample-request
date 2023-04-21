<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $code_l = $_POST['code_l'];
        $description_l = $_POST['description_l'];
        $query = mysqli_query($con,"INSERT INTO labo (code_L, description_L) VALUES ('$code_l','$description_l')");
        mysqli_close($con);
        header("location: AdminGestionLabo.php");
    }
?>		
