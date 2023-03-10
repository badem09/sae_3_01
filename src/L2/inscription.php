<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css\css.css">
        <link rel="icon" type="image/x-icon" href="img\logo_t.ico">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <title>X Calculator | V0.1</title>
    </head>

    <body>
        <nav class = "menu-nav">
            <ul id="ul-container">

                <li class ="nav-logo">
                    <a href="index.html"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
                </li>

                <li class="nav-item">
                    <a href="index.html"><b>Page d'accueil</b></a>
                </li>

                <li class="nav-item">
                    <a href="#"><b>Mes Services</b></a>

                    <ul class = "nav-item-services">
                        <li><a href="connexion.php"><b>Module 1</b></a></li>
                        <li><a href="connexion.php"><b>Module 2</b></a></li>
                        <li><a href="connexion.php"><b>Module 3</b></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="connexion.php"><b>Se connecter</b></a>
                </li>

            </ul>
        </nav>
        <div class='container-centrer'>
            <form action='inscription_traitement.php' method='post'>
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
                            echo "<p class='err'>Erreur : Le nom d'utilisateur est déjà éxistant.</p>";
                            break;
                        }
                    } ?>
                    <div class='inputs'>
                        <p class='titre-form'>Identifiant</p>
                        <label id="label-register-login" for="register-login">
                        <input id='register-login' type='text' name='login' placeholder='ex : demba404'/>

                        <p class='titre-form'>Mot de passe</p>
                        <label id="label-register-password" for="register-password">
                        <input id='register-password' type='password' name='mdp' placeholder='ex : M0t_D3_P@55€'/>
                        
                        <p class='titre-form'>Confirmer Mot de passe</p>
                        <label id="label-register-password-2" for="register-password-2">
                        <input id='register-password-2' type='password' name='mdp_retype' placeholder='ex : M0t_D3_P@55€'/>
                        
                        <p class='titre-form'>Captcha</p>
                        <div class='captcha-img-desc'>
                            <img class='img-cptcha' src='img/captcha1.png' alt='image_captcha'>
                            <p class='captcha-desc-text'> Attention : les majuscules comptent.</p>
                        </div>
                        <label id="label-register-captcha" for="register-captcha">
                        <input id='register-captcha' type='text' name='captcha' placeholder='ex : 7u5T5g3'/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='S&apos;inscrire'></p>
                    <p>Déjà inscrit ? <a id='link-sincrip' href='connexion.php'>C'est ici !</a></p>
                </div>
            </form>
        </div>
    </body>
</html>