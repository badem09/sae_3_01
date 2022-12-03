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
						<li><a href="404."><b>Module 3</b></a></li>
					</ul>
				</li>

				<?php

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
        <h3>Bonjour <?php echo $_SESSION['user']['login'];?> !</h3>
    </div>

		<div class='container-centrer'>
			<form action='modif_mdp_traitement.php' method='post'>
	        <div class='container-insciption-connexion'>
	            <h2>Modifier mon MDP</h2>
	            <?php
	            //On verifie si une erreur à été envoyé.
	            if(isset($_GET['err'])){
	                //On cherche à quoi elle correspond et on l'affiche.
	                switch($_GET['err']){
	                    case "a_mdp_vide" :
	                    echo "<p class='err'>Erreur : Ancien mot de passe vide.</p>";
	                    break;

	                    case "mdp_vide" :
	                    echo "<p class='err'>Erreur : Nouveau mot de passe vide.</p>";
	                    break;

	                    case "mdp_retype_vide" :
	                    echo "<p class='err'>Erreur : Confirmation nouveau mot de passe vide.</p>";
	                    break;

	                    case "non_identique" :
	                    echo "<p class='err'>Erreur : Les nouveau mot de passe ne correspondent pas.</p>";
	                    break;

	                    case "a_mdp_faux" :
	                    echo "<p class='err'>Erreur : Ancien mot de passe érroné.</p>";
	                    break;

	                    case "captcha_faux" :
	                    echo "<p class='err'>Erreur : Le Captcha est érroné.</p>";
	                    break;
	                }
	            }
	            if(isset($_GET['succes'])){
	                //On cherche à quoi elle correspond et on l'affiche.
	                switch($_GET['succes']){
	                    case "succes" :
	                    echo "<p class='succes'>Succès: Mot de passe modifié !</p>";
	                    break;
	                }
	            }
	            ?>
	            <div class='inputs'>
	            		<p class='titre-form'>Ancien mot de passe</p>
	                <label id="label-register-password" for="register-password">
	                <input id='register-password' type='password' name='a_mdp' placeholder='ex : M0t_D3_P@55€'/>

	                <p class='titre-form'>Nouveau mot de passe</p>
	                <label id="label-register-password" for="register-password">
	                <input id='register-password' type='password' name='mdp' placeholder='ex : N0Uv€@U_M0t_D3_P@55€'/>
	                
	                <p class='titre-form'>Confirmer nouveau Mot de passe</p>
	                <label id="label-register-password-2" for="register-password-2">
	                <input id='register-password-2' type='password' name='mdp_retype' placeholder='ex : N0Uv€@U_M0t_D3_P@55€'/>
	                
	                <p class='titre-form'>Captcha</p>
	                <div class='captcha-img-desc'>
	                    <img class='img-cptcha' src='captcha/img/captcha1.png' alt='image_captcha'>
						<p class='captcha-desc-text'> Attention : Tous les caracères doivent être écrit en minuscules.</p>
	                </div>
					<audio controls>
                            <source src="captcha/audio/captcha1.mp3" type="audio/mpeg">
                    </audio>
	                <label id="label-register-captcha" for="register-captcha">
	                <input id='register-captcha' type='text' name='captcha' placeholder='ex : 7u5T5g3'/>
	                <p><input type='submit' name='Envoyer' value='Modifier'></p>
	                <p>Mot de passe oublié ? <a id='link-sincrip' href='404.php'>C'est par là !</a></p>
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