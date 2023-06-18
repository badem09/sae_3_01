<?php
    session_start();

    if(isset($_SESSION['user'])) {
        header('Location: connexion.php');
        //On vide la session
        $_SESSION = array();
        session_destroy();
        unset($_SESSION);
        die();
    }
?>