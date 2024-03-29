<!doctype html>
<html lang="fr">
    <?php require("imports_html/head.html"); ?>
    <body>
        <?php require("imports_html/nav_bar.html");?>
        <div class='container-centrer-inscription'>
            <form action='traitements/inscription_traitement.php' method='post'>
                <div class='container-insciption-connexion'>
                    <h2>S'inscrire</h2>
                    <?php
                    if(isset($_GET['err'])){
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
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
                        <p class='titre-form'>Identifiant</p>
                        <input aria-label="register-login" id='register-login' type='text' name='login' placeholder='ex : demba404' required/>
                        <p class='titre-form'>Mot de passe</p>
                        <div class="container-verif">
                            <div class="input-box">
                                <i id="eye1" class="fas fa-eye-slash show_hide"></i>
                                <input aria-label="register-password" id="register-password" type='password' name='mdp' placeholder='ex : M0t_D3_P@55€' required/>
                            </div>
                            <div class="indicator-verif">
                                <div class="icon-text">
                                    <i class="fas fa-exclamation-circle error_icon"></i>
                                    <p class="text"></p>
                                </div>
                            </div>
                        </div>
                        <p class='titre-form'>Confirmer Mot de passe</p>
                        <div class="container-verif">
                            <div class="input-box">
                                <i id="eye2" class="fas fa-eye-slash show_hide"></i>
                                <input aria-label="register-password-2" id="register-password-2" type='password' name='mdp_retype' placeholder='ex : M0t_D3_P@55€' required/>
                            </div>
                        </div>
                        <p class='titre-form'>Captcha</p>
                        <div class='captcha-img-desc'>
                            <img class='img-cptcha' src='captcha/img/captcha1.png' alt='image_captcha'>
                            <p class='captcha-desc-text'> Attention : Tous les caractères doivent être écrit en minuscules.</p>
                        </div>
                        <audio controls>
                            <source src="captcha/audio/captcha1.mp3" type="audio/mpeg">
                        </audio>
                        <input aria-label="register-captcha" id='register-captcha' type='text' name='captcha' placeholder='ex : 7u5T5g3' required/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='S&apos;inscrire'></p>
                    <p>Déjà inscrit ? <a id='link-sincrip' href='connexion.php'>C'est ici !</a></p>
                </div>
            </form>
            <!--script de vérification du mot de passe-->
            <script src="js/strength_psswd.js"></script>
        </div>
    </body>
</html>