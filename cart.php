<?php
    // Include database connection and start session
    $locker = 1;
    include("settings.php");
    include("navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sepet</title>
    <link rel="stylesheet" href="cart-styles.css"/>
</head>
<body>
<section class="food-cart">
    <div class="container">
        <h2 class="text-center">Sepetiniz</h2>

        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
                $total += floatval($item['price']) * intval($item['qty']);
                ?>
                <div class="cart-item">
                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL; ?>images/<?php echo $item['image_name']; ?>" alt="<?php echo $item['title']; ?>" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $item['title']; ?></h4>
                        <p class="food-price"><?php echo $item['price']; ?>₺</p>
                        <p class="food-detail">
                            Adet: <?php echo $item['qty']; ?>
                        </p>
                        <br>
                        <form action="remove-from-cart.php" method="POST">
                            <input type="hidden" name="key" value="<?php echo $key; ?>">
                            <input type="number" name="remove_qty" value="1" min="1" max="<?php echo $item['qty']; ?>" required>
                            <input type="submit" name="submit" value="Çıkar" class="btn btn-danger">
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="total">
                <h3>Toplam: <?php echo $total; ?>₺</h3>
                <a href="place-order.php" class="btn btn-primary">Sipariş verin</a>
            </div>
            <?php
        } else {
            echo "<div class='error'>Sepetiniz boş</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
</body>
</html>
