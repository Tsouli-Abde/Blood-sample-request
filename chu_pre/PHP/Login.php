<?php 
    $l = $p = "";
    if(isset($_POST['connexion'])) 
    {       
        include("connectionBD.php");
        $sql = "SELECT * FROM utilisateurs";  
        $req = mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($req))
        { 
            if($_POST['login']==$row['login'])
            {
                if($_POST['password']==$row['mdp'])
                {
                    $l = "";
                    $p = "";
                    session_start(); 
                    $_SESSION['nom']      = $row['nom'];
                    $_SESSION['prenom']   = $row['prenom'];
                    $_SESSION['tag_rfid'] = $row['TAG_RFID'];
                    if($row['role']=='A')
                    {
                        header('location: AdminGestionDemande.php');
                        exit;
                    }
                    else
                    {
                        header('location: UserGestionDemande.php');
                        exit;
                    }
                }
                else
                {
                    $l = "";
                    $p = "* Le mot de passe est incorrect !";
                    break;
                }
            }
            else
            {
                if($_POST['password']==$row['mdp'])
                {
                    $l = "* Le nom d'utilisateur invalide !";
                    $p = "";
                    break;
                }
                else
                {
                    $l = "* Le nom d'utilisateur invalide !";
                    $p = "* Le mot de passe est incorrect !";
                    continue;
                }
            }
        }
        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/LoginStyle.css">
        <link rel="icon"       href="../Images/Icon.jpg">
        <title>CHU - Login</title>
    </head>
    <body>
        <div id="main">
            <div id="ContactForm">
                <form name="form" action="login.php" method="POST">
                    <h2>CHU - Login</h2>
                    <p>Connectez-vous à votre compte</p>
                    <table>
                        <tr>
                            <td>
                                <div class="field">
                                    <i class="icons bi bi-person-fill" id="icon1"></i>
                                    <input type="text" name="login" placeholder="Login" size="22" required autofocus>
                                </div>
                                <div class="field">
                                    <?php
                                        echo "<span class='err'>".$l."</span>";
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="field">
                                    <i class="icons bi bi-lock-fill" id="icon2"></i>                                            
                                    <input type="password" name="password" placeholder="Mot de passe" size="22" required>
                                </div>
                                <div class="field">
                                    <?php
                                        echo "<span class='err'>".$p."</span>";
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="connexion" value="Connexion">
                </form>
            </div>
        </div>
    </body>
</html>