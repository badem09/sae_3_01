<?php 

    //On se connecte à la base de donnée.
    try {
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");
    //Si la connecxion a échoué, on renvoie l'erreur.
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

?>