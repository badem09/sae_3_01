<?php
    session_start();
    if(!isset($_SESSION['user'])) {
       header('Location: connexion.php');
    }
?>

<!doctype html>
<html lang="fr">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require("imports_html/head.html"); ?>
    <body>
        <?php require("imports_html/nav_bar.html"); ?>
        <div class="entete">
            <h1>X Calculator</h1>
            <h2>Module de Cryptographie</h2>
        </div>
        <div class='container-module-parent'>
            <form name="form_module1" action='' method='post'>
                <div class='container-module'>
                    <div class='container-form'>
                        <h2>Module de Cryptographie</h2>
                        <input class="pop-up-btn" onclick="displayInfo()" name='popup' type="button" value="I"> <!--bouton (pas mettre de submit sinon bug) permettant d'afficher un pop avec les infos d'utilsation du module-->
                        <script>
                            function displayInfo(){
                                Swal.fire({
                                    title : "Informations d'utilisations",
                                    text: "Ce module permet de crypter et décrypter un message à l'aide d'une clé personalisée, en utilisant le principe du cryptage WEP.",
                                    confirmButtonText: "Compris",
                                    confirmButtonColor: "#000A7E",
                                });
                            }
                        </script>
                        <p>Cryptage/Décryptage WEP</p>

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
                            $chiffrement = false;  
                            $dechiffrement = false; 

                            require_once('config/config_bdd.php');

                            if (isset($_POST['submit'])){
                                $haserror = false;
                                if (empty($_POST['input_message']) && trim($_POST["input_message"]) == ""){
                                    echo "<p class='err'>Vous n'avez pas rentré le message.</p>";
                                    $haserror = true;
                                }
                                if (empty($_POST['input_clef']) && trim($_POST["input_clef"]) == ""){
                                    echo "<p class='err'>Vous n'avez pas rentré la clé.</p>";
                                    $haserror = true;
                                }
                                if (empty($_POST['methode']) && trim($_POST["methode"]) == ""){
                                    echo "<p class='err'>Vous n'avez pas choisi méthode.</p>";
                                    $haserror = true;
                                }
                                if (!$haserror){
                                    $methode = trim($_POST["methode"]);
                                    $message = trim($_POST['input_message']);
                                    $clef = trim($_POST['input_clef']);

                                    $requete="INSERT INTO activitemodule (id_module, login) VALUES  (2, '".$_SESSION["user"]["login"]."')";
                                    $requete2 = mysqli_query($connexion, $requete);

                                    $message1 = $message;
                                    $message = '"'.$message.'"';

                                    if ($methode == "Cryptage"){
                                        $result = utf8_encode(exec("python3 python_module2/wep.py". " c ".  "$message" . " " . $clef));
                                        $chiffrement = true;
                                        echo $result;
                                    }
                                    if ($methode == "Decryptage"){
                                        if (is_hexa($message1)){
                                            $result = utf8_encode(exec("python3 python_module2/wep.py". " d ".  "$message" . " " . $clef));
                                            $dechiffrement = true;
                                            echo $result;
                                        }
                                        else{
                                            echo "<p class='err'>Décryptage : le message doit être en héxadécimal.</p>";
                                            $result = "";
                                        }
                                    }

                                    if ($result == "Le message ne possede pas le bon format"){
                                        echo "<p class='err'>Erreur d'éxecution</p>";
                                        $chiffrement=false;
                                        $dechiffrement=false;
                                    }
                                    if ($chiffrement){
                                        $insertion = "INSERT INTO historique_module2 (login, bool_chiffrement, message, cle, resultat, bool_wep) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."', 1)";
                                        $insertion2 = mysqli_query($connexion, $insertion);
                                    }elseif ($dechiffrement){
                                        $insertion = "INSERT INTO historique_module2 (login, bool_dechiffrement, message, cle, resultat, bool_wep) VALUES ('".$_SESSION["user"]["login"]."', 1, $message,'".$clef."', '".$result."', 1)";
                                        $insertion2 = mysqli_query($connexion, $insertion);
                                    }
                                }       
                            }
                        ?>
                    </div>
                </div>
            </form>

            <div class="div-affi-histo-mod2">
                <h2>Votre historique :</h2>
                <form method="post">
                    <input id="historique" name="historique" type="submit" value="Afficher votre historique"></input>
                    <?php
                    if (isset($_POST["historique"])) {
                        recherche($_SESSION["user"]["login"]);
                    }
                    ?>
                </form>
                <a href="module2_2.php" aria-label="lien_page_module2_2"><input id="historique" name="historique" type="submit" value="Cacher votre historique"></input></a>
                <a href="module2.php" aria-label="lien_page_module2"><input type="button" value="Retour au choix  de la méthode"></a>
            </div>
        </div>
    </body>
    <?php
        require("imports_html/footer.html");
    ?>
</html>

<?php
    function recherche($login)
    {

        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

        $recherche=mysqli_query($connexion,"SELECT bool_chiffrement, bool_dechiffrement, message, cle, resultat FROM historique_module2 where login = '".$login."' and bool_wep = 1");
        echo "<table class='tab'>";
        echo "<tr id='titre_tab'><th>Chiffrement</th><th>Déchiffrement</th><th>Message</th><th>Clef</th><th>Résultat</th></tr>";

        while ($ligne = mysqli_fetch_row($recherche)) {
            echo "<tr>";
            foreach ($ligne as $v) {
                echo "<td>" . $v . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    function is_hexa($num): bool
    {
        $alpha1 = 'abcdef';
        $alpha2 = 'ABCDEF';
        $num = str_replace(' ','',$num);

        foreach(str_split($num) as $elem){
            $is_maj = strpos($alpha1, $elem) !== false ;
            $is_min = strpos($alpha2, $elem) !== false ;

            /* PHP 8 :
            if (! str_contains($alpha1,$elem) && !  str_contains($alpha2,$elem) && ! is_numeric($elem)){*/
            if (! $is_maj && ! $is_min && ! is_numeric($elem)){
                return false;
            }
        }
        return true;
    }
?>
