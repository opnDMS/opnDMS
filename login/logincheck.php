<?php 

require_once("../config.php");

if (isset($_POST['password'])) {
    if ($_POST['password'] != login_password) {
        session_start();
        $_SESSION['login'] = true;
        header("Location: /");
    } else {
        header("Location: /login/?error=1");
    }
} else {
    header("Location: /login/?error=1");
}



?>