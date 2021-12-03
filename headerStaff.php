<?php
    require_once "utility.php";
    require_once "DB.php";

    if(isset($_GET["logout"])){
        if($_GET["logout"]){
            session_destroy();
            header("Location: index.php?filed=1&author=1&keyword=1&year=1");
        }
    }
    $user = getUserToken();

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
                    <a class="nav-link" href="staff/index.php">Trang chủ <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xem danh sách
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="staff/authorBestSellerOneDay.php">Xem danh sách tác giả có số sách được mua nhiều nhất trong một ngày</a>
                        <a class="dropdown-item" href="staff/authorBestSellerOneMonth.php">Xem danh sách tác giả có số sách được mua nhiều nhất trong một tháng</a>
                        <a class="dropdown-item" href="staff/mostBookSellOneMonth.php">Xem danh sách sách được mua nhiều nhất trong một tháng</a>
                        <a class="dropdown-item" href="staff/paymentByCard.php">Xem danh sách mua hàng được thanh toán bằng thẻ trong một ngày</a>
                        <a class="dropdown-item" href="staff/paymentError.php">Xem danh sách mua hàng được thanh toán bằng thẻ gặp sự cố trong một ngày</a>
                        <a class="dropdown-item" href="staff/storeunder10.php">Xem danh sách kho hàng có số sách tính theo mỗi ISBN dưới 10 quyển trong một ngày</a>
                        <a class="dropdown-item" href="staff/dskhohangMost1Month.php">Xem danh sách kho hàng được xuất kho nhiều nhất trong một tháng</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xem tổng số sách
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="staff/AllBoughtOneDay.php">Xem tất cả các sách tính theo ISBN được mua trong một ngày</a>
                        <a class="dropdown-item" href="staff/QuantityBoughtOneDay.php">Xem tổng số sách tính theo mỗi ISBN được mua trong một ngày</a>
                        <a class="dropdown-item" href="staff/printedbookBoughtOneDay.php">Xem tổng số sách truyền thống tính theo mỗi ISBN được mua trong một ngày</a>
                        <a class="dropdown-item" href="staff/ebookBoughtOneDay.php">Xem tổng số sách điện tử được mua trong một ngày</a>
                        <a class="dropdown-item" href="staff/ebookLendAllOneDay.php">Xem tổng số sách điện tử được thuê trong một ngày</a>
                        <a class="dropdown-item" href="staff/allBookInStoreOneMonth.php">Xem tổng số sách tính theo mỗi ISBN tại mỗi kho hàng trong một tháng</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/Laptrinhweb/Home/productList" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cập nhật
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="staff/updateStateBook.php">Cập nhật thông tin về sách khi sách được nhập kho</a>
                        <a class="dropdown-item" href="staff/updateStateInvoice.php">Cập nhật thông tin về sách khi sách được xuất kho </a>
                        <a class="dropdown-item" href="staff/updateErrorBook.php">Cập nhật thông tin giao dịch khi giao dịch trực tuyến gặp sự cố</a>
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
            <span class="mount_product"><?=0?>
            </span>
        </div>
    </nav>