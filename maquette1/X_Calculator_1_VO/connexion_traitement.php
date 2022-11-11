<?php

    require_once('config_bdd.php');

    if(isset($_POST['Envoyer'])){
        if(!empty($_POST['login'])){
            if(!empty($_POST['mdp'])){

                $Requete = mysqli_query($connexion,"SELECT * FROM users WHERE login = '".$_POST['login']."' AND mdp = '".md5($_POST['mdp'])."'");

                if(mysqli_num_rows($Requete) == 0) {
                    header('Location: connexion.php?id=1');
                    die();
                } else {  
                    session_start();
                    $_SESSION["user"]=$_POST['login'];
                    header('Location: final.php?connecte');
                    die();
                }
            }else{
                header('Location: connexion.php?err=mdp_vide');
                die();
            }
        }else{
            header('Location: connexion.php?err=login_vide');
            die();
        }
    }

?>