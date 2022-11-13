<?php

    require_once('config_bdd.php');

    if(isset($_POST['Envoyer'])){
        if(!empty($_POST['login'])){
            if(!empty($_POST['mdp'])){

                $login = htmlspecialchars($_POST['login']);
                $mdp = htmlspecialchars($_POST['mdp']);

                $Requete = mysqli_query($connexion,"SELECT * FROM users WHERE login = '".$login."' AND mdp = '".md5($mdp)."'");
                $data = $Requete->fetch_assoc();

                if(mysqli_num_rows($Requete) == 0) {
                    header('Location: connexion.php?err=u_introuvable');
                    die();
                } elseif ($data['type_user'] !== 'user'){  
                    session_start();
                    $_SESSION["user"]= ["login"=>$login,"type_user"=>$data['type_user']];
                    header('Location: page_admin.php');
                    die();
                } else {  
                    session_start();
                    $_SESSION["user"]= ["login"=>$login,"type_user"=>$data['type_user']];
                    header('Location: final.php?conncté');
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