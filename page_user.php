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
		
		<?php
	  	//On inclus la barre de navigation.
	  	require("imports_html/nav_bar.html");
  	?>

    <div class="entete">
        <h1>X Calculator</h1>
        <h3>Bonjour <?php echo $_SESSION['user']['login'];?> !</h3>
    </div>

		<div class='container-centrer'>
			<form action='traitements/modif_mdp_traitement.php' method='post'>
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

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

                <p class='titre-form'>Ancien mot de passe</p>
                <div class="container-verif">
                    <div class="input-box">
                        <i id="eye3" class="fas fa-eye-slash show_hide"></i>
                        <input aria-label="register-old-password" id='register-old-password' type='password' name='a_mdp' placeholder='ex : M0t_D3_P@55€'required/>
                    </div>
                </div>

                <p class='titre-form'>Mot de passe</p>
                <div class="container-verif">
                    <div class="input-box">
                        <i id="eye1" class="fas fa-eye-slash show_hide"></i>
                        <input aria-label="register-password" id="register-password" type='password' name='mdp' placeholder='ex : N0Uv€@U_M0t_D3_P@55€' required/>
                    </div>
                    <div class="indicator-verif">
                        <div class="icon-text">
                            <i class="fas fa-exclamation-circle error_icon"></i>
                            <p class="text"></p>
                        </div>
                    </div>
                </div>

                <p class='titre-form'>Confirmer Mot de passe</p>
                <div class="container-verif">
                    <div class="input-box">
                        <i id="eye2" class="fas fa-eye-slash show_hide"></i>
                        <input aria-label="register-password-2" id="register-password-2" type='password' name='mdp_retype' placeholder='ex : N0Uv€@U_M0t_D3_P@55€' required/>
                    </div>
                </div>
                
                <p class='titre-form'>Captcha</p>
                <div class='captcha-img-desc'>
                    <img class='img-cptcha' src='captcha/img/captcha1.png' alt='image_captcha'>
                    <p class='captcha-desc-text'> Attention : Tous les caractères doivent être écrit en minuscules.</p>
                </div>
                <audio controls>
                    <source src="captcha/audio/captcha1.mp3" type="audio/mpeg">
                </audio>
                <input aria-label="register-captcha" id='register-captcha' type='text' name='captcha' placeholder='ex : 7u5T5g3' required/>
                <p><input type='submit' name='Envoyer' value='Modifier'></p>
	              <p>Mot de passe oublié ? <a id='link-sincrip' href='404.php'>C'est par là !</a></p>

            </div>
	        </div>
	    </form>
	    <!--On import le script de vérification du mot de passe-->
      <script src="js/strength_psswd.js"></script>
		</div>

		<?php
	  	//On inclus le footer de la page.
	  	require("imports_html/footer.html");
  	?>

  </body>
</html>