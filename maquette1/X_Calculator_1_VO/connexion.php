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
                    <a href="connexion.php"><b>Se connecter</b></a>
                </li>

            </ul>
        </nav>
        <div class='container-centrer'>
            <?php echo"
                <form action='connexion_traitement.php' method='post'>
                    <div class='container-insciption-connexion'>
                        <h2>Se connecter</h2>";
                        if(isset($_GET['err'])){
                            switch($_GET['err']){

                                case "mdp_vide" :
                                echo "<p style=' color:red'><b>Erreur : mdp_vide.</b></p>";
                                break;

                                case "login_vide" :
                                echo "<p style=' color:red'><b>Erreur : login_vide.</b></p>";
                                break;
                            }
                        }echo "
                        <div class='inputs'>
                            <p>Identifiant : <input type='text' name='login'/></p>
                            <p>Mot de passe : <input type='password' name='mdp'/></p>
                        </div>
                        <p><input type='submit' name='Envoyer' value='Envoyer'></p>
                        <a href='inscription.php'>S'inscrire</a>
                    </div>
                </form>

            ";
            ?>
        </div>
    </body>
</html>