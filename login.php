<?php
    session_start();
    require_once "utility.php";
    require_once "DB.php";
    if(isset($_POST["btnLogin"])){
        // get value Form register
        $email = getPost('email');
        $password = getPost('password');
        $password = getSecurityMD5($password);

        //sql
        $sql = "SELECT * 
                FROM `customer` 
                WHERE email='$email' AND password='$password'";
        // execute sql
        $user = executeResult($sql,true);
        if($user){
            $_SESSION['user'] = $user;
            if($user["role_id"]==2)
                header("Location: staff/index.php");
            else header("Location: index.php?filed=1&author=1&keyword=1&year=1");
        }
        else echo 'Vui long dang nhap lai!!';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>Document</title>
</head>
<style>
    .divider-text {
        position: relative;
        text-align: center;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .divider-text span {
        padding: 7px;
        font-size: 12px;
        position: relative;
        z-index: 2;
    }

    .divider-text:after {
        content: "";
        position: absolute;
        width: 100%;
        border-bottom: 1px solid #ddd;
        top: 55%;
        left: 0;
        z-index: 1;
    }

    .btn-facebook {
        background-color: #405D9D;
        color: #fff;
    }

    .btn-twitter {
        background-color: #42AEEC;
        color: #fff;
    }
</style>

<body>
    <div class="container">
        <hr>


        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Đăng nhập</h4>

                <form method="POST" action="login.php">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email address" type="email">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password" class="form-control" placeholder="Create password" type="password">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button name="btnLogin" type="submit" class="btn btn-primary btn-block"> Đăng nhập </button>
                    </div> <!-- form-group// -->
                    <p class="text-center">Nếu chưa có tài khoản? <a href="register.php">Đăng ký</a> </p>
                    <p class="text-center"><a href="index.php">Quay lại trang chủ</a> </p>
                </form>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->

    <br><br>
</body>

</html>