<?php
    //Include Database Connection 
    $locker = 1;
    include_once('settings.php');


    //Register
    if (isset($_POST['register'])) {
        $errorMsg = "";

        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        $department = mysqli_real_escape_string($connect, $_POST['department']);

        //ŞİFREYİ HASHLE!!!!!!!
        //Check Name and password and also check if user exists
        if (strlen($name) == 0) {
            $errorMsg = "İsim alanı boş bırakılamaz";
        } else if (strlen($password) < 6) {
            $errorMsg = "Şifreniz en az 6 haneden oluşmalıdır";
        } else {
            $sql = "SELECT * FROM $userTable WHERE name = '$name'";
            $execute = mysqli_query($connect, $sql);

            if ($execute->num_rows == 1) {
                $errorMsg = "Bu isimde kullanıcı bulunuyor, başka isimle tekrar deneyin";
            } else {
                // Insert user data to database
                $query = "INSERT INTO $userTable (name, password, department, balance) VALUES ('$name', '$password', '$department', 0)";
                $result = mysqli_query($connect, $query);

                if ($result == true) {
                    header("Location:$loginPage");
                } else {
                    $errorMsg = "Kayıtlı değilsiniz, tekrar deneyin";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    
<div class="container pb-2" style="margin-top:100px">
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
            <div class="row g-3">
                <div class="col">
                <label for="inputName" class="form-label">İsim</label>
                <input type="text" name="name" id="inputName"  class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Şifre</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>

            <div>
                <label for="inputDepartment" class="form-label">Departman</label>
                <input type="text" name="department" class="form-control" id="inputDepartment">
            </div>

        <p>Hesabınız varsa: <a href="<?php echo $loginPage; ?>" >Giriş yap</a></p>

        <input type="submit" class="btn btn-primary" name="register" value="Kayıt ol">
</form>

    </div>
    </div>
</div>

</body>
</html>
