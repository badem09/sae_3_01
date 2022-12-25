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
                            <input aria-label="input-message" type="text" name="input_message" id="input_message" placeholder="Votre groupe mérite un 20/20 !" value=""/>

                            <p class="titre-form">La clef:</p>
                            <input aria-label="input-clef" type="text" name="input_clef" id="input_clef" placeholder="20/20" value=""/>
              
                        </div>

                        <input id="input-module-send" name='submit' type="submit" value="Executer"></input>
                    </div>

                    <div class="vertical-line"></div>

                    <div class='container-resultat'>
                        <h2>Résultat</h2>
                        <?php
                            $chiffrement = false;   //drapeau pour insertion ds BD d'un chiffrement si aucune erreur
                            $dechiffrement = false; //drapeau pour insertion ds BD d'un dechiffrement si aucune erreur

                            //On inclus la configuration de la base de données.
                            require_once('config/config_bdd.php');

                            //Si le bouton executer est cliqué.
                            if (isset($_POST['submit'])){
                                //Si le message n'est pas vide ou ne contient pas que des espaces, on continus.
                                if (!empty($_POST['input_message']) && trim($_POST["input_message"]) != ""){
                                    //Si la clef n'est pas vide ou ne contient pas que des espaces, on continus.
                                    if (!empty($_POST['input_clef']) && trim($_POST["input_clef"]) != ""){
                                        //Si la methode est bien selectionné, on continus.
                                        if (!empty($_POST['methode']) && trim($_POST["methode"]) != ""){

                                            //On prépare nos variables sans espaces.
                                            $methode = trim($_POST["methode"]);
                                            $message = trim($_POST['input_message']);
                                            $clef = trim($_POST['input_clef']);

                                            #Insertion pour statistiques
                                            //On prépare la requite qui insère dans "activitemodule", l'id du module et son utilisateur.
                                            $requete="INSERT INTO activitemodule (id_module, login) VALUES  (2, '".$_SESSION["user"]["login"]."')";
                                            //On execute la requete.
                                            $requete2 = mysqli_query($connexion, $requete);

                                            //On définis le message.
                                            $message = '"'.$message.'"';

                                            //Si la methode est Cryptage.
                                            if ($methode == "Cryptage"){
                                                //On récupere le resultat que fournis notre commande.
                                                $result = exec("python3 python_module2/rc4.py". " c ".  $message . " " . $clef);
                                                //On définit le drapeu chiffrement à true.
                                                $chiffrement = true;
                                                //On renvoir le résultat
                                                echo $result;
                                            }
                                            //Si la methode est Decryptage.
                                            if ($methode == "Decryptage"){
                                                //On récupere le resultat que fournis notre commande.
                                                $result = exec("python3 python_module2/rc4.py". " d ".  $message . " " . $clef);
                                                //On définit le drapeu chiffrement à true.
                                                $dechiffrement = true;
                                                //On renvoir le résultat
                                                echo $result;
                                            }

                                            //Si le résultat renvoyé par le fichier est "Le message ne possede pas le bon format"
                                            if ($result == "Le message ne possede pas le bon format"){
                                                //On affiche un message d'erreur.
                                                echo "<p class='err'>Le message ou la clé n'existe pas.</p>";
                                                //On définit les drapeaux à flase.
                                                $chiffrement=false;
                                                $dechiffrement=false;
                                            }

                                            //Si le drapeau chiffrement est à true.
                                            if ($chiffrement){
                                                //On prépare la requete qui insère dans historique_module2, le login, un booléans, le message, la clé, et le résultat.
                                                $insertion = "INSERT INTO historique_module2 (login, bool_chiffrement, message, cle, resultat) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."')";
                                                //On execute la requete.
                                                $insertion2 = mysqli_query($connexion, $insertion);
                                            }elseif ($dechiffrement){
                                                //On prépare la requete qui insère dans historique_module2, le login, un booléans, le message, la clé, et le résultat.
                                                $insertion = "INSERT INTO historique_module2 (login, bool_dechiffrement, message, cle, resultat) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."')";
                                                //On execute la requete.
                                                $insertion2 = mysqli_query($connexion, $insertion);
                                            }
                                        }else{
                                            //Si aucune méthode n'a été choisis, on renvoie une erreur.
                                            echo "<p class='err'>Vous n'avez pas choisi méthode.</p>";
                                        }
                                    }else{
                                        //Si aucune clé n'a été entrée, on renvoie une erreur.
                                        echo "<p class='err'>Vous n'avez pas rentré la clé.</p>";
                                    }
                                }else{
                                    //Si aucuns message n'a été entré, on renvoie une erreur.
                                    echo "<p class='err'>Vous n'avez pas rentré le message.</p>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </form>

            <div class="div-affi-histo-mod2">
                <h2>Votre historique :</h2>
                <a href="module2.php"><input id="historique" name='historique' type="submit" value="Actualiser votre historique"></input></a>
                <?php
                    //On appel la fonction qui affiche l'historique avec le login en paramètre.
                    recherche($_SESSION["user"]["login"]);
                ?>
            </div>
            
        </div>
    </body>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>

<?php
    function recherche($login){

        //On ajoute la configuration d'accès à la base de donnée.
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

        //On prépare la requete pour afficher tout les mots de passes entrée par l'utiisateur utilisant le module
        $recherche=mysqli_query($connexion,"SELECT bool_chiffrement, bool_dechiffrement, message, cle, resultat FROM historique_module2 where login like '".$login."%'");

        //On affiche la base d'un tableau.
        echo "<table class='tab'>";
        //On affiche les titres du tableau.
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