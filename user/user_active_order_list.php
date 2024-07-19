<?php
// Include database connection
$locker = 1;
include("../settings.php");
include("navbar.php");

$id = $_SESSION['id'];

// Fetch the orders for the user, aggregated by order_id
$sql = "SELECT order_id, user_id, GROUP_CONCAT(food) AS food, GROUP_CONCAT(price) AS price, 
            GROUP_CONCAT(qty) AS qty, SUM(total) AS total, status
        FROM $ordersTable 
        WHERE status = 'Sipariş verildi' AND user_id = '$id'
        GROUP BY order_id, user_id, status";
$res = mysqli_query($connect, $sql);

if (mysqli_num_rows($res) > 0) {
    $orders = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    echo "<div class='error text-center'>Sipariş bulunamadı.</div>";
    exit();
}

// Group orders by order_id
$order_details = [];
foreach ($orders as $order) {
    $order_id = $order['order_id'];
    if (!isset($order_details[$order_id])) {
        $order_details[$order_id] = [
            'food' => explode(',', $order['food']),
            'price' => explode(',', $order['price']),
            'qty' => explode(',', $order['qty']),
            'total' => $order['total'],
            'status' => $order['status'],
            'order_id' => $order_id
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aktif Siparişlerim</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/information-table.css"/>
    <link rel="stylesheet" href="../css/cart-styles.css"/>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Aktif Siparişlerim</h2>

        <table class="order-table">
            <tr>
                <th>Yemek</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
            <?php foreach ($order_details as $order) { ?>
                <tr>
                    <td>
                        <?php foreach ($order['food'] as $food) { ?>
                            <?php echo $food; ?><br>
                        <?php } ?>
                    </td>
                    <td>
                        <?php foreach ($order['price'] as $price) { ?>
                            <?php echo $price; ?>₺<br>
                        <?php } ?>
                    </td>
                    <td>
                        <?php foreach ($order['qty'] as $qty) { ?>
                            <?php echo $qty; ?><br>
                        <?php } ?>
                    </td>
                    <td><?php echo $order['total']; ?>₺</td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <form action="cancel_order.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit" class="btn btn-danger">İptal Et</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="text-center">
            <a href="<?php echo SITEURL; ?>" class="btn btn-primary">Menü sayfasına dön</a>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
</body>
</html>