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

    <div class='container-height'>
  
        <body>
    		
            <?php
                //On inclus la barre de navigation.
                require("imports_html/nav_bar.html");
            ?>

            <div class="entete">
                <h1>X Calculator</h1>
                <h2>Module de Cryptographie</h2>
                <br>
                <p class="pacc_mod_pres">Vous pouvez chiffrer et déchiffrer un message avec le chiffrement RC4 ou le chiffrement WEP.</p>
            </div>

            <div class='container-module-parent'>
                <div class='container-module'>
                    <div class='inputs-module'>
                        <h3>Veuillez choisir la méthode que vous souhaitez utiliser.</h3>

                        <a href="module2_1.php"><input class='btn-simple-bleu' id='RC4' name='methode' value='RC4'></a>
                        <a href="module2_2.php"><input class='btn-simple-bleu' id='WEP' name='methode' value='WEP'></a>

                    </div>
                </div>
            </div>

        </body>

        <?php
            //On inclus le footer de la page.
            require("imports_html/footer.html");
        ?>

    </div>

</html>