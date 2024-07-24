<?php
    $locker = 1;

    include("../settings.php");
    include("admin_navbar.php");

    $sql = "SELECT * FROM $menuTable";
    $res = mysqli_query($connect, $sql);

    if (mysqli_num_rows($res) > 0) {
        $menu_details = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        echo "<div class='error text-center'>Menü bilgisi bulunamadı.</div>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menü Listesi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/information-table.css"/>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menü Listesi</h2>

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
                <th>İsim</th>
                <th>Mevcutluk</th>
                <th>Fiyat</th>
                <th>Fiyatı Düzenle</th>
            </tr>
            <?php foreach ($menu_details as $menu) { ?>
            <tr>
                <td><?php echo $menu['title']; ?></td>
                <td><?php echo $menu['active']; ?></td>
                <td><?php echo number_format((float)$menu['price'], 2, '.', ''); ?>₺</td>
                <td>
                    <form action="update_price.php" method="POST">
                        <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>">
                        <input type="number" name="new_price" value="<?php echo number_format((float)$menu['price'], 2, '.', ''); ?>" min="0" step="0.01" required>
                        <input type="submit" value="Güncelle" class="btn btn-primary">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="clearfix"></div>
    </div>
</section>
</body>
</html>