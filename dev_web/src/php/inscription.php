<!doctype html>
<html lang="fr">
    
    <?php
        //On inclus le header de la page.
        require("../imports_html/head.html");
    ?>

    <body>
        
        <?php
            //On inclus la barre de navigation.
            require("../imports_html/nav_bar.html");
        ?>

        <div class='container-centrer'>
            <form action='../traitements/inscription_traitement.php' method='post'>
                <div class='container-insciption-connexion'>
                    <h2>S'inscrire</h2>
                    <?php
                    //On verifie si une erreur à été envoyé.
                    if(isset($_GET['err'])){
                        //On cherche à quoi elle correspond et on l'affiche.
                        switch($_GET['err']){
                            case "mdp_non_identique" :
                            echo "<p class='err'>Erreur : Mots de passe non identique.</p>";
                            break;

                            case "confirmation_vide" :
                            echo "<p class='err>Erreur : La confirmation est vide.</p>";
                            break;

                            case "mdp_vide" :
                            echo "<p class='err'>Erreur : Le mot de passe est vide.</p>";
                            break;

                            case "login_vide" :
                            echo "<p class='err'>Erreur : Le login est vide.</p>";
                            break;

                            case "captcha_vide" :
                            echo "<p class='err'>Erreur : Le Captcha est vide.</p>";
                            break;

                            case "captcha_erroné" :
                            echo "<p class='err'>Erreur : Le captcha est erroné.</p>";
                            break;

                            case "exist" :
                            echo "<p class='err'>Erreur : Nom d'utilisateur déjà éxistant.</p>";
                            break;

                            case "bad_format" :
                            echo "<p class='err'>Erreur : Le Login doit être compris entre 3 à 32 caractères </p>";
                            break;
                        }
                    } ?>
                    <div class='inputs'>
                        <p class='titre-form'>Identifiant</p>
                        <input aria-label="register-login" id='register-login' type='text' name='login' placeholder='ex : demba404' required/>

                        <p class='titre-form'>Mot de passe</p>
                        <input aria-label="register-password" id='register-password' type='password' name='mdp' placeholder='ex : M0t_D3_P@55€' required/>
                        
                        <p class='titre-form'>Confirmer Mot de passe</p>
                        <input aria-label="register-password-2" id='register-password-2' type='password' name='mdp_retype' placeholder='ex : M0t_D3_P@55€' required/>
                        
                        <p class='titre-form'>Captcha</p>
                        <div class='captcha-img-desc'>
                            <img class='img-cptcha' src='../captcha/img/captcha1.png' alt='image_captcha'>
                            <p class='captcha-desc-text'> Attention : Tous les caracères doivent être écrit en minuscules.</p>
                        </div>
                        <audio controls>
                            <source src="../captcha/audio/captcha1.mp3" type="audio/mpeg">
                        </audio>
                        <input aria-label="register-captcha" id='register-captcha' type='text' name='captcha' placeholder='ex : 7u5T5g3' required/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='S&apos;inscrire'></p>
                    <p>Déjà inscrit ? <a id='link-sincrip' href='connexion.php'>C'est ici !</a></p>
                </div>
            </form>
        </div>
    </body>
</html>