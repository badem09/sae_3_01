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
                        <legend>Selectionner une méthode</legend>
                        
                        <input type="radio" id="crypter" name="methode" value="Cryptage">
                        <label for="crypter">Chiffrement</label>

                        <input type="radio" id="decrypter" name="methode" value="Decryptage">
                        <label for="decrypter">Déchiffrement</label>
                        
                    </fieldset>

                    <label for="input_message"> Votre message</label>
                    <input type="text" name="input_message" id="input_message" placeholder="Votre groupe mérite un 20/20 !" value="" : />               
                    
                    <label for="input_clef">La clef</label>
                    <input type="text" name="input_clef" id="input_clef" placeholder="Votre groupe mérite un 20/20 !" value="" : />              
                    
                </div>

                <input id="input-module-send" name='submit' type="submit" value="Executer"></input>

                <div class='container-resultat'>
                    <h2>Résultat</h2>
                    <?php
                        
                        
                        if (isset($_POST['submit'])){
                            $message = trim($_POST['input_message']);
                            $clef = trim($_POST['input_clef']);
                            if ($message){
                                if ($clef){
                                    if (isset($_POST["methode"])){
                                        require_once('config/config_bdd.php');
                                        $requete="INSERT INTO activitemodule (id_module, login) VALUES  (2, '".$_SESSION["user"]["login"]."')";
                                        $requete2 = mysqli_query($connexion, $requete);

                                        $message = '"'.$message.'"';
                                        if ($methode == "Cryptage"){
                                            $result = exec("python3 python_module2/crypter.py ". $message . " " . $clef);
                                        }
                                        if ($methode == "Decryptage"){
                                            $result = exec("python3 python_module2/decrypt.py ". $message . " " . $clef);
                                        }
                                        echo $result;
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
                    ?>
                </div>        
            </form>
        </div>
    </body>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>