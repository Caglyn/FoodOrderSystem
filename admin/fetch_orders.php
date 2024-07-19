<?php
// Include database connection
$locker = 1;
include("../settings.php");

// Fetch orders with necessary details
$sql = "SELECT o.order_id, o.user_id, u.name AS user_name, u.department AS user_department, o.order_date,
        GROUP_CONCAT(o.food SEPARATOR ', ') AS foods,
        GROUP_CONCAT(o.price SEPARATOR ', ') AS prices,
        GROUP_CONCAT(o.qty SEPARATOR ', ') AS quantities,
        SUM(o.total) AS total,
        o.status
        FROM $ordersTable o
        JOIN $userTable u ON o.user_id = u.id
        WHERE o.status = 'Sipariş verildi'
        GROUP BY o.order_id, o.user_id, o.order_date, o.status";

$res = mysqli_query($connect, $sql);

$order_details = [];

if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $order_details[] = $row;
    }
}

echo json_encode($order_details);
?>
