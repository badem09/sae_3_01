<?php
    
    //On importe la configuration de la base de données en premier.
    require_once('config_bdd.php');
    //On vérifie si une demande d'envoie dur formulaire ç bien été envoyé.
    if(isset($_POST['Envoyer'])){
        //On vérifie si le champ "login" n'est pas vide.
        if(!empty($_POST['login'])){
            //On vérifie si le champ "mdp" n'est pas vide.
            if(!empty($_POST['mdp'])){
                //On vérifie si le champ "mdp_retype" n'est pas vide.
                if(!empty($_POST['mdp_retype'])){
                    //On vérifie si le champ "captcha" n'est pas vide.
                    if(!empty($_POST['captcha'])){
                        //On vérifie si les mots de passe correspondent.
                        if(($_POST['mdp']) == ($_POST['mdp_retype'])){
                            //On vérifie si le captcha correspond bien à celui demandé.
                            if(($_POST['captcha']) == '95inb'){
                                //On convertie les caractères spéciaux en caratères spéciaux html.
                                $login_verif = htmlspecialchars($_POST['login']);
                                if((strlen($login_verif)<32) AND (strlen($login_verif)>2)){
                                    //On selection un login qui correspond à celui renseigé dans le formulaire.
                                    $Verif = mysqli_query($connexion,"SELECT login FROM users WHERE login = '".$login_verif."'");
                                    //Si la requete est vide.
                                    if(mysqli_num_rows($Verif) == 0){
                                        foreach ($_POST as $k => $v){
                                            $$k = $v;
                                        }
                                        //On convertie les caractères spéciaux en caratères spéciaux html.
                                        $login = htmlspecialchars($_POST['login']);
                                        $mdp = htmlspecialchars($_POST['mdp']);
                                        //On prépare la requete avec des valeurs indéfinie.
                                        $ins = "INSERT into users(login,mdp) values(?,?)";
                                        $insp = mysqli_prepare($connexion,$ins);
                                        //On crypte le mot de passe.
                                        $mdpfin = md5($mdp);
                                        //On définit le type de valeur à entrer et on execute la requete.
                                        mysqli_stmt_bind_param($insp,'ss', $login, $mdpfin);
                                        mysqli_stmt_execute($insp);
                                        //On selectionne dans la base de donnée "login" et "type_user" pour ête sur qu'ils sont bien entré.
                                        $Requete = mysqli_query($connexion,"SELECT login, type_user FROM users WHERE login = '".$login."' AND mdp = '".md5($mdp)."'");
                                        //On récupere les valeurs de la requete.
                                        $data = $Requete->fetch_assoc();
                                        //On ouvre une nouvelle session.
                                        session_start();
                                        //On définit les valeurs que l'on veut stocker dans la session.
                                        $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
                                        //On ferme la connection avec la base de données.
                                        mysqli_close($connexion);
                                        //Puis on redirige ver la page "final" car par défaut, chaques utilisateurs et un "user".
                                        header('Location: page_user.php');
                                        die();
                                    }else{
                                        //Si le login exixte déjà, on redirige vers la page inscription avec une erreur.
                                        header('Location: inscription.php?err=exist');
                                    }
                                }else{
                                    //Si le login est > à 32 ou < à 5 caractères, on redirige vers la page inscription avec une erreur.
                                    header('Location: inscription.php?err=bad_format');
                                }
                            }else{
                                //Si le Captcha est faux, on redirige vers la page inscription avec une erreur.
                                header('Location: inscription.php?err=captcha_erroné');
                            }
                        }else{
                            //Si les mots de passe ne sont pas identiques, on redirige vers la page inscription avec une erreur.
                            header('Location: inscription.php?err=mdp_non_identique');
                        } 
                    }else{
                        //Si le Captcha est vide, on redirige vers la page inscription avec une erreur.
                        header('Location: inscription.php?err=captcha_vide');
                    }   
                }else{
                    //Si la confirmation du mot de passe est vide, on redirige vers la page inscription avec une erreur.
                    header('Location: inscription.php?err=confirmation_vide');
                }
            }else{
                //Si le mot de passe est vide, on redirige vers la page inscription avec une erreur.
                header('Location: inscription.php?err=mdp_vide');
            }
        }else{
            //Si le login est vide, on redirige vers la page inscription avec une erreur.
            header('Location: inscription.php?err=login_vide');
        }
    }

?>