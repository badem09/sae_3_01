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
	        }?>

			</ul>
		</nav>

		<div class="erreur">
			<h1>Erreur</h1>
			<h1>404</h1>
			<p>
				<br>La page à la quel vous souhaiter accéder n'est pas encore disponible ou introuvable &#128532;
			</p>
		</div>
	
  </body>
</html>