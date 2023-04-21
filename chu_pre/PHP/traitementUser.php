<?php
    include("connectionBD.php");

    if(isset($_POST['Valider']))
    {
         $reqmaxid= mysqli_query($con,"SELECT max(id_demande) FROM demande");
         $rowmax= mysqli_fetch_assoc($reqmaxid);
         $id= $rowmax['max(id_demande)']+1;
       
        $num_d = $_POST['num_dem'];
        $date_d = $_POST['date_dem'];
        $user_c = $_POST['nom_pre'].' '.$_POST['prenom_pre'];
        $etat = 0;
        $actif = 1;

        //id_user et id_patient
        $tag_rfid = $_POST["tag_rfid"];
        $ipp = $_POST["ipp"];

        //examen et labo
        $sB = $_POST["select_bio"];
        $sH = $_POST["select_hem"];
        $sP = $_POST["select_par"];
       
        //envoie requete
        $query_p = mysqli_query($con,"SELECT id_patient FROM patient WHERE IPP='$ipp'");
        if($query_p) 
        { 
            while($ligne_p = mysqli_fetch_object($query_p))
            {
                $query_u = mysqli_query($con,"SELECT id_user FROM utilisateurs WHERE TAG_RFID='$tag_rfid'");	
                if($query_u)
                {
                    while($ligne_u = mysqli_fetch_object($query_u))
                    {
                        $res_D  = mysqli_query($con,"INSERT INTO demande (num_demande, date_demande, date_prelevement, Etat, User_creation, Date_creation, User_update, Date_update, Actif, id_patient, id_user) 
                        VALUES ('$num_d','$date_d','','$etat','$user_c','$date_d','Aucun','','$actif','$ligne_p->id_patient','$ligne_u->id_user')");	
                    }
                }
            }
        }
         $res_cB = mysqli_query($con,"INSERT INTO conteneur (id_demande, id_examen) VALUES ('$id','$sB')");	
         $res_cH = mysqli_query($con,"INSERT INTO conteneur (id_demande, id_examen) VALUES ('$id','$sH')");	
         $res_cP = mysqli_query($con,"INSERT INTO conteneur (id_demande, id_examen) VALUES ('$id','$sP')");	
        mysqli_close($con);
        header("location: UserGestionDemande.php");
    }
?>		
