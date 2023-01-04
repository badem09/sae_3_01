<?php

//On inclus la barre de navigation.
require("config/config_bdd.php");

// Récupération de l'identifiant de l'enregistrement à supprimer
$supp = $_POST['supp'];

//Requete de supp$

$requete1 = mysqli_query($connexion, "DELETE FROM users where id_user = '".$supp."'");

$requete2 = mysqli_query($connexion, "DELETE FROM activitemodule where login = 
                                        (SELECT login FROM users where id_user = '".$supp."')");

$requete3 = mysqli_query($connexion, "DELETE FROM historique_module2 where login = 
                                        (SELECT login FROM users where id_user = '".$supp."')");

$requete4 = mysqli_query($connexion, "DELETE FROM historique_module1 where login = 
                                        (SELECT login FROM users where id_user = '".$supp."')");




// Redirection vers la page d'affichage des enregistrements
header('Location: page_admin.php');
exit;