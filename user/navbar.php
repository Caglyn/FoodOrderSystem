<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location:$loginPage");
    }

    $id = $_SESSION['id'];

    $query = "SELECT * FROM $userTable WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $balance = $row['balance'];
        }
    }

    $cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css"/>
</head>
<body>
<section class="navbar">
    <div class="menu text-left">
        <ul>
            <li class="user-info">
                <?php echo $name . "  Bakiye: " . $balance . "₺"; ?>
            </li>
        </ul>
    </div>
    <div class="menu text-right">
        <ul>
            <li>
                <a href="<?php echo $dashboardPage; ?>">Menü</a>
            </li>
            <li>
                <a href="<?php echo $userActiveOrderPage; ?>">Aktif Siparişim</a>
            </li>
            <li>
                <a href="<?php echo $cartPage; ?>">
                    Sepet [
                    <span><?php echo $cart_count; ?> ]</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $logoutPage; ?>">Çıkış yap</a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</section>
</body>
</html>
