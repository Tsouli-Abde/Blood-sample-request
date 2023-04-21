<?php
    include("connectionBD.php");
    if(isset($_POST['Valider']))
    {
        $tab = array();
        $tb = $th = $tp = $sB = $sH = $sP = $id_d = $e = "";
        $num_d = $_POST['num_dem'];
        $date_u = $_POST['date_mod'];

        $tag = $_POST['tag_rfid'];
        $user_u = $_POST['nom_mod'].' '.$_POST['prenom_mod'];

        $ipp = $_POST['ipp'];
        $patient = mysqli_query($con ,"SELECT * FROM patient WHERE IPP='$ipp'");
        while($ligne_p = mysqli_fetch_object($patient))
        {
            $id_p = $ligne_p->id_patient;
        }
        $demande = mysqli_query($con ,"SELECT * FROM demande WHERE num_demande='$num_d'");
        while($d = mysqli_fetch_object($demande))
        {
            $id_d = $d->id_demande;
            $date_d = $d->date_demande;
            $date_p = $d->date_prelevement;
            $etat = $d->Etat;
            $u_c = $d->User_creation;
            $d_c = $d->Date_creation;
            $actif = $d->Actif;
            $id_user = $d->id_user;
        }

         $sB = $_POST["select_bio"];
         $sH = $_POST["select_hem"];
         $sP = $_POST["select_par"];

        $examens = mysqli_query($con ,"SELECT * FROM conteneur WHERE id_demande='$id_d'");
        while($ex = mysqli_fetch_object($examens))
        {
            $e = $ex->id_examen.' '.$e;
        }
        $tab = explode(" ", $e);
          $tab[0] = trim($tab[0]);
          $tab[1] = trim($tab[1]);
          $tab[2] = trim($tab[2]);

        $res_cB = mysqli_query($con ,"SELECT * FROM conteneur WHERE id_demande='$id_d' AND id_examen='$tab[2]'");
        $res_cH = mysqli_query($con ,"SELECT * FROM conteneur WHERE id_demande='$id_d' AND id_examen='$tab[1]'");
        $res_cP = mysqli_query($con ,"SELECT * FROM conteneur WHERE id_demande='$id_d' AND id_examen='$tab[0]'");

        while($bi = mysqli_fetch_object($res_cB))
        {
            while($he = mysqli_fetch_object($res_cH))
            {
                while($pa = mysqli_fetch_object($res_cP))
                {
                   $tb = $bi->id_conteneur;
                   $th = $he->id_conteneur;
                   $tp = $pa->id_conteneur;
                }
            }
        }


       
        $result = mysqli_query($con, "UPDATE demande SET num_demande='$num_d', date_demande='$date_d', date_prelevement='$date_p', Etat='$etat', 
        User_creation='$u_c', Date_creation='$d_c', User_update='$user_u', Date_update='$date_u', Actif='$actif', id_patient='$id_p', id_user='$id_user' 
        WHERE num_demande='$num_d'");	
        if ($result)
        {
             $rcB = mysqli_query($con,"UPDATE conteneur SET id_demande='$id_d', id_examen='$sB' WHERE id_conteneur='$tb'");	
             $rcH = mysqli_query($con,"UPDATE conteneur SET id_demande='$id_d', id_examen='$sH' WHERE id_conteneur='$th'");	
             $rcP = mysqli_query($con,"UPDATE conteneur SET id_demande='$id_d', id_examen='$sP' WHERE id_conteneur='$tp'");	
             if($rcB )
             {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionDemande.php");
                 exit;
             }
        }
        else
        {
            echo "<script>alert('La modification a échoué !');</script>";
            header("refresh: 0, url=AdminGestionDemande.php");
            exit;        
        }
        mysqli_close($con);

    }
    ?>