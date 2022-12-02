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
		<nav class = "menu-nav">
			<ul id="ul-container">

				<li class ="nav-logo">
					<a href="index.php"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
				</li>

				<li class="nav-item">
					<a href="index.php"><b>Page d'accueil</b></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Mes Services</b></a>
					<ul class = "nav-item-services">
						<li><a href="module1.php"><b>Module 1</b></a></li>
						<li><a href="404.php"><b>Module 2</b></a></li>
						<li><a href="404.php"><b>Module 3</b></a></li>
					</ul>
				</li>

				<?php

                    //On regarde si une cession existe.
                    //session_start();   
                    //Si aucune cession existe, on renvois sur la page de connexion.
                    if(isset($_SESSION['user'])) {
                        if($_SESSION['user']['type_user'] != 'user'){
                            echo"
                            <li class='nav-item'>
                              <a href='page_admin.php'><b>Administration</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='page_user.php'><b>Mon Espace</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='deconnexion.php'><b>Se déconnecter</b></a>
                            </li>
                            ";
                        }else{
                            echo "
                            <li class='nav-item'>
                              <a href='page_user.php'><b>Mon Espace</b></a>
                            </li>

                            <li class='nav-item'>
                                <a href='deconnexion.php'><b>Se déconnecter</b></a>
                            </li>
                            ";
                        }
                    }else{
                        echo "
                        <li class='nav-item'>
                            <a href='connexion.php'><b>Se connecter</b></a>
                        </li>
                        ";
                    }
                    
                ?>

			</ul>
		</nav>

        <div class="entete">
            <h1>X Calculator</h1>
            <h2>Module 1</h2>
            <br>
            <p class="pacc_mod_pres">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <div class='container-centrer'>
            <form name="form_module1" action='' method='post'>
                <div class='container-module'>
                    <div class='container-form'>
                        <h2>Module 1</h2>
                        <h3>Calcul d'une probabilité à l'aide d'une loi normale</h3>

                        <select name="choix_methode" id="choix_methode">
                            <option value="rectangles_gauches.py">Rectangles gauches</option>
                            <option value="rectangles_droites.py">Rectangles droits</option>
                            <option value="rectangles_medians.py">Rectangles medians</option>
                            <option value="methode_trapezes.py">Trapèzes</option>
                            <option value="methode_simpson.py">Simpson</option>
                        </select>

                        <div class='inputs'>
                            <p>Valeur de µ :</p>
                            <input type="text" name="esp" value="<?php echo isset($_POST['esp']) ? $_POST['esp'] : '' ?>"/>

                            <p>Valeur de σ :</p>
                            <input type="text" name="et" value="<?php echo isset($_POST['et']) ? $_POST['et'] : '' ?>"/>

                            <p>Valeur de t :</p>
                            <input type="text" name="t" value="<?php echo isset($_POST['t']) ? $_POST['t'] : '' ?>"/>

                        </div>

                        <p><input id="label-login-mdp" type="submit" value="Calculer P(X<t) "/></p>
                        <p><input id="label-login-mdp" type="reset" value="Annuler"/></p>
                    </div>
                    <div class='container-resultat'>
                        <h2>Résultat</h2>

                        <?php

                            if (isset($_POST['esp'], $_POST['et'], $_POST['t'])){
                                $esp = $_POST["esp"]; #récupere les entrées
                                $et = $_POST["et"] ;
                                $t = $_POST["t"];
                                $fonction = $_POST["choix_methode"] ;
                                #echo $fonction;
                                $command = "python python_module1/$fonction $esp $et $t "; # Préparation de la commande
                                #echo $command;
                                $result = exec($command); # execution de la commande dans un shell 'imaginaire'
                                                                # et on récupere le resultat
                                $float_value = (float) $result; #conversion du resultat en float
                                echo $result;
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
	
  </body>
</html>