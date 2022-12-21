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
            <p class="pacc_mod_pres">Texte Présentation</p>
        </div>

        <div class='container-module-parent'>
            <form name="form_module1" action='' method='post'>
                <h2>Module de Cryptographie</h2>
                <p>Cryptage/Décryptage RC4</p>

                <div class='inputs-module'>


                    <fieldset>
                        <legend>Selectionner une option</legend>
                        
                        <input type="radio" id="crypter" name="option" value="Cryptage">
                        <label for="crypter">Chiffrement</label>

                        <input type="radio" id="decrypter" name="option" value="Decryptage">
                        <label for="decrypter">Déchiffrement</label>

                    </fieldset>

                    <label for="input_message"> Votre message</label>
                    <input type="text" name="input_message" id="input_message" placeholder="Texte" value="" : />

                    <label for="input_clef">La clef</label>
                    <input type="text" name="input_clef" id="input_clef" placeholder="Clef" value="" : />
                    
                </div>

                <input id="input-module-send" name='submit' type="submit" value="Executer"></input>

                <div class='container-resultat'>
                    <h2>Résultat</h2>
                    <?php
                        require_once('config/config_bdd.php');
                        $chiffrement = false;       //drapeau pour insertion ds BD d'un chiffrement si aucune erreur
                        $dechiffrement = false;     //drapeau pour insertion ds BD d'un dechiffrement si aucune erreur
                        if (isset($_POST['submit'])){
                            if (isset($_POST['input_message'])){
                                if (isset($_POST['input_clef'])){
                                    if (isset($_POST["option"])){

                                        //Insertion pour statistiques
                                        $requete="INSERT INTO activitemodule (id_module, login) VALUES  (2, '".$_SESSION["user"]["login"]."')";
                                        $requete2 = mysqli_query($connexion, $requete);

                                        $option = $_POST["option"];
                                        $message = $_POST['input_message'];
                                        $clef = $_POST['input_clef'];
                                        $message = trim($message);
                                        $message = '"'.$message.'"';

                                        if ($option == "Cryptage"){
                                            $result = exec("python3 python_module2/crypter.py ". $message . " " . $clef);
                                            $chiffrement = true;    //drapeau pour indiquer que l'on peut insérer
                                        }

                                        if ($option == "Decryptage"){
                                            $result = exec("python3 python_module2/decrypt.py ". $message . " " . $clef);
                                            $dechiffrement=true;    //drapeau pour indiquer que l'on peut insérer
                                        }
                                        echo $result;

                                        if ($result == "Le message ne possede pas le bon format"){ //message d'erreur de python, à ne pas insérer
                                            $chiffrement=false;
                                            $dechiffrement=false;
                                        }
                                    }
                                    else{
                                        echo "<p class='err'> Vous n'avez pas choisi méthode.</p>";
                                    }
                                }
                                else{
                                    echo "<p class='err'> Vous n'avez pas rentré la clé.</p>";
                                }
                            }
                            else{
                                echo "<p class='err'> Vous n'avez pas rentré le message. </p>";
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
    $recherche=mysqli_query($connexion,"SELECT * FROM historique_module2 where login like '".$login."%'");

    //On affiche la base d'un tableau.
    echo "<table class='tab'>";

    echo "<tr id='titre_tab'><th>ID Historique</th><th>ID Module</th><th>Login</th><th>Chiffrement</th><th>Déchiffrement</th><th>Message</th><th>Clef</th><th>Résultat</th></tr>";


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