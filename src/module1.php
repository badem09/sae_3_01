<?php
    session_start();
    if(!isset($_SESSION['user'])) {
       header('Location: connexion.php');
    }
?>

<!doctype html>
<html lang="fr">
    
    <script src="js/graphe_module1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php require("imports_html/head.html");?>
  
    <body>
        <?php require("imports_html/nav_bar.html");?>

        <div class="entete">
        <h1>X Calculator</h1>
        <h2>Module de Probabilité</h2>
        </div>

        <div class='container-module-parent'>
        <form name="form_module1" action='' method='post'>
            <div class='container-module'>
                <div class='container-form'>
                    <h2>Module de Probabilité</h2>
                    <input class="pop-up-btn" onclick="displayInfo()" name='popup' type="button" value="I"> <!--bouton (pas mettre de submit sinon bug) permettant d'afficher un pop avec les infos d'utilsation du module-->
                    <script>
                        function displayInfo(){ //SweetAlert : libre accès
                            Swal.fire({
                                title : "Informations d'utilisations",
                                text: "Ce module permet de calculer une probabilité P(X < t) en saisissant la valeur de m, σ et t." + " Le résultat est affiché à  10^-5  près. ",
                                confirmButtonText: "Compris",
                                confirmButtonColor: "#000A7E",
                            });
                        }
                    </script>
                    <p>Calcul d'une probabilité à l'aide d'une loi normale</p>

                    <div class='inputs-module'>

                        <p class="titre-form-module-proba">Méthode de calcul :</p>
                        <select name="choix_methode" id="choix_methode">
                            <option  selected disabled hidden>Choisissez une méthode</option>
                            <option value="rectangles_gauches.py">Méthode rectangles gauches</option>
                            <option value="rectangles_droites.py">Méthode rectangles droits</option>
                            <option value="rectangles_medians.py">Méthode rectangles medians</option>
                            <option value="methode_trapezes.py">Méthode Trapèzes</option>
                            <option value="methode_simpson.py">Méthode Simpson</option>
                        </select>

                        <p class="titre-form-module-proba">Valeur de µ :</p>
                        <input aria-label="esp" type="text" name="esp" id="esp" placeholder="ex : 1" value="<?php echo isset($_POST['esp']) ? $_POST['esp'] : '' ?>"/>

                        <p class="titre-form-module-proba">Valeur de σ :</p>
                        <input aria-label="et" type="text" name="et" id="et" placeholder="ex : 1" value="<?php echo isset($_POST['et']) ? $_POST['et'] : '' ?>"/>

                        <p class="titre-form-module-proba">Valeur de t :</p>
                        <input aria-label="t" type="text" name="t" id ="t" placeholder="ex : 1" value="<?php echo isset($_POST['t']) ? $_POST['t'] : '' ?>"/>
                    </div>
                    <input id="input-module-send" name='submit' type="submit" value="Calculer">
                </div>
                <div class="vertical-line"></div>
                <div class='container-resultat'>
                    <h2>Résultat</h2>
                    <?php
                        if(isset($_POST['submit'])){
                            $haserror = false;
                            if(!isset($_POST['choix_methode'])){
                                echo "<p class='err'> Erreur : Vous n'avez pas choisis la methode.</p>";
                                $haserror = true;
                            }
                            if(empty($_POST['esp'])){
                                echo "<p class='err'> Erreur : Le champ \"µ\" est vide.</p>";
                                $haserror = true;
                             }
                            if(empty($_POST['et'])){
                                echo "<p class='err'> Erreur : Le champ \"σ\" est vide.</p>";
                                $haserror = true;
                            }
                            if(empty($_POST['t'])){
                                echo "<p class='err'> Erreur : Le champ \"t\" est vide.</p>";
                                $haserror = true;
                            }
                            if (! $haserror){
                                require_once('config/config_bdd.php');
                                $requete=mysqli_query($connexion,"INSERT INTO activitemodule (id_module, login) VALUES  (1, '".$_SESSION["user"]["login"]."')");

                                $esp = $_POST["esp"];
                                $et = $_POST["et"] ;
                                $t = $_POST["t"];
                                $methode = $_POST['choix_methode'];
                                if (!(is_numeric($esp) && is_numeric($et) && is_numeric($t))){
                                    echo "<p class='err'> Erreur : Un (ou plusieurs) paramêtre n'est pas au bon format.</p>";
                                } else if ($et <= 0){
                                    echo "<p class='err'> La valeur de σ ne peux pas être inférieure ou égale à 0.</p>";
                                } else {
                                $fonction = $_POST["choix_methode"] ;
                                $command = "python python_module1/$fonction $esp $et $t ";
                                $result = exec($command);
                                echo "<h1>".$result."</h1>";
                                echo '<h4>Représentation graphique</h4>
                                    <canvas id="can2" width="400" height="240"></canvas>
                                    <script type="text/javascript">maj();</script>';

                                $array = str_split($result);
                                $res = implode("",array_slice($array,9));
                                $requete2 = mysqli_query($connexion,"INSERT INTO historique_module1(login,methode,esperance,ecart_type,t,res) 
                                                                    VALUES('".$_SESSION["user"]["login"]."','".$methode."','".$esp."','".$et."','".$t."','".$res."')");
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
                <a href="module1.php" aria-label="lien_page_module1"><input id="historique" name="historique" type="submit" value="Cacher votre historique"></input></a>
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
    $recherche=mysqli_query($connexion,"SELECT methode, esperance, ecart_type, t, res FROM historique_module1 where login = '".$login."'");

    echo "<table class='tab'>";
    echo "<tr id='titre_tab'><th>Méthode</th><th>Espérance</th><th>Ecart Type</th><th>T</th><th>Résultat</th></tr>";

    while ($ligne = mysqli_fetch_row($recherche)) {
        echo "<tr>";
        foreach ($ligne as $v) {
            echo "<td>" . $v . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}