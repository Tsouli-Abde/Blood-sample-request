<?php
     include("connectionBD.php");
            if(isset($_POST['Valider']))
        {
            $user = $date = $a = $ids = "";
            $tag = $_POST['tag_rfid']; 

            $d_m = $_POST['date_m'];
            $u_m = $_POST['nom_m'].' '.$_POST['prenom_m'];

            $n_p = $_POST['nom_pre'];
            $p_p = $_POST['prenom_pre'];

            $s = $_POST['select_s'];

            $login = $_POST['login']; 
            $mdp = $_POST['mdp']; 

            $r = $_POST['role_pre'];

            $res  = mysqli_query($con ,"SELECT * FROM utilisateurs WHERE TAG_RFID='$tag'");
            if($res)
            {
                while($ligne_s = mysqli_fetch_object($res))
                {

                    $user = $ligne_s->User_creation;
                    $date = $ligne_s->Date_creation;
                    $a = $ligne_s->Actif;
                }
            }

            $result = mysqli_query($con, "UPDATE utilisateurs SET login='$login', mdp='$mdp', nom='$n_p', prenom='$p_p', TAG_RFID='$tag', 
            role='$r', User_creation='$user', Date_creation='$date', User_update='$u_m', Date_update='$d_m', Actif='$a', id_service='$s' 
            WHERE TAG_RFID='$tag'");
            if ($result)
            {
                echo "<script>alert('Modification avec succés !');</script>";
                 header("refresh: 0, url=AdminGestionUtilisateur.php");
                 exit;
            }
            else
            {
                echo "<script>alert('La modification a échoué !');</script>";
                header("refresh: 0, url=AdminGestionUtilisateur.php");
                exit;
            }
            mysqli_close($con);
        }
       
?>