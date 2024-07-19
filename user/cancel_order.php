<?php
    $locker = 1;
    include("../settings.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $order_id = $_POST['order_id'];

        //Fetch the total amount and user_id for the order
        $query = "SELECT user_id, SUM(total) AS total FROM $ordersTable WHERE order_id = '$order_id' GROUP BY user_id";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            $order = mysqli_fetch_assoc($result);
            $user_id = $order['user_id'];
            $total = $order['total'];

            //Update the order status to "Cancelled"
            $sql = "UPDATE $ordersTable SET status = 'Sipariş iptal edildi' WHERE order_id = '$order_id'";
            $res = mysqli_query($connect, $sql);

            if ($res) {
                //Refund the amount to the user's balance
                $refund_query = "UPDATE $userTable SET balance = balance + $total WHERE id = '$user_id'";
                mysqli_query($connect, $refund_query);

                $_SESSION['success'] = "Sipariş başarıyla iptal edildi ve para iade edildi.";
            } else {
                $_SESSION['error'] = "Siparişi iptal ederken bir hata oluştu.";
            }
        } else {
            $_SESSION['error'] = "Sipariş bilgileri bulunamadı.";
        }

        header("Location: user_active_order_list.php");
        exit();
    } else {
        header("Location: user_active_order_list.php");
        exit();
    }
?>