<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.12). Xem danh sách mua hàng được thanh toán bằng thẻ trong một ngày
    $sql = "SELECT *
            FROM invoice
            WHERE invoice.method_pay=0";
    $book = executeResult($sql);
?>
<h1>Xem danh sách mua hàng được thanh toán bằng thẻ trong một ngày</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Gmail</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Ngày thanh toán</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.$book[$i]["id"].'</th>';
            echo '<td>'.$book[$i]["cus_gmail"].'</td>';
            echo '<td>'.$book[$i]["total_money"].'</td>';
            echo '<td>'.$book[$i]["state"].'</td>';
            echo '<td>'.$book[$i]["date_pay"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>