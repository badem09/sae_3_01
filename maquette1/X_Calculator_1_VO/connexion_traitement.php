<?php

if((isset($_POST['Envoyer'],$_POST['login'],$_POST['mdp']))){
    foreach ($_POST as $k => $v){
        $$k=$v;
    }

    $connexion=mysqli_connect("localhost","root","");
    $bd=mysqli_select_db($connexion,"bd_sae");

    $Requete = mysqli_query($connexion,"SELECT * FROM users WHERE login = '".$_POST['login']."' AND mdp = '".md5($_POST['mdp'])."'");

    if(mysqli_num_rows($Requete) == 0) {
        header('Location: connexion.php?id=1');
        die();
    } else {  
        session_start();
        $_SESSION["user"]=$_POST['login'];
        header('Location: final.php');
        die();
    }
}

?>