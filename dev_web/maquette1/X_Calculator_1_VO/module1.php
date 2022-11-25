<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css\css.css">
		<link rel="icon" type="image/x-icon" href="img\logo_t.ico">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>X Calculator | V0.0</title>
  </head>
  
  <body>
		<nav class = "menu-nav">
			<ul id="ul-container">

				<li class ="nav-logo">
					<a href="index.html"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
				</li>

				<li class="nav-item">
					<a href="index.html"><b>Page d'accueil</b></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Mes Services</b></a>
					<ul class = "nav-item-services">
						<li><a href="connexion.php"><b>Module 1</b></a></li>
						<li><a href="connexion.php"><b>Module 2</b></a></li>
						<li><a href="connexion.php"><b>Module 3</b></a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="connexion.php"><b>Se connecter</b></a>
				</li>

			</ul>
		</nav>

		<div class="formulaire">
			<h1>Calcul d'une probabilité à l'aide d'une loi normale</h1>
			
			<form name="form_module1" action="module1.php" method="post">
                <select name="choix_methode" id="choix_methode">
                    <option value="rectangles_gauches.py">Rectangles gauches</option>
                    <option value="rectangles_droites.py">Rectangles droits</option>
                    <option value="rectangles_medians.py">Rectangles medians</option>
                    <option value="methode_trapezes.py">Trapèzes</option>
                    <option value="methode_simpson.py">Simpson</option>
            
                </select>
                <p>
                    Valeur de µ :<br />
                    <input type="text" name="esp" value="" />
                </p>
                <p>
                    Valeur de σ :<br />
                    <input type="text" name="et" value=""  />
                </p>
                <p>
                    Valeur de t :<br />
                    <input type="text" name="t" value=""  />
                </p>
                <p>
                    <input type="submit" value="Calculer P( t < X ) " />
                    <input type="reset" value="Annuler" />
                </p>
            </form>
		</div>
	
  </body>
</html>

<?php

if (isset($_POST['esp'], $_POST['et'], $_POST['t'])){
    $esp = $_POST["esp"]; #récupere les entrées
    $et = $_POST["et"] ;
    $t = $_POST["t"];
    $fonction = $_POST["choix_methode"] ;

    $command = 'python'. ' '. 'python_module1/' . $fonction . ' '
        . $esp . ' ' . $et . ' ' .$t . ' ' ; # Préparation de la commande 

    $result = shell_exec($command); # execution de la commande dans un shell 'imaginaire'
                                    # et on récupere le resultat
    $float_value = (float) $result; #conversion du resultat en float
    if (strval($float_value) == $result){ # si le résultat est bien un nb a virgule (float)
        echo 'P( ' . $t . ' < X ) = ' . $result;
    }
    else{ #sinon erreur fournie par script python
        echo $result;
    }

}
?>

