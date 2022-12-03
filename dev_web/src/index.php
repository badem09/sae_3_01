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
					<a href="#"><img class ="nav-logo" src="img\logo_t.png" alt="logo_SiteWeb_X"></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Page d'accueil</b></a>
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
          session_start();	 
			    //On attribus les bon boutons au bonnes personnes.
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
		</div>

		<div class="presentation">
			<h2>Bienvenue !</h2>
		</div>

		<div class="pacc_mod_gauche"> 
			<div class="pacc_mod_image">
				<a href ="module1.php"><img src="img\module1.png" alt="image d'une courbe d'une fonction mathématique quelquonque"></a>
			</div>

			<div>
				<h3>Module de probabilité : calcul approché d'une loi normale.</h3>

				<p>Ce module vous permettra de calculer une probabilité 
					dans le cadre d’une loi normale de paramètres m et σ.</br>
					Vous pourrez calculer P (X < t) en saisissant la valeur de m, de σ et t
					</br>
					Vous aurez le choix entre les méthodes des rectangles, 
					la méthode des trapèzes et la méthode de Simpson.
				</p>

				<a href="module1.php" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<div class="pacc_mod_droit"> 
			<div>
				<h3>Module2</h3>
				<p>A venir très prochainement !</p>
				</br></br></br></br></br></br></br>
				<a href="404.html" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
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
				<h3>Module3</h3>

				<p>A venir très prochainement !</p>
				</br></br></br></br></br></br></br>
				<a href="404.html" aria-label="lien_page_connexion"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<?php
	  	//On inclus le footer de la page.
	  	require("imports_html/footer.html");
  	?>

  </body>
</html>