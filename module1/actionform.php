<?php

// $_post['name'] = input du formulaire aux champs de name
if ($_POST["esp"] != "" && $_POST["et"]  != "" && $_POST["t"] != "" ){
    $esp = $_POST["esp"];
    $et = $_POST["et"] ;
    $t = $_POST["t"];
    $fonction = $_POST["choix_methode"] ;



    $command = 'python '. ' ' . $fonction . ' '
        . $esp . ' ' . $et . ' ' .$t . ' ' ;
    echo $command . ' ';
    $result = shell_exec($command);

    echo $result;
}



