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
        <div class='container-height'>
            <div class="entete">
                <h1>X Calculator</h1>
                <h2>Module de Machine Learning</h2>
            </div>
            <div class='container-module-parent'>
                <div class='container-module container-module-ml'>
                    <div class="div-affi-ml">
                        <h2>Module de Machine Learning</h2>
                        <input class="pop-up-btn pop-up-btn-2" onclick="displayInfo()" name='popup' type="button" value="I"> <!--bouton (pas mettre de submit sinon bug) permettant d'afficher un pop avec les infos d'utilsation du module-->
                        <script>
                            function displayInfo(){ //SweetAlert : libre accès
                                Swal.fire({
                                    title : "Informations d'utilisations",
                                    text: "Ce module permet de déterminer le sentiment de la phrase de votre choix. Pour cela renseigner une phrase en Anglais dans l'emplacement prévu à cet effet. ",
                                    confirmButtonText: "Compris",
                                    confirmButtonColor: "#000A7E",
                                });
                            }
                        </script>
                        <p>Prédiction et WebScappring</p>
                        <form method="post">
                            <input aria-label="input-research" id='user_text' type='text' name="user_text"  placeholder="">
                            <input class='btn-simple-bleu' id='submit' type='submit' name='submit' value='Predire'>
                        </form>
                        <h2>Résultat</h2>
                        <?php
                            $connexion=mysqli_connect("localhost","root","");
                            $bd=mysqli_select_db($connexion,"bd_sae");

                            $requete="INSERT INTO activitemodule (id_module, login) VALUES  (3, '".$_SESSION["user"]["login"]."')";
                            mysqli_query($connexion,$requete);

                            if (isset($_POST['submit'])){
                                $user_text = $_POST['user_text'];
                                $command = 'python python_module3/WebScrapping.py "' . $user_text . '"'  ;
                                $prediction = exec($command);
                                echo "<p>$prediction</p>";
                                $user_text = mysqli_real_escape_string($connexion ,$user_text);
                                $insertion = "INSERT INTO historique_module3 (login, phrase) VALUES ('".$_SESSION["user"]["login"]."' , '". $user_text."')";
                                mysqli_query($connexion,$insertion);
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php require("imports_html/footer.html"); ?>
        </div>
    </body>
</html>