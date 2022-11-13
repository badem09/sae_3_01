<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css\css.css">
        <link rel="icon" type="image/x-icon" href="img\logo_t.ico">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <title>X Calculator | V0.0</title>
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
                    <a href="inscription.php"><b>S'inscrire</b></a>
                </li>

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

                            case "u_introuvable" :
                            echo "<p class='err'>Erreur : Utilisateur inexistant.</p>";
                            break;

                            case "mdp_vide" :
                            echo "<p class='err'>Erreur : Mot de passe vide.</p>";
                            break;

                            case "login_vide" :
                            echo "<p class='err'>Erreur : Login vide.</p>";
                            break;
                        }
                    } ?>
                    <div class='inputs'>
                        <p class='titre-form'>Identifiant</p>
                        <input type='text' name='login' placeholder='ex : demba404'/>
                        <p class='titre-form'>Mot de passe</p>
                        <input type='password' name='mdp' placeholder='ex : M0t_D3_P@55€'/>
                    </div>
                    <p><input type='submit' name='Envoyer' value='Se connecter'></p>
                    <p>Toujours pas inscrit ? <a id='link-sincrip' href='inscription.php'>C'est ici !</a></p>
                </div>
            </form>
        </div>
    </body>
</html>