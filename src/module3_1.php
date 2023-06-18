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
                                    text: "Ce module permet de déterminer le sentiment de texte à caractères financiers provenant du site ft.com. Pour cela, cliquer sur le bouton permettant d'afficher les données. ",
                                    confirmButtonText: "Compris",
                                    confirmButtonColor: "#000A7E",
                                });
                            }
                        </script>
                        <p>Prédiction et WebScappring</p>
                        <form name="form_module3" action='' method='post'>
                            <input id="boutonAfficher" name='submit' type="submit" value="Afficher">
                        </form>
                        <h2>Résultat</h2>
                        <div class="div-affi-ml">
                        <?php
                            $connexion=mysqli_connect("localhost","root","");
                            $bd=mysqli_select_db($connexion,"bd_sae");

                            $requete="INSERT INTO activitemodule (id_module, login) VALUES  (3, '".$_SESSION["user"]["login"]."')";
                            mysqli_query($connexion,$requete);

                            if (isset($_POST['submit'])){

                                $command = "python python_module3/WebScrapping.py";
                                exec($command);
                                $file = file_get_contents("python_module3/predictions.json");
                                $data = json_decode($file, true);

                                echo "<table class='tab'  id='tab_pred'>";
                                echo"<tr><th>Date</th> <th>Titre</th> <th>Sentiment</th> </tr>";

                                foreach ($data as $key => $value) {
                                 echo "<tr> <td>$value[1]</td> <td>$key</td> <td>$value[0]</td></tr>";
                                }
                                //TODO : changer le format de la date
                                echo "</table>";
                                $insertion = "INSERT INTO historique_module3 (login) VALUES ('".$_SESSION["user"]["login"]."')";
                                mysqli_query($connexion,$insertion);

                            }else{
                                echo "<table class='tab'  id='tab_pred'>";
                                echo"<tr><th>Date</th> <th>Titre</th> <th>Sentiment</th> </tr>";
                                echo "<tr> <td>ex : 2023-04-10T13:50:59.396Z</td> <td>ex : Yen slides as new Bank of Japan governor sticks to ultra-loose policy</td> <td>neutral</td></tr>";
                                echo "</table>";
                            }
                        ?>
                        </div>
                    </div>
                 </div>
            </div>
            <?php require("imports_html/footer.html"); ?>
        </div>
    </body>
</html>