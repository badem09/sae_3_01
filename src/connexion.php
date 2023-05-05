<!doctype html>
<html lang="fr">

    <?php
        //On inclut le header de la page.
        require("imports_html/head.html");
    ?>

    <body>
        
        <?php
            //On inclut la barre de navigation.
            require("imports_html/nav_bar.html");
        ?>
        
        <div class='container-centrer'>
            <form action='traitements/connexion_traitement.php' method='post'>
                <div class='container-insciption-connexion'>
                    <h2>Se connecter</h2>
                    <?php 
                    //On verifie si lors du chargment de la page, une erreur à été envoyé.
                    if(isset($_GET['err'])){
                        //Si oui on cherche à quelle erreur elle correspond pour l'afficher.
                        switch($_GET['err']){

                            case "u_ou_mdp_faux" :
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
                        <input aria-label="input-login" id='login-login' type='text' name='login' placeholder='ex : demba404' required/>

                        <p class='titre-form'>Mot de passe</p>
                        <input aria-label="input-mdp" id='login-mdp' type='password' name='mdp' placeholder='ex : M0t_D3_P@55€' required/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='Se connecter'></p>
                    <p>Toujours pas inscrit ? <a id='link-sincrip' href='inscription.php'>C'est ici !</a></p>
                    <p>Mot de passe oublié ? <a id='link-sincrip' href='404.php'>C'est par là !</a></p>
                </div>
            </form>
        </div>
        
    </body>

</html>