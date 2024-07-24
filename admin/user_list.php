<?php
    $locker = 1;

    include("../settings.php");
    include("admin_navbar.php");

    $sql = "SELECT * FROM $userTable";
    $res = mysqli_query($connect, $sql);

    if (mysqli_num_rows($res) > 0) {
        $user_details = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        echo "<div class='error text-center'>Kullanıcı bulunamadı.</div>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Listesi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/information-table.css"/>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Kullanıcı Listesi</h2>

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
                <th>Departman</th>
                <th>Bakiye</th>
                <th>Bakiye Güncelle</th>
            </tr>
            <?php foreach ($user_details as $user) { ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['department']; ?></td>
                <td><?php echo $user['balance']; ?>₺</td>
                <td>
                    <form action="update_balance.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="number" name="new_balance" value="<?php echo number_format((float)$menu['price'], 2, '.', ''); ?>" min="0" step="0.01" required>
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
