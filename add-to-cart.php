<?php
    //Include database connection
    $locker = 1;
    include("settings.php");
    include("navbar.php");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = floatval($_POST['price']);
    $qty = intval($_POST['qty']);
    $image_name = $_POST['image_name'];

    $item = array(
        'id' => $id,
        'title' => $title,
        'price' => $price,
        'qty' => $qty,
        'image_name' => $image_name
    );

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the item is already in the cart
    $item_index = -1;
    foreach ($_SESSION['cart'] as $index => $cart_item) {
        if ($cart_item['id'] == $id) {
            $item_index = $index;
            break;
        }
    }

    if ($item_index >= 0) {
        //Update quantity if item already exists in the cart
        $_SESSION['cart'][$item_index]['qty'] += $qty;
    } else {
        //Add new item to the cart
        $_SESSION['cart'][] = $item;
    }

    header('location:cart.php');
}
?>
