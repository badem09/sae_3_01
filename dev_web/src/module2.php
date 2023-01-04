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
            <p class="pacc_mod_pres">Vous pouvez chiffrer et dechiffrer un message avec le chiffrement RC4 ou le chiffrement WEP (Explications?)</p>
        </div>

        <div class="mod-crypt-main">

            <div class="recherche crypt-recherche">

                <h2>Choisissez le type de cryptage</h2>
                <h3>Choisissez la methode que vous souhaitez utiliser!</h3>

                <form method="post" id='post-admin-up'>
                    <input class='btn-simple-bleu' id='RC4' type='submit' name='RC4' value='RC4'>
                    <input class='btn-simple-bleu' id='WEP' type='submit' name='WEP' value='WEP'>
                </form>

            </div>

            <?php
                if (isset($_POST["RC4"])) {
                    //On inclus la barre de navigation.
                    require("imports_html/module2_1.php");
                    
                }
                elseif (isset($_POST["WEP"])) {
                    //On inclus la barre de navigation.
                    require("imports_html/module2_2.php");
                }
            ?>

        </div>

    </body>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>