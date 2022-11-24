<?php

// $_post['name'] = input du formulaire aux champs de name
if ($_POST["esp"] != "" && $_POST["et"]  != "" && $_POST["t"] != "" ){
    $esp = $_POST["esp"];
    $et = $_POST["et"] ;
    $t = $_POST["t"];
    $methode = $_POST["choix_methode"] ;
    $array = array($methode,$esp,$et,$t);

    //$resultat = shell_exec('python3 print.py' , $array ,$return);

    $command_exec = escapeshellcmd('print.py');
    $str_output = shell_exec($command_exec);
        echo $str_output;


    print_r( $array);



}



