<!doctype html>
<html lang="fr">

    <?php
        //On inclus le header de la page.
        require("imports_html/head.html");
    ?>

    <body>
        <nav class = "menu-nav">
            <ul id="ul-container">

                <li class ="nav-logo">
                    <a href="index.php"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
                </li>

                <li class="nav-item">
                    <a href="index.php"><b>Page d'accueil</b></a>
                </li>

                <li class="nav-item">
                    <a href="#"><b>Mes Services</b></a>
                    <ul class = "nav-item-services">
                        <li><a href="module1.php"><b>Module 1</b></a></li>
                        <li><a href="404.php"><b>Module 2</b></a></li>
                        <li><a href="404.php"><b>Module 3</b></a></li>
                    </ul>
                </li>

                <?php

                    //On regarde si une cession existe.
                    session_start();   
                    //On attribus les bon boutons au bonnes personnes.
                    if(isset($_SESSION['user'])) {
                        if($_SESSION['user']['type_user'] != 'user'){
                            echo"
                            <li class='nav-item'>
                              <a href='page_admin.php'><b>Administration</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='page_user.php'><b>Mon Espace</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='deconnexion.php'><b>Se déconnecter</b></a>
                            </li>
                            ";
                        }else{
                            echo "
                            <li class='nav-item'>
                              <a href='page_user.php'><b>Mon Espace</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='deconnexion.php'><b>Se déconnecter</b></a>
                            </li>
                            ";
                        }
                    }else{
                        echo "
                        <li class='nav-item'>
                            <a href='connexion.php'><b>Se connecter</b></a>
                        </li>
                        ";
                    }
                    
                ?>

            </ul>
        </nav>
        
        <div class='container-centrer'>
            <form action='connexion_traitement.php' method='post'>
                <div class='container-insciption-connexion'>
                    <h2>Se connecter</h2>
                    <?php 
                    //On verifie si lors dur chargment de la page, une erreur à été envoyé.
                    if(isset($_GET['err'])){
                        //Si oui on cherche à quelle erreur elle correspond pour l'afficher.
                        switch($_GET['err']){

                            case "u_ou_mdp-faux" :
                            echo "<p class='err'>Erreur : Utilisateur ou mot de passe erroné.</p>";
                            break;

                            case "mdp_vide" :
                            echo "<p class='err'>Erreur : Mot de passe vide.</p>";
                            break;

                            case "login_vide" :
                            echo "<p class='err'>Erreur : Identifiant vide.</p>";
                            break;
                        }
                    } ?>
                    <div class='inputs'>
                        <p class='titre-form'>Identifiant</p>
                        <label id="labe-login-login" for="login-login">
                        <input id='login-login' type='text' name='login' placeholder='ex : demba404' required/>
                        <p class='titre-form'>Mot de passe</p>
                        <label id="label-login-mdp" for="login-mdp">
                        <input id='login-mdp' type='password' name='mdp' placeholder='ex : M0t_D3_P@55€' required/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='Se connecter'></p>
                    <p>Toujours pas inscrit ? <a id='link-sincrip' href='inscription.php'>C'est ici !</a></p>
                    <p>Mot de passe oublié ? <a id='link-sincrip' href='404.php'>C'est par là !</a></p>
                </div>
            </form>
        </div>
    </body>
</html>