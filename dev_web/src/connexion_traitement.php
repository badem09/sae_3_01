<?php

    //On demande l'insersion du ficher config de la bse de donnée.
    require_once('config_bdd.php');

    //On initialise une fonction qui prends en paramètre la réussite, le mot de passe et le login de la tentative que nous utiliserons à chaque reussite ou echec, ainsi que les variables de connexion à la base de données.
    function activite($mdp, $log, $connexion, $bd){
        //On convertie les caractères spéciaux en caratères spéciaux html.
        $adr_ip = $_SERVER['REMOTE_ADDR'];
        //On crypte le mot de passe.
        $mdpfin = md5($mdp);
        //On prépare la requete avec des valeurs indéfinie.
        $ins = "INSERT into activiteconnexion(mdp_tente,log_tente,adr_ip) values(?,?,?)";
        $insp = mysqli_prepare($connexion,$ins);
        //On définit le type de valeur à entrer et on execute la requete.
        mysqli_stmt_bind_param($insp,'sss', $mdpfin, $log, $adr_ip);
        mysqli_stmt_execute($insp);
    }

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
                        //On crée une session qui contien son "login" et son type d'utilisateur.
                        session_start();
                        $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
                        //Si l'utilisateur n'est pas un simple utilisateur.
                        if ($data['type_user'] != 'user'){  
                            //On le redirige vers le panel "admin" et on ferme la page.
                            header('Location: page_admin.php');
                            die();
                        //Si l'utilisateur est un utilisateur simple
                        } else {  
                            //On le redirige vers la page d'acceuil
                            header('Location: index.php');
                            die();
                        }
                    }else{
                        //On insert les logs avec la fonction "activite".
                        activite($mdp, $login, $connexion, $bd);
                        //Si le champ "mdp" ne correspond pas au login de la base de donnée, on le redirige vers la page de connection avec une erreur et on ferme la page.
                        header('Location: connexion.php?err=u_ou_mdp-faux');
                        die();
                    }
                }else{
                    //On insert les logs avec la fonction "activite".
                    activite($mdp, $login, $connexion, $bd);
                    //Si le champ "login" est introuvable dans la base de donnée, on le redirige vers la page de connection avec une erreur et on ferme la page.
                    header('Location: connexion.php?err=u_ou_mdp-faux');
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