<?php
    //Include database connection
    $locker = 1;
    include("settings.php");
    include("navbar.php");

    $id = $_SESSION['id'];
    $query = "SELECT * FROM $userTable WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $_SESSION['id'];
            $user_balance = $row['balance'];
        }
    }

    //Adjust the session variable names as per the debug output
    if (isset($_SESSION['id']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        
        $order_date = date("d-m-Y h:i:sa");
        $status = "Sipariş verildi";
        $order_id = uniqid(); //Generate a unique order ID

        foreach ($_SESSION['cart'] as $item) {
            $food = $item['title'];
            $price = $item['price'];
            $qty = $item['qty'];
            $total = $price * $qty;

            if($total > $user_balance){
                echo "<div class='error'>Bakiyeniz yetersiz!</div>";
                exit();
            }

            //Insert the order information into the order table
            $sql = "INSERT INTO $ordersTable SET
                    order_id = '$order_id',
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    user_id = '$user_id'";

            $res = mysqli_query($connect, $sql);

            //Change the balance of the user and update the table
            $sql = "UPDATE $userTable SET balance = $balance - $total WHERE id = $user_id";

            $res = mysqli_query($connect, $sql);
        }

        //Clear the cart
        unset($_SESSION['cart']);

        //Save the order ID to the session
        $_SESSION['order_id'] = $order_id;

        //Redirect to order information page
        header('location:' . SITEURL . 'order-success.php');
        exit();
    } else {
        //Debugging: Show message if condition fails
        echo "Session variables or cart are not set.";
    }
?>