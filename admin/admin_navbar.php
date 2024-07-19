<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: $adminLoginPage");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css"/>
</head>
<body>
<section class="navbar">
    <div class="menu text-right">
        <ul>
            <li>
                <a href="<?php echo $userListPage; ?>">Kullanıcılar</a>
            </li>
            <li>
                <a href="<?php echo $menuPage; ?>">Menü</a>
            </li>
            <li>
                <a href="<?php echo $activeOrdersPage; ?>">Aktif Siparişler</a>
            </li>
            <li>
                <a href="<?php echo $pastOrdersPage; ?>">Geçmiş Siparişler</a>
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