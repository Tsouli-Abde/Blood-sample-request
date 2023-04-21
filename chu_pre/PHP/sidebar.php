<div class="sidebar">
                <div class="profile">
                    <img src="../Images/CHU.png" alt="Photo de profil">
                    <h3><?php   echo $_SESSION['nom'].' '.$_SESSION['prenom'] ?></h3>
                    <p>Administrateur</p>
                    <div id="info-box">
                        <div class="box">
                            <span><b><?php
                             include("connectionBD.php");
                             $c = mysqli_query($con ,"SELECT COUNT(*) as myc FROM demande WHERE Actif='1'");
                             if($c)
                             {
                                while($c_d = mysqli_fetch_object($c)) 
                                {
                                    $t = $c_d->myc;
                                    if($t < 10) echo '0'.$t;
                                    else echo $t;
                                }
                            }
                            ?></b><br>Demande(s)</span>
                        </div>
                        <div class="box">
                            <span><b><?php
                             $cp = mysqli_query($con ,"SELECT COUNT(*) as myc FROM patient");
                             if($cp)
                             {
                                while($c_d = mysqli_fetch_object($cp)) 
                                {
                                    $t = $c_d->myc;
                                    if($t < 10) echo '0'.$t;
                                    else echo $t;
                                }
                            }
                            ?></b><br>Patient(s)</span>
                        </div>
                        <div class="box">
                            <span><b>
                                <?php 
                                include("compteur.php");
                                if($nVisite < 10) echo '0'.$nVisite;
                                else echo $nVisite;
                                ?>
                            </b><br>Visite(s)</span>
                        </div>
                    </div>
                </div>