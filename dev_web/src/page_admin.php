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
        
        <?php
            //On inclus la barre de navigation.
            require("imports_html/nav_bar.html");
        ?>

        <div class="entete">
            <h1>X Calculator</h1>
            <h2>Espace administrateur</h2>
        </div>

        <div class="admin-main">
            <div class="recherche">
                <h3> Choisiser une statistique</h3>
                <form method="post">
                    <input id='users' type='submit' name="users" value="Utilisateurs">
                    <input id='activitemodule' type='submit' name='activitemodule' value='Activite Module'>
                    <input id='activiteconnexion' type='submit' name='activiteconnexion' value='Connexion Echouée'>
                </form>

                <h3>Rechercher un utilisateur (login)</h3>
                <form method="post">
                    <input id='researched' type='text' name="text"  placeholder="ex : demba404">
                    <input id='search' type='submit' name='search' value='Recherecher'>
                    <input id='clear' type='submit' name='retour' value='Retour'>
                </form>
            </div>

            <div class="affichage">
            <?php
                //On inclus la configuration d'accès à la base de donnée avant de commencer.
                require_once('config/config_bdd.php');


                if ( isset($_POST["users"]) ){  //si on appuie sur le bouton utilisateur
                    $table = "users";           // alors on récupère la table
                    setcookie("table", $table); //et on la met dans un cookie pour la stocker
                    affichage($table);          // et on appel la fonction avec la table en paramètre
                }
                else if ( isset($_POST["activitemodule"]) ){
                    $table = "activitemodule";
                    setcookie("table", $table);
                    affichage($table);
                }
                else if ( isset($_POST["activiteconnexion"]) ){
                    $table = "activiteconnexion";
                    setcookie("table", $table);
                    affichage($table);
                }

                //Si une recherche a été demandé.
                if ((isset($_POST["text"], $_POST["search"]))) {
                    recherche($_POST["text"], $_COOKIE["table"]);

                //Si un retour à été demandé, on redirige vers la meme page pour actualiser et on ferme celle-ci.
                } elseif (isset($_POST["retour"]) ){
                    header("location:page_admin.php");
                    die();
                }

            ?>
            </div>
        </div>
    
    </body>
</html>




<?php

function affichage($table){ //affiche l'entierete de la table choisi selon le paramètre

    //configuration d'accès à la base de donnée avant de commencer.
    $connexion=mysqli_connect("localhost","root","");
    $bd=mysqli_select_db($connexion,"bd_sae");

    $requete1 = mysqli_query($connexion,"SELECT * from $table");

    //On affiche la base d'un tableau.
    echo "<table class='tab'>";

        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "users") {
            echo "<tr id='titre_tab'><th>ID User</th><th>Login</th><th>MDP (en md5)</th><th>Type Users</th><th>Nombre de Visites</th></tr>";
        }
        if ($table == "activitemodule") {
            echo "<tr id='titre_tab'><th>ID Activite</th><th>Numéro du Module utilisé</th><th>Login utilisateur</th></tr>";
        }
        if ($table == "activiteconnexion") {
            echo "<tr id='titre_tab'><th>ID Connexion</th><th>Reussite</th><th>MDP tente (en md5)</th><th>Login tente</th><th>Horaire de la tentative</th><th>Adresse IP</th></tr>";
        }

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

function recherche($texte,$table){ //affiche le contenu de la table selon les paramètres

    //configuration d'accès à la base de donnée avant de commencer.
    $connexion=mysqli_connect("localhost","root","");
    $bd=mysqli_select_db($connexion,"bd_sae");


    $requete = mysqli_query($connexion,"SELECT * from $table where login like '".$texte."%'");

    //On affiche la base d'un tableau.
    echo "<table class='tab'>";

        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "users") {
            echo "<tr id='titre_tab'><th>ID User</th><th>Login</th><th>MDP (en md5)</th><th>Type Users</th><th>Nombre de Visites</th></tr>";
        }
        if ($table == "activitemodule") {
            echo "<tr id='titre_tab'><th>ID Activite</th><th>Numéro du Module utilisé</th><th>Login utilisateur</th></tr>";
        }
        if ($table == "activiteconnexion") {
            echo "<tr id='titre_tab'><th>ID Connexion</th><th>Reussite</th><th>MDP tente (en md5)</th><th>Login tente</th><th>Horaire de la tentative</th><th>Adresse IP</th></tr>";
        }

        //Pour chaques lignes assigé comme plusieurs valeurs, on récupère et affiche les données (1 seul car chaque "login" est unique).
        while ($ligne = mysqli_fetch_row($requete)) {
            echo "<tr>";
            foreach ($ligne as $v) {
                echo "<td>" . $v . "</td>";
            }
            echo "</tr>";
        }
    echo "</table>";
}