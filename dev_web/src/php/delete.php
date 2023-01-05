<?php

//On inclus la barre de navigation.
require("../config/config_bdd.php");

// Récupération de l'identifiant de l'enregistrement à supprimer
$id_user = $_POST['id_user_suppr'];
$login = $_POST['login_suppr'];

//Requete de supp$

$requete1 = mysqli_query($connexion, "DELETE FROM users where id_user = '".$id_user."'");

$requete2 = mysqli_query($connexion, "DELETE FROM activitemodule where login ='".$login."'");

$requete3 = mysqli_query($connexion, "DELETE FROM historique_module2 where login ='".$login."'");

$requete4 = mysqli_query($connexion, "DELETE FROM historique_module1 where login ='".$login."'");

$requete5 = mysqli_query($connexion, "DELETE FROM activiteconnexion where login ='".$login."'");

// Redirection vers la page d'affichage des enregistrements
header('Location: page_admin.php');
exit;