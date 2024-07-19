<?php
    $locker = 1;
    include("../settings.php");

    if (isset($_POST['user_id']) && isset($_POST['balance_increase'])) {
        $user_id = $_POST['user_id'];
        $balance_increase = floatval($_POST['balance_increase']);

        $query = "UPDATE $userTable SET balance = balance + $balance_increase WHERE id = $user_id";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $_SESSION['success'] = "Bakiye başarıyla güncellendi.";
        } else {
            $_SESSION['error'] = "Bakiye güncellenemedi.";
        }

        header("Location: user_list.php");
        exit();
    } else {
        $_SESSION['error'] = "Geçersiz istek.";
        header("Location: user_list.php");
        exit();
    }
?>