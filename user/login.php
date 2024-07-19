<?php
    //Include database connection
    $locker = 1;
    include("../settings.php");

    //Checking if already logged in
    session_start();
    if(isset($_POST['id'])){
        header("Location:$dashboardPage");
    }

    if(isset($_POST['login'])){
        $errorMsg = "";

        $name = mysqli_real_escape_string($connect, $_POST["name"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);

        if(!empty($name) && !empty($password)){
            $query = "SELECT * FROM $userTable WHERE name = '$name'";
            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_assoc($result)){
                    // Check the plain text password
                    if($password == $row['password']){
                        $_SESSION['id'] = $row['id'];
                        header("Location:$dashboardPage");
                    }
                    else{
                        $errorMsg = "İsim veya şifre hatalı";
                    }
                }
            }
            else{
                $errorMsg = "Bu isimde kullanıcı mevcut değil";
            }
        }
        else{
            $errorMsg = "İsim veya şifre boş bırakılamaz";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="mb-3" style="margin-top:50px; text-align:center;font-size: 30px;">
            Üye Girişi
    </div>
    
    <div class="container pb-2" style="margin-top:50px">
        <div class="row">
            <div class="col-sm-3 col-md-4 col-lg-4"></div>
            <div class="col-sm-7 col-md-6 col-lg-4 border p-5 rounded" style="margin-top:20px">

                <?php
                    // Print Error Message
                    if (isset($errorMsg)) {
                        echo 
                        "<div class='alert alert-warning alert-dismissible fade show'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        $errorMsg
                        </div>";         
                    }
                ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">İsim</label>
                        <input type="text" name="name" class="form-control" id="inputName">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Şifre</label>
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>

                    <p>Kayıt olmak için tıklayın: <a href="<?php echo $registerPage; ?>" >Kaydol</a></p>
                    <p>Admin girişi: <a href="<?php echo $adminLoginPage; ?>" >Admin Girişi</a></p>

                    <input type="submit" class="btn btn-primary" name="login" value="Giriş yap">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
