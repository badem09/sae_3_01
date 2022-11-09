<?php

if((isset($_POST['Envoyer'],$_POST['login'],$_POST['mdp']))){
    foreach ($_POST as $k => $v){
        $$k=$v;
    }

    $connexion=mysqli_connect("localhost","root","");
    $bd=mysqli_select_db($connexion,"bd_sae");

    $ins="INSERT into users(login,mdp) values(?,?)";
    $insp=mysqli_prepare($connexion,$ins);

    $mdpfin = md5($mdp);

    mysqli_stmt_bind_param($insp,'ss', $login, $mdpfin);
    mysqli_stmt_execute($insp);
    mysqli_close($connexion);

    session_start();
    $_SESSION["user"]=$_POST['login'];
    header('Location: final.php');
    die();
}

?>