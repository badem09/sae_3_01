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

        <div class='container-module-parent'>
        <a href="module2_1.php" aria-label="lien_page_module2"><input type="button" value="Chiffrement RC4"></a>
        <a href="module2_2.php" aria-label="lien_page_module2"><input type="button" value="Chiffrement WEP"></a>


        </div>
    </body>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>