<?php
    // Include database connection and start session
    $locker = 1;
    include("../settings.php");
    include("navbar.php");

    // Fetch order details using the order ID
    if (isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];

        $sql = "SELECT * FROM $ordersTable WHERE order_id = '$order_id'";
        $res = mysqli_query($connect, $sql);

        if (mysqli_num_rows($res) > 0) {
            $order_details = mysqli_fetch_all($res, MYSQLI_ASSOC);
        } else {
            echo "<div class='error text-center'>Sipariş bulunamadı.</div>";
            exit();
        }
    } else {
        echo "<div class='error text-center'>Sipariş bilgisi mevcut değil.</div>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sipariş Bilgileri</title>
    <link rel="stylesheet" href="../css/information-table.css"/>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Siparişiniz alınmıştır</h2>

        <table class="order-table">
            <tr>
                <th>Yemek</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
            </tr>
            <?php foreach ($order_details as $order) { ?>
            <tr>
                <td><?php echo $order['food']; ?></td>
                <td><?php echo $order['price']; ?>₺</td>
                <td><?php echo $order['qty']; ?></td>
                <td><?php echo $order['total']; ?>₺</td>
            </tr>
            <?php } ?>
        </table>

        <div class="text-center">
            <a href="user_active_order_list.php" class="btn btn-primary">Siparişlerim sayfasına git</a>
        </div>
    </div>
</body>
</html>
