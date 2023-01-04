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
    //Si aucune cession n'existe on renvoie sur la page de connexion.
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

                <h2>Choisissez une statistique</h2>
                <h3>Rechercher un utilisateur avec son login</h3>

                <form method="post" id='post-admin-up'>
                    <input class='btn-simple-bleu' id='users' type='submit' name="users" value="Utilisateurs">
                    <input class='btn-simple-bleu' id='activitemodule' type='submit' name='activitemodule' value='Activite Module'>
                    <input class='btn-simple-bleu' id='activiteconnexion' type='submit' name='activiteconnexion' value='Connexion Echouée'>
                </form>

                <form method="post">
                    <input aria-label="input-research" id='researched' type='text' name="text"  placeholder="ex : demba404">
                    <input class='btn-simple-bleu' id='search' type='submit' name='search' value='Recherecher'>
                    <input id='clear' type='submit' name='retour' value='Retour'>
                </form>

            </div>

            <div class="affichage">
                <?php
                    //On inclus la configuration d'accès à la base de donnée avant de commencer.
                    require_once('config/config_bdd.php');

                    //Si on appuie sur le bouton utilisateur, alors on récupère la table, on la met le nom de la table
                    //dans un cookie pour la stocker et on appel la fonction avec le nom de la table en paramètre.
                    if (isset($_POST["users"])) {
                        $table = "users";
                        setcookie("table", $table);
                        affichage($table);
                    }
                    elseif (isset($_POST["activitemodule"])) {
                        $table = "activitemodule";
                        setcookie("table", $table);
                        affichage($table);
                    }
                    elseif (isset($_POST["activiteconnexion"])) {
                        $table = "activiteconnexion";
                        setcookie("table", $table);
                        affichage($table);
                    }

                    //Si une recherche a été demandé.
                    if ((isset($_POST["text"], $_POST["search"]))) {
                        //On appel la fonction recherche avec le nom de la table et le texte entrée.
                        recherche($_POST["text"], $_COOKIE["table"]);

                    //Si un retour à été demandé, on redirige vers la meme page pour l'actualiser et on ferme celle-ci.
                    }elseif (isset($_POST["retour"])) {
                        header("location:page_admin.php");
                        die();
                    }
                ?>
            </div>
        </div>
    
    </body>
</html>

<?php
    //Affiche l'entierete de la table choisi selon le paramètre "table" si aucuns texte n'est entrée.
    function affichage($table){

        //On ajoute la configuration d'accès à la base de données.
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

        //Si la table est user.
        if ($table == "users") {
            //On récupère toutes les information dont ont à besoin.
            $requete1 = mysqli_query($connexion,"SELECT id_user, login, type_user, nb_visites from $table");
        }
        //Si la table est activiteconnexion.
        else if ($table == "activiteconnexion") {
            //On récupère toutes les information dont ont à besoin.
            $requete1 = mysqli_query($connexion,"SELECT id_connexion, mdp_tente, login, date_horaire_tent, adr_ip from $table");
        }
        //Si la table est le dernier bouton.
        else {
            //On récupère toutes les information dont ont à besoin.
            $requete1 = mysqli_query($connexion,"SELECT * from $table");
        }

        //On affiche la base d'un tableau.
        echo "<table class='tab'>";

        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "users") {
            echo "<tr id='titre_tab'><th>ID User</th><th>Login</th><th>Type Users</th><th>Nombre de Visites</th></tr>";
        }
        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "activitemodule") {
            echo "<tr id='titre_tab'><th>ID Activite</th><th>Numéro du Module utilisé</th><th>Login utilisateur</th></tr>";
        }
        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "activiteconnexion") {
            echo "<tr id='titre_tab'><th>ID Connexion</th><th>MDP tente (en md5)</th><th>Login tente</th><th>Horaire de la tentative</th><th>Adresse IP</th></tr>";
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

    //Affiche l'entierete de la table choisi selon les paramètres "table" et "texte" si un texte est entrée.
    function recherche($texte,$table){

        //On ajoute la configuration d'accès à la base de données.
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

        //Si la table est user.
        if ($table == "users") {
            //On récupère toutes les information dont ont à besoin.
            $requete = mysqli_query($connexion,"SELECT id_user, login, type_user, nb_visites from $table where login like '".$texte."%'");
        }
        //Si la table est activiteconnexion.
        else if ($table == "activiteconnexion") {
            //On récupère toutes les information dont ont à besoin.
            $requete = mysqli_query($connexion,"SELECT id_connexion, mdp_tente, login, date_horaire_tent, adr_ip from $table where login like '".$texte."%'");
        }
        //Si la table est le dernier bouton.
        else {
            //On récupère toutes les information dont ont à besoin.
            $requete = mysqli_query($connexion, "SELECT * from $table where login like '".$texte."%'");
        }
        //On affiche la base d'un tableau.
        echo "<table class='tab'>";

        //On affiche les titres du tableau selon la table sélectionné.
        if ($table == "users") {
            echo "<tr id='titre_tab'><th>ID User</th><th>Login</th><th>Type Users</th><th>Nombre de Visites</th></tr>";
        }
        if ($table == "activitemodule") {
            echo "<tr id='titre_tab'><th>ID Activite</th><th>Numéro du Module utilisé</th><th>Login utilisateur</th></tr>";
        }
        if ($table == "activiteconnexion") {
            echo "<tr id='titre_tab'><th>ID Connexion</th><th>MDP tente (en md5)</th><th>Login tente</th><th>Horaire de la tentative</th><th>Adresse IP</th></tr>";
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

?>