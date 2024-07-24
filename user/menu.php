<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css"/>
</head>
<body>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menü</h2>

        <?php
            //Display foods that are active
            $sql = "SELECT * FROM $menuTable WHERE active='Evet'";
            $res = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0){
                //Foods Available
                while ($row = mysqli_fetch_assoc($res)){
                    //Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                //If the image not available
                                if ($image_name == ""){
                                    echo "<div class='error'>Resim mevcut değil.</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>../images/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?>₺</p>
                            <br>
                            <form action="add-to-cart.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="title" value="<?php echo $title; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                                <p><b>Adet<b></p>
                                <input type="number" name="qty" value="1" min="1" required>
                                <input type="submit" name="submit" value="Sepete ekle" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error'>Ürün bulunamadı.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
</body>
</html>