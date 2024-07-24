<?php
    $locker = 1;
    include("../settings.php");

    if (isset($_POST['user_id']) && isset($_POST['new_balance'])) {
        $user_id = $_POST['user_id'];
        $new_balance = floatval($_POST['new_balance']);

        $query = "UPDATE $userTable SET balance = $new_balance WHERE id = $user_id";
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