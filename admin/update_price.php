<?php
    $locker = 1;
    include("../settings.php");

    if (isset($_POST['menu_id']) && isset($_POST['new_price'])) {
        $menu_id = $_POST['menu_id'];
        $new_price = floatval($_POST['new_price']);

        $query = "UPDATE $menuTable SET price = $new_price WHERE id = $menu_id";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $_SESSION['success'] = "Fiyat başarıyla güncellendi.";
        } else {
            $_SESSION['error'] = "Fiyat güncellenemedi.";
        }

        header("Location: menu_list.php");
        exit();
    } else {
        $_SESSION['error'] = "Geçersiz istek.";
        header("Location: menu_list.php");
        exit();
    }
?>
