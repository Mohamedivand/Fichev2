<?php
    session_set_cookie_params(300);
    session_start();
    
    if(!isset($_SESSION['user'])) {
        header('location:login.php');
        exit();
    }

?>
