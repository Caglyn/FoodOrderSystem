<?php
// Include database connection
$locker = 1;
include("../settings.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $order_date = $_POST['order_date'];
    $new_status = $_POST['new_status'];

    // Log received data
    error_log("Received POST data: order_id = $order_id, order_date = $order_date, new_status = $new_status");

    // Retrieve the order details
    $query = "SELECT user_id, SUM(total) AS total FROM $ordersTable WHERE order_id = '$order_id' AND order_date = '$order_date' GROUP BY user_id";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        $user_id = $order['user_id'];
        $total = $order['total'];

        // Update the order status
        $update_query = "UPDATE $ordersTable SET status = '$new_status' WHERE order_id = '$order_id' AND order_date = '$order_date'";
        mysqli_query($connect, $update_query);

        // If the order is canceled, refund the amount to the user's balance
        if ($new_status == 'Sipariş iptal edildi') {
            $refund_query = "UPDATE $userTable SET balance = balance + $total WHERE id = '$user_id'";
            mysqli_query($connect, $refund_query);
        }

        // Optionally, you can add a success message here and redirect
        $_SESSION['success'] = "Order status updated successfully.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        error_log("Order details not found for order_id: $order_id, order_date: $order_date");
        // Optionally, you can add an error message here and redirect
        $_SESSION['error'] = "Order details not found.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // Redirect to the orders page if accessed directly
    header('Location: active_order_list.php');
    exit();
}
?>
