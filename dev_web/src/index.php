<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css\css.css">
		<link rel="icon" type="image/x-icon" href="img\logo_t.ico">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>X Calculator | V0.1</title>
  </head>
  
  <body>
		<nav class = "menu-nav">
			<ul id="ul-container">

				<li class ="nav-logo">
					<a href="#"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Page d'accueil</b></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Mes Services</b></a>
					
					<ul class = "nav-item-services">
						<li><a href="module1.php"><b>Module 1</b></a></li>
						<li><a href="connexion.php"><b>Module 2</b></a></li>
						<li><a href="connexion.php"><b>Module 3</b></a></li>
					</ul>
				</li>

				<?php

					//On regarde si une cession existe.
          session_start();	 
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
			<h2>On peut tout calculer !</h2>
			<br>
			<!--<p class="pacc_mod_pres">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
		</div>

		<div class="presentation">
			<h2>Texte explicatif</h2>
			<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas velit ex, vel sodales tellus commodo non. Vivamus aliquet metus vel purus semper tristique. Proin ipsum justo, aliquam nec faucibus nec, bibendum nec turpis.</p>--->
			<p>Bonjour. Sur ce site vous aurez accès à un module de probabilité (calcul de loi normale) un module de cryptographie (prochainement) et un troisième module.</p>
		</div>

		<div class="pacc_mod_gauche"> 
			<div class="pacc_mod_image">
				<img src="img\module1.png" alt="image d'une intégrale">
			</div>

			<div>
				<h3>Module1 : Calcul de loi normale P(X &lt t) </h3>

				<p>Ce module propose une approxiamtion du calcul d’une probabilité dans le cadre d’uneloi normale de paramètres m et σ. </br>
				   L’utilisateur pourra alors saisir la valeur de m, de σ et t pour calculer P (X < t)</br>
				   Vous pourrez choisir entre les différentes méthodes des rectangles, des trapèzes ou de Simpson.</br>
				   L’application web renverra le résultat avec au moins 5 décimales.</p>

				<a href="module1.php" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<div class="pacc_mod_droit"> 
			<div>
				<h3>Module2</h3>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas velit ex, vel sodales tellus commodo non. Vivamus aliquet metus vel purus semper tristique. Proin ipsum justo, aliquam nec faucibus nec, bibendum nec turpis.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas velit ex, vel sodales tellus commodo non. Vivamus aliquet metus vel purus semper tristique. Proin ipsum justo, aliquam nec faucibus nec, bibendum nec turpis.</p>
				<a href="connexion.php" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
			</div>

			<div class="pacc_mod_image">
				<img src="img\carre_page_acceuil.png" alt="image_EnCoursDeDeveloppemnt">
			</div>
		</div>

		<div class="pacc_mod_gauche"> 
			<div class="pacc_mod_image">
				<img src="img\carre_page_acceuil.png" alt="image_EnCoursDeDeveloppemnt">
			</div>

			<div>
				<h3>Module1</h3>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas velit ex, vel sodales tellus commodo non. Vivamus aliquet metus vel purus semper tristique. Proin ipsum justo, aliquam nec faucibus nec, bibendum nec turpis.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas velit ex, vel sodales tellus commodo non. Vivamus aliquet metus vel purus semper tristique. Proin ipsum justo, aliquam nec faucibus nec, bibendum nec turpis.</p>
				<a href="connexion.php" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<div class="footer">
			<footer>

				<ul class="list-items">
					<li class="list-inline-item">
						<a href="404.html">Réseau 1</a>
						<a href="404.html">Réseau 2</a>
						<a href="404.html">Réseau 3</a>
					</li>
				</ul>

				<ul class="list-items">
					<li class="list-inline-item">
						<a href="404.html">CGV</a>
						<a href="404.html">CGU</a>
					</li>
				</ul>

				<ul class="list-items">
					<li class="list-inline-item">
						<p class="copyright">©2022</p>
					</li>
				</ul>

			</footer>
		</div>
	
  </body>
</html>
