<?php
    //Include database connection
    $locker = 1;
    include("settings.php");

    session_start();
    if(!isset($_SESSION['id'])){
        header("Location:$loginPage");
    }

    $id = $_SESSION['id'];

    $query = "SELECT * FROM $userTable WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $id_database = $row['id'];
            $name = $row['name'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anasayfa</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
<div class="container-fluid p-5">
    sakgjldajsg
</div>
</body>
</html>