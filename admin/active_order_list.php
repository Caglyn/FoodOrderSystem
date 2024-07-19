<?php
    // Include database connection
    $locker = 1;
    include("../settings.php");
    include("admin_navbar.php");

    // Number of rows to show per page
    $limit = 10;

    // Get the current page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    // Calculate the starting row for the query
    $offset = ($page - 1) * $limit;

    // Count the total number of unique user orders on the same date
    $count_sql = "SELECT COUNT(*) FROM (SELECT user_id, order_date FROM $ordersTable WHERE status = 'Sipariş verildi' GROUP BY user_id, order_date) AS temp";
    $count_res = mysqli_query($connect, $count_sql);
    $total_rows = mysqli_fetch_array($count_res)[0];
    $total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aktif Siparişler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/information-table.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch and update the order list
            function fetchOrders() {
                $.ajax({
                    url: 'fetch_orders.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = '';
                        $.each(data, function(index, order) {
                            var foods = order.foods.split(', ');
                            var prices = order.prices.split(', ');
                            var quantities = order.quantities.split(', ');

                            tableBody += '<tr>';
                            tableBody += '<td>' + order.user_name + '</td>';
                            tableBody += '<td>' + order.user_department + '</td>';
                            tableBody += '<td>' + foods.join('<br>') + '</td>';
                            tableBody += '<td>' + prices.join('<br>') + '₺</td>';
                            tableBody += '<td>' + quantities.join('<br>') + '</td>';
                            tableBody += '<td>' + order.total + '₺</td>';
                            tableBody += '<td>' + order.order_date + '</td>';
                            tableBody += '<td>' +
                                '<form action="update_order_status.php" method="POST">' +
                                    '<input type="hidden" name="order_id" value="' + order.order_id + '">' +
                                    '<input type="hidden" name="order_date" value="' + order.order_date + '">' +
                                    '<select name="new_status" onchange="this.form.submit()">' +
                                        '<option value="Sipariş verildi"' + (order.status === 'Sipariş verildi' ? ' selected' : '') + '>Sipariş verildi</option>' +
                                        '<option value="Sipariş teslim edildi"' + (order.status === 'Sipariş teslim edildi' ? ' selected' : '') + '>Sipariş teslim edildi</option>' +
                                        '<option value="Sipariş iptal edildi"' + (order.status === 'Sipariş iptal edildi' ? ' selected' : '') + '>Sipariş iptal edildi</option>' +
                                    '</select>' +
                                '</form>' +
                            '</td>';
                            tableBody += '</tr>';
                        });
                        $('.order-table tbody').html(tableBody);
                    },
                    error: function() {
                        console.log('Failed to fetch orders.');
                    }
                });
            }

            //Initial fetch
            fetchOrders();

            //Fetch orders every 5 seconds
            setInterval(fetchOrders, 5000);
        });
    </script>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Aktif Siparişler</h2>

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
            <thead>
                <tr>
                    <th>Kullanıcı</th>
                    <th>Departman</th>
                    <th>Yemek</th>
                    <th>Fiyat</th>
                    <th>Adet</th>
                    <th>Toplam</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                <!-- Content will be dynamically updated by JavaScript -->
            </tbody>
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

