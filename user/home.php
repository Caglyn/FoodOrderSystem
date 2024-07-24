<?php
    //Include database connection
    $locker = 1;
    include("../settings.php");
    include("navbar.php");

    // Display success message if exists
    if (isset($_SESSION['success'])) {
        echo "<div class='success text-center'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }

    include("menu.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menü</title>
</head>
<body>

</body>
</html>