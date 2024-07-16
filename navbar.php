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
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar-search.css"/>
</head>
<body>
<section class="navbar">
            <div class="menu text-right">
                <ul>
                    <li style="color: #45637d;">
                        <?php echo $name; ?>
                    </li>
                    <li style="color: #45637d;">
                        <?php echo "  Bakiye:" .  $balance . "₺"; ?>
                    </li>
                </ul>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo $dashboardPage; ?>">Menü</a>
                    </li>
                    <li>
                        <a href="<?php echo $cartPage; ?>">Sepet</a>
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