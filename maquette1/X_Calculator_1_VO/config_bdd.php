<?php 
    try {
        $connexion=mysqli_connect("localhost","root","");
        $bd=mysqli_select_db($connexion,"bd_sae");

    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

?>