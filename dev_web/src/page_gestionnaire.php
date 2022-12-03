<?php

    //On démarre une cession existe.
    session_start();
    //On vérifie si une cession existe.
    if(isset($_SESSION['user'])) {
        //Si c'est un simple utilisateur, on renvois sur la page de connexion.
        if($_SESSION['user']['type_user'] == 'user'){
            header('Location: connexion.php');
            die();
        }
    }else{
        header('Location: connexion.php');
        die();
    }
?>

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

                <li class="nav-item">
                    <a href="page_admin.php"><b>Administration</b></a>
                </li>

                <li class="nav-item">
                    <a href="page_user.php"><b>Mon Espace</b></a>
                </li>

                <li class="nav-item">
                    <a href="deconnexion.php"><b>Se Déconnecter</b></a>
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
                //On inclus la configuration d'accès à la base de donnée avant de commencer.
                require_once('config_bdd.php');
                //Si une recherche a été demandé.
                if ((isset($_POST["text"], $_POST["search"]))) {
                    //On récupere de la base de donnée "id_user", "login", "type_user" si un utilisateur correspond à l'entrée.
                    $requete2 = mysqli_query($connexion,"SELECT id_user, login, type_user from users where login like '".$_POST["text"]."%'");
                    //On affiche la base d'un tableau.
                    echo "<table class='tab'>";
                    //On affiche les titres du tableau.
                    echo "<tr id='titre_tab'><th>ID Utilisateur</th><th>Nom Utilisateur</th><th>Type Utilisateur</th></tr>";
                    //Pour chaques lignes assigé comme plusieurs valeurs, on récupère et affiche les données (1 seul car chaque "login" est unique).
                    while ($ligne = mysqli_fetch_row($requete2)) {
                        echo "<tr>";
                        foreach ($ligne as $v) {
                            echo "<td>" . $v . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                //Si un retour à été demandé, on redirige vers la meme page pour actualiser et on ferme celle-ci.
                } elseif (isset($_POST["retour"]) ){
                    header("location:page_admin.php");
                    die();
                //Si aucune action n'a été effectué on affiche toutes les données présente dans la base de donnée.
                //(Dans le cas ou nous arrivons sur la page, c'est cette condition sui est utiliser pour afficher les données sans avoir à les demander.)
                } else {
                    $requete1 = mysqli_query($connexion,"SELECT id_user, login, type_user from users");
                    //On affiche la base d'un tableau.
                    echo "<table class='tab'>";
                    //On affiche les titres du tableau.
                    echo "<tr id='titre_tab'><th>ID Utilisateur</th><th>Nom Utilisateur</th><th>Type Utilisateur</th></tr>";
                    //Pour chaques lignes assigé comme plusieurs valeurs, on récupère et affiche les données (1 seul car chaque "login" est unique).
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

    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
    
    </body>
</html>