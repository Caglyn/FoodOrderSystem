<?php
    $locker = 1;
    include("settings.php");

    //Checking if already logged in
    if ($_SESSION['id'] != $row['id']) {
        header("Location:$logoutPage");
        exit();
    }
?>