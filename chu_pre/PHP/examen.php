<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
        $maxid = "SELECT max(id_examen) FROM examens"; 
        $reqmaxid= mysqli_query($con,$maxid);
        $rowmax= mysqli_fetch_assoc($reqmaxid);
        $id= $rowmax['max(id_examen)']+1;
        $code_e = $_POST['code_e'];
        $description_e = $_POST['description_e'];
        $select_labo = $_POST['select_labo'];
        $select_tube = $_POST['select_tube'];
        $query = mysqli_query($con,"INSERT INTO examens (id_examen, code_E, description_E, id_labo, id_tube) VALUES ('$id','$code_e','$description_e','$select_labo','$select_tube')");
        mysqli_close($con);
        header("location: AdminGestionExamen.php");
    }
?>		
