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
    
  <script src="js/graphe_module1.js"></script>
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
            <h2>Module de probabilité.</h2>
            <br>
            <p class="pacc_mod_pres">Vous pouvez calculer P(X < t) en saisissant la valeur de m, de σ et t (à 10^-5 près).</p>
        </div>

        <div class='container-module-parent'>
            <form name="form_module1" action='' method='post'>
                <div class='container-module'>
                    <div class='container-form'>
                        <h2>Module de probabilité.</h2>
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
                            //Si le bouton calculer est cliqué on continus.
                            if(isset($_POST['submit'])){
                                //Si le champ "choix_methode" n'est pas vide on continus.
                                if(!empty($_POST['choix_methode'])){
                                    //Si le champ "esp" n'est pas vide on continus.
                                    if(isset($_POST['esp'])){
                                        //Si le champ "et" n'est pas vide on continus.
                                        if(isset($_POST['et'])){
                                            //Si le champ "t" n'est pas vide on continus.
                                            if(isset($_POST['t'])){

                                                #Insertion pour avoir les statistiques d'utilisations

                                                //On inclus la configuration de la base de données.
                                                require_once('config/config_bdd.php');

                                                //On prépare la requete
                                                $requete=mysqli_query($connexion,"INSERT INTO activitemodule (id_module, login) VALUES  (1, '".$_SESSION["user"]["login"]."')");
                                                
                                                #On récupere les entrées.
                                                $esp = $_POST["esp"];
                                                $et = $_POST["et"] ;
                                                $t = $_POST["t"];
                                                $methode = $_POST['choix_methode'];
                                                #On vérifie si elle sont bien des chiffres.
                                                if (!(is_numeric($esp) && is_numeric($et) && is_numeric($t))){
                                                    //Si non on renvois une erreur.
                                                    echo "<p class='err'> Erreur : Un (ou plusieurs) paramêtre n'est pas au bon format.</p>";
                                                //On vérifie que "et" n'est pas null.
                                                } else if ($et <= 0){
                                                    //Si non on renvois une erreur.
                                                    echo "<p class='err'> La valeur de σ ne peux pas être inférieure ou égale à 0.</p>";
                                                //Dans le cas ou tout est bon on calcule et on affiche les resultats.
                                                } else {
                                                $fonction = $_POST["choix_methode"] ;
                                                #Préparation de la commande.
                                                $command = "python ../python_module1/$fonction $esp $et $t "; 
                                                #Execution de la commande et on récupere le resultat.
                                                $result = exec($command); 
                                                #On affiche le résultat.
                                                echo "<h1>".$result."</h1>";
                                                #On envoie le graphique.
                                                echo '<h4>Représentation graphique</h4>
                                                    <canvas id="can2" width="400" height="240"></canvas>
                                                    <script type="text/javascript">maj();</script>';

                                                $array = str_split($result);
                                                $res = implode("",array_slice($array,9));
                                                $requete2 = mysqli_query($connexion,"INSERT INTO historique_module1(login,methode,esperance,ecart_type,t,res) 
                                                                                    VALUES('".$_SESSION["user"]["login"]."','".$methode."','".$esp."','".$et."','".$t."','".$res."')");                                                }

                                            }else{
                                                //Si µ est vide, on affiche une erreur.
                                                echo "<p class='err'> Erreur : Le champ \"t\" est vide.</p>";
                                            }
                                        }else{
                                            //Si σ est vide, on affiche une erreur.
                                            echo "<p class='err'> Erreur : Le champ \"σ\" est vide.</p>";
                                        }
                                    }else{
                                        //Si t est vide, on affiche une erreur.
                                        echo "<p class='err'> Erreur : Le champ \"µ\" est vide.</p>";
                                    }
                                }else{
                                    //Si la méthode de calcule n'est pas choisis, on affiche une erreur.
                                    echo "<p class='err'> Erreur : Vous n'avez pas choisis la methode.</p>";
                                }
                            }

                        ?>
                    </div>
                </div>
            </form>
        </div>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>