<?php
    require_once "../header.php";
    $total = $_GET["total"];

    if(isset($_POST["btnCheckout"])){
        $cus_id = getPost('user_id');
        $fullname = getPost('fullname');
        $address = getPost('address');
        $phone = getPost('phone');
        $data_pay = date("Y-m-d");
        $state = 0;
        $method_pay = 0;

        $sql = "INSERT INTO `invoice`(`customer_id`, `total_money`, `state`, `method_pay`, `date_pay`, `fullname`, `phone`, `address`) 
                VALUES ('$cus_id','$total','$state','$method_pay','$data_pay','$fullname','$phone','$address')";
        execute($sql);

        $sql = "SELECT id
                FROM invoice
                WHERE customer_id='$cus_id'
                ORDER BY id DESC
                LIMIT 1";
        $invoiceId = executeResult($sql);
        $invoiId = $invoiceId[0]["id"];

        $cart = [];
        $num = [];
        if(isset($_COOKIE['cart'])) {
            $json = $_COOKIE['cart'];
            $cart = json_decode($json, true);
        }

        $idList = [];
        foreach ($cart as $item) {
            $idList[] = $item['isbn'];
            $num[] = $item['num'];
        }
        if(count($idList) > 0) {
            $idList = implode(',', $idList);
            //[2, 5, 6] => 2,5,6
            $sql = "SELECT * 
                    FROM book
                    WHERE isbn IN ($idList)";
            $orderDetails = executeResult($sql);
        } else {
            $orderDetails = [];
        }
        for($i=0;$i<count($orderDetails);$i++){
            $isbn = $orderDetails[$i]["isbn"];
            $num1 = $num[$i];
            $totalMoney = $num1*$orderDetails[$i]["price"];
            $sql = "INSERT INTO `bought`(`invoice_id`, `isbn`, `num`, `total_money`) 
                    VALUES ('$invoiId','$isbn','$num1','$totalMoney')";
            execute($sql);
        }
        setcookie('cart', "", -60, '/');
    }
?>
<!--Section: Block Content-->
<nav id="nav-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="ml125 breadcrumb-item"><a href="http://localhost/Laptrinhweb/Home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
        </ol>
    </nav>
<!-- Card -->
<div id="wrapper">
  <div class="pt-4 pb-3">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-lg-6 mb-5 mb-lg-0">

      <h5 class="mb-4 pb-1">Thủ tục thanh toán</h5>

      <!-- Grid row -->
      <form method="POST" action="user/checkout.php?total=<?=$total?>">
      <div class="row">
        <!-- Grid column -->
        <div class="col-lg-12">

          <div class="md-form md-outline mt-0">
            <label for="form11">Họ và tên</label>
            <input type="text" name="fullname" id="form11" class="form-control" placeholder="Họ và tên">
          </div>

        </div>

      </div>
     
      <input type="text" name="user_id" value="<?=$user["id"]?>" hidden="true">
      <div class="md-form md-outline mt-0">
        <label for="form14">Địa chỉ</label>
        <input type="text" name="address" id="form14" placeholder="Địa chỉ" class="form-control">
      </div>

      <!-- Phone -->
      <div class="md-form md-outline mt-0">
        <label for="form18">Số điện thoại</label>
        <input type="text" name="phone" id="form18" class="form-control" placeholder="Số điện thoại">
      </div>

      <a style="color:white;text-decoration:none" ><button onclick=checkOrderCheckout() name="btnCheckout" class="btn btn-primary btn-block">Đặt hàng</button></a>
</form>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-6">

    <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-3">Tổng số tiền cần phải thanh toán:</h5>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Số tiền tạm thời:
              <span><?=number_format($total)?> đ</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
              Tiền giao hàng:
              <span>Freeship</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
              <div>
                <strong>Tổng số tiền cần phải thanh toán:</strong>
              </div>
              <span><strong><?=number_format($total)?> đ</strong></span>
            </li>
          </ul>

          

        </div>
      </div>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

  </div>
</div>
<!-- Card -->

<?php
    require_once "../footer.php";
?>