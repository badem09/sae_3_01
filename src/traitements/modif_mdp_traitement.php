<?php
    session_start();
    require_once('../config/config_bdd.php');
    if(isset($_POST['Envoyer'])){
        $haserror = false;
        if(empty($_POST['a_mdp'])){
            header('Location: ../page_user.php?err=a_mdp_vide');
            die();
            $haserror = true;
        }
        if(empty($_POST['mdp'])){
            header('Location: ../page_user.php?err=mdp_vide');
            die();
            $haserror = true;
        }
        if(empty($_POST['mdp_retype'])){
            header('Location: ../page_user.php?err=mdp_retype_vide');
            die();
            $haserror = true;
        }
        if(md5($_POST['mdp']) != md5($_POST['mdp_retype'])){
            header('Location: ../page_user.php?err=non_identique');
            die();
            $haserror = true;
        }
        if (!$haserror){
            $login = $_SESSION["user"]["login"];
            $Verif = mysqli_query($connexion,"SELECT login, mdp FROM users WHERE login = '".$login."'");
            $data = $Verif->fetch_assoc();
            echo "<p>" . md5($_POST['a_mdp']) . "</p>";
            echo  "<p>".$data['mdp']."</p>";
            if(md5($_POST['a_mdp']) == $data['mdp']){
                $a_mdp = htmlspecialchars($_POST['a_mdp']);
                $mdp = htmlspecialchars($_POST['mdp']);

                if($data['mdp'] != md5($mdp)){
                    foreach ($_POST as $k => $v){
                        $$k = $v;
                    }
                    $ins = "UPDATE users set mdp = ? WHERE login = '".$login."'";
                    $insp = mysqli_prepare($connexion,$ins);
                    $mdpfin = md5($mdp);
                    mysqli_stmt_bind_param($insp,'s', $mdpfin);
                    mysqli_stmt_execute($insp);
                    mysqli_close($connexion);
                    header('Location: ../page_user.php?succes=succes');
                    die();

                }else{
                    header('Location: ../page_user.php?err=a_mdp_corres_nv');
                    die();
                }
            }else{
                header('Location: ../page_user.php?err=a_mdp_faux');
                die();
            }
        }
    }
?>