<?php

#a completer avec bd de limba

$log = $_POST['login'];
$pass = $_POST['mdp'];


//Select
$token= (bool) ($connexion=mysqli_connect("localhost", "root", ""));

if ($token){
    $token2=($bd=mysqli_select_db($connexion, "student"));

    if ($token2){
        $table="user";
        $select="SELECT * from $table where login='$log' and mdp='$mdp'"; //select selon condition
        $token3=(bool)($res=mysqli_query($connexion,$select));

        if ($token3){
            echo "<table>";
            while ($ligne=mysqli_fetch_row($res)){
                echo "<tr>";
                foreach ($ligne as $v) {
                    echo "<td>" . $v . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

        }
    }

}