<?php
    session_start();
    require_once "utility.php";
    require_once "DB.php";

    if(isset($_GET["logout"])){
        if($_GET["logout"]){
            session_destroy();
            header("Location: index.php?filed=1&author=1&keyword=1&year=1");
        }
    }
    $user = getUserToken();

    if($user){
        if(isset($_GET["card"])) {
            $isbn = $_GET["card"];
            $action = 'add';
            $num = 1;
    
            $cart = [];
            if(isset($_COOKIE['cart'])) {
                $json = $_COOKIE['cart'];
                $cart = json_decode($json, true);
            }
        
            switch ($action) {
                case 'add':
                    $isFind = false;
                    for ($i=0; $i < count($cart); $i++) { 
                        if($cart[$i]['isbn'] == $isbn) {
                            $cart[$i]['num'] += $num;
                            $isFind = true;
                            break;
                        }
                    }
        
                    if(!$isFind) {
                        $cart[] = [
                            'isbn'=>$isbn,
                            'num'=>$num
                        ];
                    }
                    setcookie('cart', json_encode($cart), time() + 30*24*60*60, '/');
                    break;
            }
        }

        if(isset($_GET["deleted"])){
            $json = $_COOKIE['cart'];
            $cart = json_decode($json, true);
            $id = $_GET["deleted"];
            for ($i=0; $i < count($cart); $i++) { 
              if($cart[$i]["isbn"] == $id) {
                  array_splice($cart, $i, 1);
                  break;
                }
            } 
          setcookie('cart', json_encode($cart), time() + 30*24*60*60, '/');
        }
    }
    $cart = [];
    if(isset($_COOKIE['cart'])) {
        $json = $_COOKIE['cart'];
        $cart = json_decode($json, true);
    }
    $count = 0;
    foreach ($cart as $item) {
        $count += $item['num'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/Laptrinhweb/public/images/favicon.png">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="http://localhost/Database/style.css">
    <!-- Modernizr js -->
    <link href="http://localhost/Laptrinhweb/public/fontawesome-free-5.15.4-web/css/all.min.css" rel="stylesheet">
    <!--load all styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>HomePage</title>
    <base href="http://localhost/Database/">
</head>

<body>
    <!--Navbar-->
    <!-- Begin Header -->
    <nav id="navColor" class=" navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php?filed=1&author=1&keyword=1&year=1">BookStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?filed=1&author=1&keyword=1&year=1">Trang chủ <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="user/viewAuthorField.php?filed=1&keyword1=1&keyword2=1">Lọc theo tác giả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="user/ebook.php?filed=1&author=1&keyword=1&year=1">Sách cho thuê</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="user/printedBook.php?filed=1&author=1&keyword=1&year=1" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sách chỉ bán
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="user/printedBook.php?filed=1&author=1&keyword=1&year=1">Sách truyền thống</a>
                        <a class="dropdown-item" href="user/eBook.php?filed=1&author=1&keyword=1&year=1">Ebook</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/Laptrinhweb/Home/productList" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xem danh sách
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="user/bookBoughtInMonth.php">Danh sách sách mà mình đã mua trong một tháng</a>
                        <a class="dropdown-item" href="user/dsgiaodich.php">Danh sách các giao dịch mà mình đã thực hiện trong một tháng. </a>
                        <a class="dropdown-item" href="user/dsgiaodichgapsuco.php">Danh sách các giao dịch gặp sự cố mà mình đã thực hiện trong một tháng. </a>
                        <a class="dropdown-item" href="user/dsgiaodichchuahoanthanh.php">Danh sách các giao dịch mà mình đã thực hiện nhưng chưa hoàn tất. </a>
                        <a class="dropdown-item" href="user/allBookFieldInMonth.php">Tổng số sách theo từng thể loại mà mình đã mua trong một tháng. </a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST"
                action="http://localhost/Laptrinhweb/Home/search_buttuon">
                <input class="form-control mr-sm-2" type="search" id="search_name" name="search_name"
                    placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>

        </div>
        <div style="margin-right: 20px;" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php
                        if(isset($user))
                            echo $user["name"];
                        else echo '<i style="font-size: 27px;color:black" class="far fa-user"></i>';
                    ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                        if(!isset($user)){
                            echo '<a class="dropdown-item" href="login.php">Đăng nhập</a>';
                            echo '<a class="dropdown-item" href="register.php">Đăng ký</a>';
                        }
                        else{
                            echo '<a class="dropdown-item" href="user/updateInfoUser.php">Quản lý tài khoản</a>';
                            if($user["role_id"] == 2) echo '<a class="dropdown-item" href="user/quanlydonhang.php">Quản lý đơn hàng</a>';
                            else echo '<a class="dropdown-item" href="user/quanlydonhang.php">Quản lý đơn hàng</a>';
                            echo '<a class="dropdown-item" href="header.php?logout=1">Đăng xuất</a>';
                        } 
                            
                    ?>
            </div>
        </div>
        <div class="shopping_cart">
            <a style="font-size: 30px;color:black" href="user/card.php"><i
                    class="shopping_cart fas fa-shopping-cart"></i></a>
            <span class="mount_product"><?=$count?>
            </span>
        </div>
    </nav>