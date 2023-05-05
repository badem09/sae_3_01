<?php

    //On démmare une session pour récuprer les infos utilisateur plus tard.
    session_start();

    //On demande l'insersion du ficher config de la bse de donnée.
    require_once('../config/config_bdd.php');
    //On vérifie si un formulaire à été envoyé.
    if(isset($_POST['Envoyer'])){
        //Si le champ "a_mdp" n'est pas vide, on continue.
        if(!empty($_POST['a_mdp'])){
            //Si le champ "mdp" n'est pas vide, on continue.
            if(!empty($_POST['mdp'])){
                //Si le champ "mdp_retype" n'est pas vide, on continue.
                if(!empty($_POST['mdp_retype'])){
                    //Si le nouveau MDP correspond a à confirmation du nouveau MDP, on continue.
                    if(md5($_POST['mdp']) == md5($_POST['mdp_retype'])){
                        //On selection le mdp qui correspond au login la session de l'utilisateur.
                        $login = $_SESSION["user"]["login"];
                        $Verif = mysqli_query($connexion,"SELECT login, mdp FROM users WHERE login = '".$login."'");
                        //
                        $data = $Verif->fetch_assoc();
                        //
                        if(md5($_POST['a_mdp']) == $data['mdp']){
                            //On transforme les caractère en caractères spéciaux.
                            $a_mdp = htmlspecialchars($_POST['a_mdp']);
                            $mdp = htmlspecialchars($_POST['mdp']);
                            $mdp_retype = htmlspecialchars($_POST['mdp_retype']);

                            if(!($data['mdp'] == md5($mdp))){
                                
                                foreach ($_POST as $k => $v){
                                    $$k = $v;
                                }
                                //On prépare la requete avec des valeurs indéfinie.
                                $ins = "UPDATE users set mdp = ? WHERE login = '".$login."'";
                                $insp = mysqli_prepare($connexion,$ins);
                                //On crypte le mot de passe.
                                $mdpfin = md5($mdp);
                                //On définit le type de valeur à entrer et on execute la requete.
                                mysqli_stmt_bind_param($insp,'s', $mdpfin);
                                mysqli_stmt_execute($insp);
                                //On définit les valeurs que l'on veut stocker dans la session.
                                mysqli_close($connexion);
                                //Puis on redirige ver la page "final" car par défaut, chaques utilisateurs et un "user".
                                header('Location: ../page_user.php?succes=succes');
                                die();

                            }else{
                                //Si l'ancien mot de passe correspond au nouveau mot de pase, on redirige vers la page user avec une erreur et on ferme la page.
                                header('Location: ../page_user.php?err=a_mdp_corres_nv');
                                die();
                            }

                        }else{
                            //Si l'ancien mot de passe est faux, on redirige vers la page user avec une erreur et on ferme la page.
                            header('Location: ../page_user.php?err=a_mdp_faux');
                            die();
                        }
                    }else{
                        //Si les MDP entrées ne correspondent pas, on redirige vers la page user avec une erreur et on ferme la page.
                        header('Location: ../page_user.php?err=non_identique');
                        die();
                    }
                }else{
                    //Si le champ "mdp" est vide, on le redirige vers la page user avec une erreur et on ferme la page.
                    header('Location: ../page_user.php?err=mdp_retype_vide');
                    die();
                }
            }else{
                //Si le champ "mdp" est vide, on le redirige vers la page user avec une erreur et on ferme la page.
                header('Location: ../page_user.php?err=mdp_vide');
                die();
            }
        }else{
            //Si le champ "a_mdp" est vide, on le redirige vers la page user avec une erreur et on ferme la page.
            header('Location: ../page_user.php?err=a_mdp_vide');
            die();
        }            
    }

?>