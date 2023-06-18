<?php
//mettre un message quand la recherche d'user ne renvoie r

session_start();
if(isset($_SESSION['user'])) { // Verification de la session
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
<?php require("imports_html/head.html"); ?>
    <body>
    <?php require("imports_html/nav_bar.html"); ?>
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
                <?php
                if($_SESSION['user']['type_user'] == 'admin') {
                    echo "<input class='btn-simple-bleu' id='activiteconnexion' type='submit' name='activiteconnexion' value='Connexion Echouée'>";
                }
                ?>
            </form>
            <form method="post">
                <input aria-label="input-research" id='researched' type='text' name="text"  placeholder="ex : demba404">
                <input class='btn-simple-bleu' id='search' type='submit' name='search' value='Rechercher'>
                <input id='clear' type='submit' name='retour' value='Retour'>
            </form>
        </div>
        <div class="affichage">
            <?php
            require_once('config/config_bdd.php');

            // table selectionnee en cookie
            if (isset($_POST["users"])) {
                $table = "users";
                setcookie("table", $table);
                $requete1 = "SELECT id_user, login, type_user, nb_visites from $table";
                $requete2 = mysqli_query($connexion, $requete1);
                affichage_requete($table, $requete2);
            }
            elseif (isset($_POST["activiteconnexion"])){
                echo "<h3> Vous pouvez observer les différentes connexions échouées du site.</h3>";
                echo "<h3> Pour cela, cliquer sur le bouton suivant :</h3>";
                echo "<a href='traitements/log.csv' download> <img class='btn-download' src='img/bouton_download.png' alt='boutonDownload'> <a>";
            }
            elseif (isset($_POST["activitemodule"])) {
                echo "<form method='post'>
                                 <input class='btn-simple-bleu' id='croissant' type='submit' name='croissant' value='Croissant'>
                                 <input class='btn-simple-bleu' id='decroissant' type='submit' name='decroissant' value='Décroissant'>
                            </form>";

                $table = "activitemodule";
                setcookie("table", $table);
                $requete1 = "SELECT id_module, count(login), login from $table group by login, id_module";
                $requete2 = "SELECT id_module, count(login) from $table group by id_module";
                $requete3 = mysqli_query($connexion, $requete2);
                $requete4 = mysqli_query($connexion, $requete1);
                affichage_requete($table . "_stat", $requete3);
                affichage_requete($table . "_gen", $requete4);
            }

            // filtre croissant
            if (isset($_POST["croissant"])){
                $requete = "SELECT id_module, count(login), login from activitemodule group by login, id_module order by count(login) ASC";
                $requete1 = mysqli_query($connexion, $requete);
                affichage_requete( "activitemodule_filtre" ,$requete1);
            }
            // filtre decroissant
            elseif (isset($_POST["decroissant"])){
                $requete = "SELECT id_module, count(login), login from activitemodule group by login, id_module order by count(login) DESC";
                $requete1 = mysqli_query($connexion, $requete);
                affichage_requete( "activitemodule_filtre" ,$requete1);
            }

            //Si une recherche
            if ((isset($_POST["text"], $_POST["search"]))) {
                recherche($_POST["text"], $_COOKIE["table"]);

                //Si un retour
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




function recherche($texte,$table): void {
    // config
    $connexion=mysqli_connect("localhost","root","");
    if ($table == "users") {
        $requete = mysqli_query($connexion,"SELECT id_user, login, type_user, nb_visites from $table where login like '".$texte."%'");
    }
    else if ($table == "activitemodule") {
        $requete = mysqli_query($connexion,"SELECT id_activite, id_module, login, date_util from $table where login like '".$texte."%'");
    }
    affichage_requete($table, $requete);
}

function affichage_requete($table, $requete){
    echo "<table class='tab'>";
    if ($table == "users") {
        echo "<tr id='titre_tab'><th>ID User</th><th>Login</th><th>Type Users</th><th>Nombre de Visites</th><th>Supprimer</th></tr>";
    }
    if  ($table == "activitemodule_gen") {
        echo "<tr id='titre_tab'><th>ID Module</th><th>Nombre d'utilisation du Module</th><th>Login utilisateur</th></tr>";
    }
    if  ($table == "activitemodule") {
        echo "<tr id='titre_tab'><th>ID Activite</th><th>Numéro du Module utilisé</th><th>Login utilisateur</th><th>Date d'utilisation</th></tr>";
    }
    if ($table == "activitemodule_stat") {
        echo "<tr id='titre_tab2'><th>Module</th><th>Nombre d'utilisations</th></tr>";
    }
    if  ($table == "activitemodule_filtre") {
        echo "<tr id='titre_tab'><th>ID Module</th><th>Nombre d'utilisation du Module</th><th>Login utilisateur</th></tr>";
    }
    while ($ligne = mysqli_fetch_row($requete)) {
        echo "<tr>";
        foreach ($ligne as $v) {
            echo "<td>" . $v . "</td>";
        }
        if ($table == "users" && ($ligne[2] != "gestion" && $ligne[2] != "admin") ) {
            echo " <td>
                        <form action='delete.php' method='post' >
                        <input type='hidden' name='id_user_suppr' value='$ligne[0]'>
                        <input type='hidden' name='login_suppr' value='$ligne[1]'>
                        <button id='suppresion' type='submit'>Delete</button>
                        </form>
                    </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>