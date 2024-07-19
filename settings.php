<?php
    if($locker = 1){

        define('SITEURL', 'http://localhost/FoodOrderSystem/user/');
        
        $dbHost = "localhost";
        $dbUsername = "osmancan";
        $dbPassword = "1234";
        $dbName = "deneme";

        //Tables
        $userTable = "users";
        $adminTable = "admin";
        $menuTable = "menu";
        $ordersTable = "orders";

        //Pages for users
        $cartPage = "cart.php";
        $registerPage = "register.php";
        $loginPage = "login.php";
        $logoutPage = "../logout.php";
        $dashboardPage = "home.php";
        $userActiveOrderPage = "user_active_order_list.php";

        //Pages for admin
        $adminLoginPage = "../admin/admin_login.php";
        $activeOrdersPage = "active_order_list.php";
        $pastOrdersPage = "past_order_list.php";
        $userListPage = "user_list.php";
        $menuPage = "menu_list.php";

        $connect = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        //$connect = new mysqli("localhost", "demo1591", "80cb6390adT", "demo1591_osmancan");

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
    }
    
?>