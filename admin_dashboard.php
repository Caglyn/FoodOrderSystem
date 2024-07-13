<?php
    //Include database connection
    $locker = 1;
    include("settings.php");

    //Checking if already logged in
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location:$adminLoginPage");
    }

    $id = $_SESSION['id'];

    $query = "SELECT * FROM $adminTable WHERE id = '$id'";
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
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
<div class="container-fluid p-5">
    <div class="row">
        <div class="col">

        <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Merhaba Admin <?php echo $name; ?></h5>
            <a href="<?php echo $logoutPage; ?>" class="btn btn-primary">Logout</a>
        </div>
        </div>

        </div>
    </div>
</div>
</body>
</html>