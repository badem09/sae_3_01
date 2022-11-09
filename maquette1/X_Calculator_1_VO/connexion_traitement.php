<?php

$mysqli = mysqli_connect("localhost","root","");

if(!$mysqli){
    echo "Erreur de connexion à la base de données.";
} else {
    $Requete = mysqli_query($mysqli,"SELECT * FROM users WHERE login = '".$_POST['login']."' AND mdp = '".md5($_POST['mdp'])."'");

    if(mysqli_num_rows($Requete) == 0) {
        header('Location: form.php?id=1');
        die();
    } else {
        session_start();
        $_SESSION["user"]=$_POST['login'];
        header('Location: final.php');
        die();
    }
}

?>