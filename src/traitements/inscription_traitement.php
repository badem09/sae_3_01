<?php
    require_once('../config/config_bdd.php');
    if(isset($_POST['Envoyer'])){
        $haserror = false;
        if(empty($_POST['login'])){
            header('Location: ../inscription.php?err=login_vide');
            $haserror = true;
        }
        if(empty($_POST['mdp'])){
            header('Location: ../inscription.php?err=mdp_vide');
            $haserror = true;
        }
        if(empty($_POST['mdp_retype'])){
            header('Location: ../inscription.php?err=confirmation_vide');
            $haserror = true;
        }
        if(empty($_POST['captcha'])){
            header('Location: ../inscription.php?err=captcha_vide');
            $haserror = true;
        }
        if(($_POST['mdp']) != ($_POST['mdp_retype'])){
            header('Location: ../inscription.php?err=mdp_non_identique');
            $haserror = true;
        }
        if(($_POST['captcha']) != '95inb'){
            header('Location: ../inscription.php?err=captcha_erroné');
            $haserror = true;
        }
        $login_verif = htmlspecialchars($_POST['login']);
        if(! (strlen($login_verif)<32) AND (strlen($login_verif)>2)){
            header('Location: ../inscription.php?err=bad_format');
            $haserror = true;
        }
        $verif = mysqli_query($connexion,"SELECT login FROM users WHERE login = '".$login_verif."'");
        if(mysqli_num_rows($verif) > 0){
            header('Location: ../inscription.php?err=exist');
            $haserror = true;
        }
        if (!$haserror){
            foreach ($_POST as $k => $v){
                $$k = $v;
            }
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $ins = "INSERT into users(login,mdp) values(?,?)";
            $insp = mysqli_prepare($connexion,$ins);
            $mdpfin = md5($mdp);
            mysqli_stmt_bind_param($insp,'ss', $login, $mdpfin);
            mysqli_stmt_execute($insp);
            $Requete = mysqli_query($connexion,"SELECT login, type_user FROM users WHERE login = '".$login."' AND mdp = '".md5($mdp)."'");
            $data = $Requete->fetch_assoc();
            session_start();
            $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
            mysqli_close($connexion);
            header('Location: ../index.php');
            die();
        }
    }                    
?>