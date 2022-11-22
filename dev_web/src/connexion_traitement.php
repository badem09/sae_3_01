<?php

    //On demande l'insersion du ficher config de la bse de donnée.
    require_once('config_bdd.php');
    //On vérifie si un formulaire à été envoyé.
    if(isset($_POST['Envoyer'])){
        //Si le champ "login" n'est pas vide, on continue.
        if(!empty($_POST['login'])){
            //Si le champ "mdp" n'est pas vide, on continue.
            if(!empty($_POST['mdp'])){
                //On transforme les caractère en caractères spéciaux.
                $login = htmlspecialchars($_POST['login']);
                $mdp = htmlspecialchars($_POST['mdp']);
                //On selectionnne le login si une ligne correspond au "login" entrée.
                $Requete_verif_u = mysqli_query($connexion,"SELECT login FROM users WHERE login = '".$login."'");
                if(mysqli_num_rows($Requete_verif_u) != 0){
                    //On selectionnne le login et le type d'utilisateur si une ligne correspond au "login" entrée et si le mot de passe entrée puis crypté corespond à celui existant pour ce "login".
                    $Requete = mysqli_query($connexion,"SELECT login, type_user FROM users WHERE login = '".$login."' AND mdp = '".md5($mdp)."'");
                    //On récupere chaques valeurs de la requete.
                    $data = $Requete->fetch_assoc();
                    //Si aucune ligne n'a été trouvé, on redirige vers la page de connexion avec une erreur.
                    if(mysqli_num_rows($Requete) != 0) {
                        //Si l'utilisateur n'est pas un simple utilisateur.
                        if ($data['type_user'] != 'user'){  
                            //On crée une session qui contien son "login" et son type d'utilisateur.
                            session_start();
                            $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
                            //On le redirige vers le panel "admin" et on ferme la page.
                            header('Location: page_admin.php');
                            die();
                        //Si l'utilisateur est un utilisateur simple
                        } else {  
                            //On crée une session qui contien son "login" et son type d'utilisateur.
                            session_start();
                            $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
                            //On le redirige ver une page (temporaire) qui lui indique qu'il est bien connecté et on ferme la page.
                            header('Location: page_user.php');
                            die();
                        }
                    }else{
                        //Si le champ "login" est introuvable dans la base de donnée, on le redirige vers la page de connection avec une erreur et on ferme la page.
                        header('Location: connexion.php?err=mdp_faux');
                        die();
                    }
                }else{
                    //Si le champ "login" est introuvable dans la base de donnée, on le redirige vers la page de connection avec une erreur et on ferme la page.
                    header('Location: connexion.php?err=u_introuvable');
                    die();
            }
            }else{
                //Si le champ "mdp" est vide, on le redirige vers la page de connection avec une erreur et on ferme la page.
                header('Location: connexion.php?err=mdp_vide');
                die();
            }
        }else{
            //Si le champ "mdp" est vide, on le redirige vers la page de connection avec une erreur et on ferme la page.
            header('Location: connexion.php?err=login_vide');
            die();
        }
    }

?>