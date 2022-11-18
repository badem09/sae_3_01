<?php
    
    //On démarre une session.
    session_start();
    //Si une session "user" exixte, on renvois sur la page de connexion,
    //on détruit la session et on ferme la page.
    if(isset($_SESSION['user'])) {
        header('Location: connexion.php');
          //On vide la session
          $_SESSION = array();
          //Destruction de la session
          session_destroy();
          //Destruction du tableau de session
          unset($_SESSION);
        die();
    }

?>