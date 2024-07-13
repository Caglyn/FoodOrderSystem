<?php
    $locker = 1;
    include("settings.php");

    if(!isset($_SESSION['id'])){
        session_start();
    }
    session_unset();
    session_destroy();
    
    header("Location:$loginPage");
?>