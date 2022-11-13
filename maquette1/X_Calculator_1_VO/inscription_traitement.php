<?php

    require_once('config_bdd.php');

    if(isset($_POST['Envoyer'])){
        if(!empty($_POST['login'])){
            if(!empty($_POST['mdp'])){
                if(!empty($_POST['mdp_retype'])){
                    if(!empty($_POST['captcha'])){
                        if(($_POST['mdp']) == ($_POST['mdp_retype'])){
                            if(($_POST['captcha'])=='95inb'){
                                $login_verif = htmlspecialchars($_POST['login']);
                                $Verif = mysqli_query($connexion,"SELECT * FROM users WHERE login = '".$login_verif."'");
                                if(mysqli_num_rows($Verif) == 0){
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

                                    session_start();
                                    
                                    $Requete = mysqli_query($connexion,"SELECT * FROM users WHERE login = '".$login."' AND mdp = '".md5($mdp)."'");
                                    $data = $Requete->fetch_assoc();

                                    $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];

                                    mysqli_close($connexion);

                                    header('Location: final.php');
                                    die();
                                }else{
                                header('Location: inscription.php?err=exist');
                                }
                            }else{
                                header('Location: inscription.php?err=captcha_erroné');
                            }
                        }else{
                            header('Location: inscription.php?err=mdp_non_identique');
                        } 
                    }else{
                    header('Location: inscription.php?err=captcha_vide');
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