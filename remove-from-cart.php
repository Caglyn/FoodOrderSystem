<?php
    // Include database connection and start session
    $locker = 1;
    include("settings.php");
    include("navbar.php");

    if (isset($_POST['key']) && isset($_POST['remove_qty'])) {
        $key = $_POST['key'];
        $remove_qty = intval($_POST['remove_qty']);

        // Debug: Check received values
        echo "Key: $key, Remove Qty: $remove_qty<br>";

        // Check if the item exists in the cart
        if (isset($_SESSION['cart'][$key])) {
            // Debug: Check current quantity
            echo "Current Qty: " . $_SESSION['cart'][$key]['qty'] . "<br>";

            // Update the quantity or remove the item if the quantity becomes zero or less
            $_SESSION['cart'][$key]['qty'] -= $remove_qty;
            if ($_SESSION['cart'][$key]['qty'] <= 0) {
                unset($_SESSION['cart'][$key]);
                echo "Item removed.<br>";
            } else {
                echo "New Qty: " . $_SESSION['cart'][$key]['qty'] . "<br>";
            }
        } else {
            echo "Item not found in cart.<br>";
        }

        // Redirect back to the cart page
        // Commenting out the header for debugging purposes
        header('location:' . SITEURL . 'cart.php');
        exit();
    } else {
        // Redirect back to the cart page with an error message if the request is invalid
        $_SESSION['error'] = "Geçersiz istek.";
        // Commenting out the header for debugging purposes
        // header('location:' . SITEURL . 'cart.php');
        // exit();
        echo "Invalid request.<br>";
    }
?>
