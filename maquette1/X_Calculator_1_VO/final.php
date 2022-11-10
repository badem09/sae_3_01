<?php

session_start();

if(!isset($_SESSION['user'])) {
   header('Location: connexion.php');
}

?>

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
					<a href="index.html"><b>Page d'acceuil</b></a>
				</li>

				<li class="nav-item">
					<a href="#"><b>Mes Services</b></a>
					<ul class = "nav-item-services">
						<li><a href="404.html"><b>Module 1</b></a></li>
						<li><a href="404.html"><b>Module 2</b></a></li>
						<li><a href="404.html"><b>Module 3</b></a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="deconnexion.php"><b>Se déconnecter</b></a>
				</li>

			</ul>
		</nav>

		<div class="erreur">
			<h1>Inscription réussie !</h1>
			<h1>GG</h1>
			<p>
				<br>T'as réussies ! Braveau ! (bravo pour les veaux)
			</p>
		</div>
	
  </body>
</html>