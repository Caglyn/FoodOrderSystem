<?php
    //Include database connection
    $locker = 1;
    include("../settings.php");
    include("admin_navbar.php");

    //Number of rows to show per page
    $limit = 10;

    //Get the current page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    //Calculate the starting row for the query
    $offset = ($page - 1) * $limit;

    // Count the total number of orders
    $count_sql = "SELECT COUNT(*) FROM $ordersTable WHERE status = 'Sipariş teslim edildi' OR status = 'Sipariş iptal edildi'";
    $count_res = mysqli_query($connect, $count_sql);
    $total_rows = mysqli_fetch_array($count_res)[0];
    $total_pages = ceil($total_rows / $limit);

    //Fetch the orders for the current page
    $sql = "SELECT * FROM $ordersTable WHERE status = 'Sipariş teslim edildi' OR status = 'Sipariş iptal edildi' LIMIT $limit OFFSET $offset";
    $res = mysqli_query($connect, $sql);

    if (mysqli_num_rows($res) > 0) {
        $order_details = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        echo "<div class='error text-center'>Sipariş bulunamadı.</div>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Geçmiş Siparişler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/information-table.css"/>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Geçmiş Siparişler</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='success text-center'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='error text-center'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <table class="order-table">
            <tr>
                <th>Yemek</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
                <th>Tarih</th>
                <th>Kullanıcı</th>
                <th>Departman</th>
                <th>Durum</th>
            </tr>
            <?php foreach ($order_details as $order) { ?>
            <tr>
                <td><?php echo $order['food']; ?></td>
                <td><?php echo $order['price']; ?>₺</td>
                <td><?php echo $order['qty']; ?></td>
                <td><?php echo $order['total']; ?>₺</td>
                <td><?php echo $order['order_date']; ?></td>
                
                <?php 
                    $user_id = $order['user_id'];

                    //Display foods that are active
                    $sql = "SELECT * FROM $userTable WHERE id = $user_id";
                    $res = mysqli_query($connect, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0){
                        while ($row = mysqli_fetch_assoc($res)){
                            $user_name = $row['name'];
                            $user_department = $row['department'];
                        }
                    }
                ?>

                <td><?php echo $user_name; ?></td>
                <td><?php echo $user_department; ?></td>
                <td><?php echo $order['status']; ?></td>
            </tr>
            <?php } ?>
        </table>

        <!-- Pagination controls -->
        <div class="pagination text-center">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="btn btn-primary">&laquo; Önceki</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="btn btn-primary">Sonraki &raquo;</a>
            <?php endif; ?>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
</body>
</html>