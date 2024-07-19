<?php
    // Include database connection
    $locker = 1;
    include("../settings.php");
    include("navbar.php");

    $id = $_SESSION['id'];

    // Fetch user balance
    $query = "SELECT * FROM $userTable WHERE id = '$id'";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $user_id = $_SESSION['id'];
        $user_balance = $row['balance'];
    } else {
        echo "<div class='error'>Kullanıcı bulunamadı.</div>";
        exit();
    }

    if (isset($_SESSION['id']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        
        $order_date = date("d-m-Y h:i:sa");
        $status = "Sipariş verildi";
        $order_id = uniqid(); // Generate a unique order ID

        $total_order_amount = 0; // Initialize total order amount

        // Calculate total order amount
        foreach ($_SESSION['cart'] as $item) {
            $price = $item['price'];
            $qty = $item['qty'];
            $total = $price * $qty;
            $total_order_amount += $total; // Accumulate total order amount
        }

        // Check if total order amount exceeds user balance
        if ($total_order_amount > $user_balance) {
            echo "<div class='error'>Bakiyeniz yetersiz!</div>";
            exit();
        }

        // Start transaction
        mysqli_begin_transaction($connect);

        try {
            // Insert order details
            foreach ($_SESSION['cart'] as $item) {
                $food = $item['title'];
                $price = $item['price'];
                $qty = $item['qty'];
                $total = $price * $qty;

                // Insert the order information into the order table
                $sql = "INSERT INTO $ordersTable (order_id, food, price, qty, total, order_date, status, user_id) VALUES 
                        ('$order_id', '$food', $price, $qty, $total, '$order_date', '$status', '$user_id')";
                $res = mysqli_query($connect, $sql);

                if (!$res) {
                    throw new Exception('Order insertion failed');
                }
            }

            // Update the balance of the user after calculating the total order amount
            $sql = "UPDATE $userTable SET balance = balance - $total_order_amount WHERE id = '$user_id'";
            $res = mysqli_query($connect, $sql);

            if (!$res) {
                throw new Exception('Balance update failed');
            }

            // Commit transaction
            mysqli_commit($connect);

            // Clear the cart
            unset($_SESSION['cart']);

            // Save the order ID to the session
            $_SESSION['order_id'] = $order_id;

            // Redirect to order information page
            header('location:' . SITEURL . 'order-success.php');
            exit();
        } catch (Exception $e) {
            // Rollback transaction
            mysqli_rollback($connect);
            echo "<div class='error'>Bir hata oluştu: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='error'>Session variables or cart are not set.</div>";
    }
?>