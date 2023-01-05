<!doctype html>
<html lang="fr">
  
  <?php
  	//On inclus le header de la page.
  	require("../imports_html/head.html");
  ?>
  
  <body>
		
		<?php
        //On inclus la barre de navigation.
        require("../imports_html/nav_bar.html");
    ?>

		<div class="entete">
			<h1>X Calculator</h1>
			<h3>On peut tout calculer !</h3>
			<br>
		</div>

		<div class="presentation">
			<h2>Bienvenue !</h2>
			<P>Sur notre site, vous avez la possibilité d'utiliser trois modules différents présentés ci-dessous, vous avez accès à de nombreuses fonctionnalités et vous pouvez pleinement profiter de notre site. N'oubliez pas de vous connecter pour y avoir accès !</P>
		</div>

		<div class="pacc_mod_gauche"> 
			<div class="pacc_mod_image">
				<a href ="module1.php"><img src="../img\module1.png" alt="image d'une courbe d'une fonction mathématique quelquonque"></a>
			</div>

			<div>
				<h3>Module de Probabilité : Calcul approché d'une loi normale.</h3>

				<p>Ce module vous permettra de calculer une probabilité 
					dans le cadre d’une loi normale de paramètres m et σ.
					</br>
					Vous pourrez calculer P (X < t) en saisissant la valeur de m, de σ et t
					</br>
					Vous aurez le choix entre les méthodes des rectangles, 
					la méthode des trapèzes et la méthode de Simpson.
					</br></br></br></br>
				</p>

				<a href="module1.php" aria-label="lien_page_module1"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<div class="pacc_mod_droit"> 
			<div>
				<h3>Module de Cryptographie :</h3>
				<p>Chiffrement et déchiffrement d'un code avec une clé en utilisant la méthode RC4 ou la méthode WEP.
					</br>
					Pour chiffrer, il vous faut le message que vous souhaitez chiffrer et une clé.
					</br>
					De même pour le décryptage, avec deux conditions au préalable :
					</br>
					- Le message à décrypter doit avoir été crypté et enregistré dans le système,
					</br>
					- Le message doit aussi conserver la même clé utilisée pour le chiffrage.
					</br></br>
				</p>
				<a href="module2.php" aria-label="lien_page_module2"><input type="button" value="Y aller"></a>
			</div>

			<div class="pacc_mod_image">
				<a href ="module2.php"><img src="../img/rc4_2.png" alt="image_XXXXXXXXXXXXXXXXXXXXXXXXXXX"></a>
			</div>
		</div>

		<div class="pacc_mod_gauche"> 
			<div class="pacc_mod_image">
				<img src="../img/carre_page_acceuil.png" alt="image_EnCoursDeDeveloppemnt">
			</div>

			<div>
				<h3>Module3</h3>

				<p>À venir très prochainement !</p>
				</br></br></br></br></br></br></br>
				<a href="404.php" aria-label="lien_page_404"><input type="button" value="Y aller"></a>
			</div>
		</div>

		<?php
      //On inclus le footer de la page.
      require("../imports_html/footer.html");

      #Statistique de visites du site

      //Si l'utilisateur est connecté.
      if(isset($_SESSION['user'])) {
      	//On ajoute la configuration à la base de données.
        require_once('../config/config_bdd.php');
        //On établis la requete qui incrémente le nombre de visite.
        $requete2 = "UPDATE users SET nb_visites = nb_visites +1 WHERE login='".$_SESSION["user"]["login"]."'";
        //On execute la requete.
        $requete2 = mysqli_query($connexion, $requete2);
      }
    ?>

  </body>
</html>