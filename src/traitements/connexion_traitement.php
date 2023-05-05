<?php

    require_once('../config/config_bdd.php');

    if(isset($_POST['Envoyer'])){
        if(!empty($_POST['login'])){
            if(!empty($_POST['mdp'])){
                $login = htmlspecialchars($_POST['login']);
                $mdp = htmlspecialchars($_POST['mdp']);

                $query = "SELECT * FROM users WHERE login = ? AND mdp = ?";
                $stmt = $connexion->prepare($query);
                $mdp_crypte = md5($mdp);

                $stmt->bind_param('ss', $login, $mdp_crypte);
                $stmt->execute();
                $result = $stmt->get_result();

                if(mysqli_num_rows($result) != 0){
                    session_start();
                    $data = $result->fetch_assoc();
                    $_SESSION["user"] = ["login"=>$login,"type_user"=>$data['type_user']];
                    if ($data['type_user'] == 'admin'){
                        header('Location: ../page_admin.php');
                        die();
                    } else {
                        header('Location: ../index.php');
                        die();
                    }
                }else{ // Mauvais mdp
                    activite($mdp, $login); // On insert les logs.
                    header('Location: ../connexion.php?err=u_ou_mdp_faux');
                    die();
                }
            }else{
                // Champ "mdp" est vide
                header('Location: ../connexion.php?err=mdp_vide');
                die();
            }
        }else{ // Champ "login" est vide
            header('Location: ../connexion.php?err=login_vide');
            die();
        }
    }

function activite($mdp, $log): void {
    $adr_ip = $_SERVER['REMOTE_ADDR'];

    //Ecriture dans le fichier csv des logs
    $dt = time();
    $dt_format = date('d/m/Y H:i:s', $dt);
    $data = array($mdp, $log, $adr_ip, $dt_format);
    $file = "log.csv";
    $fp=fopen($file,"a+");
    fputcsv($fp, $data);
    fclose($fp);
}
?>