<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $code_s = $_POST['code_s'];
        $description_s = $_POST['description_s'];
        $query = mysqli_query($con,"INSERT INTO service (code_S, description_S) VALUES ('$code_s','$description_s')");
        mysqli_close($con);
        header("location: AdminGestionService.php");
    }
?>		
