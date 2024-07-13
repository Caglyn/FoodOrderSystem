<?php

    if($locker = 1){

        $dbHost = "localhost";
        $dbUsername = "osmancan";
        $dbPassword = "1234";
        $dbName = "deneme";

        $userTable = "users";
        $adminTable = "admin";

        $registerPage = "register.php";
        $loginPage = "login.php";
        $logoutPage = "logout.php";
        $dashboardPage = "home.php";
        $adminLoginPage = "admin_login.php";
        $adminDashboardPage = "admin_dashboard.php";

        $connect = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        //$connect = new mysqli("localhost", "demo1591", "80cb6390adT", "demo1591_osmancan");

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
    }
    
?>