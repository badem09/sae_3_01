<?php

    require_once('config_bdd.php');

    if(isset($_POST['Envoyer'])){
        if(!empty($_POST['login'])){
            if(!empty($_POST['mdp'])){
                if(!empty($_POST['mdp_retype'])){
                    if(($_POST['mdp']) == ($_POST['mdp_retype'])){
                        foreach ($_POST as $k => $v){
                            $$k=$v;
                        }
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
                    }else{
                        header('Location: inscription.php?err=mdp_non_identique');
                    }    
                }else{
                    header('Location: inscription.php?err=confirmation_vide');
                }
            }else{
                header('Location: inscription.php?err=mdp_vide');
            }
        }else{
            header('Location: inscription.php?err=login_vide');
        }
    }

?>