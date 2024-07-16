<?php

    if($locker = 1){

        define('SITEURL', 'http://localhost/FoodOrderSystem/');
        
        $dbHost = "localhost";
        $dbUsername = "osmancan";
        $dbPassword = "1234";
        $dbName = "deneme";

        //Tables
        $userTable = "users";
        $adminTable = "admin";
        $foodsTable = "foods";
        $ordersTable = "orders";

        //Pages
        $cartPage = "cart.php";
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