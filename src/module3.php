<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header('Location: connexion.php');
    }
?>

<!doctype html>
<html lang="fr">
    <?php require("imports_html/head.html"); ?>
    <div class='container-height'>
        <body>
            <?php require("imports_html/nav_bar.html"); ?>
            <div class="entete">
                <h1>X Calculator</h1>
                <h2>Module de Machine Learning</h2>
                <br>
                <p class="pacc_mod_pres">Vous pouvez tester une intelligence artificielle à détecter les sentiments de vos phrases préférées.</p>
            </div>
            <div class='container-module-parent'>
                <div class='container-module'>
                    <div class='inputs-module'>
                        <h3>Veuillez choisir la méthode que vous souhaitez utiliser.</h3>
                        <a href="module3_1.php"><input class='btn-simple-bleu' id='prediction_site' name='choix' value="Prédiction du site"></a>
                        <a href="module3_2.php"><input class='btn-simple-bleu' id='prediction_user' name='choix' value="Prédiction sur votre phrase"></a>
                    </div>
                </div>
            </div>    
        </body>
        <?php require("imports_html/footer.html"); ?>
    </div>
</html>