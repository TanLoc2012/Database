<?php
    require_once "../header.php";

    if(isset($_GET["huy"])){
      $id = $_GET["huy"];
      
      $state = 2;
      $sql = "UPDATE `invoice` 
              SET `state`='$state' WHERE id='$id'";
      execute($sql);
    }

    if(isset($_GET["success"])){
      $id = $_GET["success"];
      
      $state = 3;
      $sql = "UPDATE `invoice` 
              SET `state`='$state' WHERE id='$id'";
      execute($sql);
    }

    $id = $user["id"];
    $sql = "SELECT * 
            FROM invoice
            WHERE invoice.customer_id='$id'";
    $orderItems = executeResult($sql);
?>
<h4 style="margin:70px 0 10px 50px ">Quản lý đơn hàng</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên</th>
      <th scope="col">Số điện thoại</th>
      <th scope="col">Ngày đặt hàng</th>
      <th scope="col">Tổng số tiền</th>
      <th scope="col">Trạng thái</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
    $countOrderItem = count($orderItems);
    for($i=0;$i<$countOrderItem;$i++){
      
      echo '<tr>
        <td>'.($i+1).'</td>
        <td><a href="">'.$orderItems[$i]["fullname"].'</a></td>
        <td>'.$orderItems[$i]["phone"].'</td>
        <td>'.$orderItems[$i]["date_pay"].'</td>
        <td>'.number_format($orderItems[$i]["total_money"]).' đ</td>
        <td>';
        if($orderItems[$i]["state"] == 0)
            echo 'Chờ duyệt';
        else if($orderItems[$i]["state"] == 1) echo "Đang giao hàng";
        else if($orderItems[$i]["state"] == 4) echo "Đã thanh toán";
        else echo "Giao dịch hoàn tất!";
        if($orderItems[$i]["state"] == 0 || $orderItems[$i]["state"] == 4)
          echo '<td><a href="user/quanlydonhang.php?huy='.$orderItems[$i]["id"].'"><button class="btn btn-danger">Hủy</button><a/></td>';
        else echo '<td></td>';
          echo '</td>';
        if($orderItems[$i]["state"] != 3 && $orderItems[$i]["state"] != 2)
          echo '<td><a href="user/quanlydonhang.php?success='.$orderItems[$i]["id"].'"><button class="btn btn-danger">Hoàn thành giao dịch</button><a/></td>';
        else echo '<td></td>
      </tr>';
    }
  ?>
  </tbody>
</table>

<?php
    require_once "../footer.php";
?>