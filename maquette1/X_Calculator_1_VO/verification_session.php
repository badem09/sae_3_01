<?php

session_start();

if(isset($_SESSION['login'])) {
    header('Location: form.php');
} else {
    header('Location: form.php?id=2');
}

?>