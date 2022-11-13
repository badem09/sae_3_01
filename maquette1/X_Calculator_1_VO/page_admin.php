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
                    <a href="connexion.php"><b>Administration</b></a>
                </li>

                <li class="nav-item">
                    <a href="connexion.php"><b>Se Deconnecter</b></a>
                </li>

            </ul>
        </nav>

        <div class="entete">
            <h1>X Calculator</h1>
            <h2>Espace administrateur</h2>
        </div>

        <div class="admin-main">
            <div class="recherche">
                <h3>Rechercher un utilisateur</h3>
                <form method="post">
                    <input id='researched' type='text' name="text"  placeholder="ex : demba404">
                    <input id='search' type='submit' name='search' value='Recherecher'>
                    <input id='clear' type='submit' name='retour' value='Retour'>
                </form>
            </div>


            <div class="affichage">
            <?php

                require_once('config_bdd.php');

                if ((isset($_POST["text"], $_POST["search"]))) {
                    $requete2 = mysqli_query($connexion,"SELECT id_user, login, type_user from users where login='".$_POST["text"]."'");
                    echo "<table class='tab'>";
                    echo "<tr id='titre_tab'><th>ID Utilisateur</th><th>Nom Utilisateur</th><th>Type Utilisateur</th></tr>";
                    while ($ligne = mysqli_fetch_row($requete2)) {
                        echo "<tr>";
                        foreach ($ligne as $v) { //parcours tableau de mysqli_fetch_row
                            echo "<td>" . $v . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } elseif (isset($_POST["retour"]) ){
                    header("location:page_admin.php");
                } else {
                    $requete1 = mysqli_query($connexion,"SELECT id_user, login, type_user from users");
                    echo "<table class='tab'>";
                    echo "<tr id='titre_tab'><th>ID Utilisateur</th><th>Nom Utilisateur</th><th>Type Utilisateur</th></tr>";
                    while ($ligne = mysqli_fetch_row($requete1)) {
                        echo "<tr>";
                        foreach ($ligne as $v) { //parcours tableau de mysqli_fetch_row
                            echo "<td>" . $v . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
            ?>
            </div>
        </div>
    </body>
</html>
