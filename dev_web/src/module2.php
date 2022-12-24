<?php

    //On regarde si une cession existe.
    session_start();
    //Si aucune cession existe, on renvois sur la page de connexion.
    if(!isset($_SESSION['user'])) {
       header('Location: connexion.php');
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
            <h2>Module de Cryptographie</h2>
            <br>
            <p class="pacc_mod_pres">Vous pouvez crypter et décrypter un code à l'aide d'une clé personalisé avec le type de cryptage RC4.</p>
        </div>

        <div class='container-module-parent'>
            <form name="form_module1" action='' method='post'>
                <div class='container-module'>
                    <div class='container-form'>
                        <h2>Module de Cryptographie</h2>
                        <p>Cryptage/Décryptage RC4</p>

                        <div class='inputs-module'>

                            <fieldset>
                                <legend>Selectionner une méthode</legend>
                                
                                <input type="radio" id="crypter" name="methode" value="Cryptage">
                                <label for="crypter">Chiffrement</label>

                                <input type="radio" id="decrypter" name="methode" value="Decryptage">
                                <label for="decrypter">Déchiffrement</label>
                            </fieldset>

                            <p class="titre-form">Votre message:</p>
                            <label id="label_input_message" for="input_message">
                            <input type="text" name="input_message" id="input_message" placeholder="Votre groupe mérite un 20/20 !" value=""/>

                            <p class="titre-form">La clef:</p>
                            <label id="label_input_clef" for="input_clef">
                            <input type="text" name="input_clef" id="input_clef" placeholder="20/20" value=""/>
              
                        </div>

                        <input id="input-module-send" name='submit' type="submit" value="Executer"></input>
                    </div>
                    <div class="vertical-line"></div>
                    <div class='container-resultat'>
                        <h2>Résultat</h2>
                        <?php
                            $chiffrement = false;   //drapeau pour insertion ds BD d'un chiffrement si aucune erreur
                            $dechiffrement = false; //drapeau pour insertion ds BD d'un dechiffrement si aucune erreur

                            require_once('config/config_bdd.php');

                            if (isset($_POST['submit'])){
                                if (!empty($_POST['input_message'])){
                                    if (!empty($_POST['input_clef'])){
                                        if (!empty($_POST['methode'])){

                                            $methode = trim($_POST["methode"]);
                                            $message = trim($_POST['input_message']);
                                            $clef = trim($_POST['input_clef']);

                                            //Insertion pour statistiques
                                            $requete="INSERT INTO activitemodule (id_module, login) VALUES  (2, '".$_SESSION["user"]["login"]."')";
                                            $requete2 = mysqli_query($connexion, $requete);
                                            $message = '"'.$message.'"';

                                            if ($methode == "Cryptage"){
                                                //$result = exec("python3 python_module2/crypter.py ". $message . " " . $clef);
                                                $result = exec("python3 python_module2/rc4.py". " c ".  $message . " " . $clef);
                                                $chiffrement = true;
                                            }
                                            if ($methode == "Decryptage"){
                                                //$result = exec("python3 python_module2/decrypt.py ". $message . " " . $clef);
                                                $result = exec("python3 python_module2/rc4.py". " d ".  $message . " " . $clef);
                                                $dechiffrement = true;
                                            }
                                            if ($result == "Le message ne possede pas le bon format"){
                                                //message d'erreur de python, à ne pas insérer
                                                echo "<p class='err'>Le message ou la clé n'existe pas.</p>";
                                                $chiffrement=false;
                                                $dechiffrement=false;
                                            }
                                            echo "<div class='result-module2-center'>". $result ."</div>";

                                        }
                                        else{
                                            echo "<p class='err'>Vous n'avez pas choisi méthode.</p>";
                                        }
                                    }
                                    else{
                                        echo "<p class='err'>Vous n'avez pas rentré la clé.</p>";
                                    }
                                }
                                else{
                                    echo "<p class='err'>Vous n'avez pas rentré le message.</p>";
                                }
                            }
                            if ($chiffrement){
                                //Insertion pour historique utilisateurs
                                $insertion = "INSERT INTO historique_module2 (login, bool_chiffrement, message, cle, resultat) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."')";
                                $insertion2 = mysqli_query($connexion, $insertion);
                            }
                            elseif ($dechiffrement){
                                //Insertion pour historique utilisateurs
                                $insertion = "INSERT INTO historique_module2 (login, bool_dechiffrement, message, cle, resultat) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."')";
                                $insertion2 = mysqli_query($connexion, $insertion);
                            }

                        ?>
                    </div>
                </div>                
                <input id="historique" name='historique' type="submit" value="Historique des Mots de Passes"></input>
                <?php
                    if (isset($_POST["historique"])){
                        $login=$_SESSION["user"]["login"];
                        recherche($login);
                    }
                ?>
            </form>
        </div>
    </body>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>



<?php
    function recherche($login){

        //configuration d'accès à la base de donnée avant de commencer.
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

        //requete pour afficher tout les mots de passes entrée par l'utiisateur utilisant le module
        $recherche=mysqli_query($connexion,"SELECT bool_chiffrement, bool_dechiffrement, message, cle, resultat FROM historique_module2 where login like '".$login."%'");

        //On affiche la base d'un tableau.
        echo "<table class='tab'>";

        echo "<tr id='titre_tab'><th>Chiffrement</th><th>Déchiffrement</th><th>Message</th><th>Clef</th><th>Résultat</th></tr>";

        //Pour chaques lignes assigé comme plusieurs valeurs, on récupère et affiche les données (1 seul car chaque "login" est unique).
        while ($ligne = mysqli_fetch_row($recherche)) {
            echo "<tr>";
            foreach ($ligne as $v) {
                echo "<td>" . $v . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>
