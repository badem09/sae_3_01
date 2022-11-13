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

        <div class="recherche">
            <h3>Rechercher un utilisateur</h3>
            <form method="post"  action="">
                <input type='text' name="text" id="text">
                <input type='submit' name='search' id='search' value='rechercher'>
                <input type='submit' name='retour' id='retour' value='retour'>
            </form>
        </div>



        <?php

            $token = (bool)($connexion = mysqli_connect("localhost", "root", "")); // connexion avec serveur sql


            if ($token) { //vérifie connection avec serveur
                $token2 = ($bd = mysqli_select_db($connexion, "sae_3_01")); //choisi la databse

                if ($token2) { //vérifie connexion avec database
                    $table = "activitemodule"; //choix table

                    if ((isset($_POST["text"], $_POST["search"]))) { //si recherche d'un login, alors on doit mettre a jour requete sql avec élément recherche
                        $utilsateur = $_POST["text"];
                        $requete = "SELECT * from $table where login='$utilsateur'"; //Requete SQL affichant le tableau avec l'utilisateur choisi et statistiques

                        $token3 = (bool)($res = mysqli_query($connexion, $requete));
                        if ($token3) { //vérifie connexion entre mysql et requête
                            echo "<table class='tab'>";
                            while ($ligne = mysqli_fetch_row($res)) {
                                echo "<tr>";
                                foreach ($ligne as $v) { //parcours tableau de mysqli_fetch_row
                                    echo "<td>" . $v . "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }
                    elseif ( isset($_POST["retour"]) ){
                        header("location:page_admin.php");
                    }

                    else {  // si pas de recherche, alors affiche liste tout les utilisateurs
                        $requete = "SELECT * from $table";
                        $token3 = (bool)($res = mysqli_query($connexion, $requete));

                        $token3 = (bool)($res = mysqli_query($connexion, $requete));
                        if ($token3) { //vérifie connexion entre mysql et requête
                            echo "<table class='tab'>";
                            while ($ligne = mysqli_fetch_row($res)) {
                                echo "<tr>";
                                foreach ($ligne as $v) { //parcours tableau de mysqli_fetch_row
                                    echo "<td>" . $v . "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }
                }
            }
        ?>

</body>
</html>
