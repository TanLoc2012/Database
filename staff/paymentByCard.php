<?php
    require_once "../headerStaff.php";
    //(i.12). Xem danh sách mua hàng được thanh toán bằng thẻ trong một ngày
    $sql = "SELECT *
            FROM invoice
            WHERE invoice.method_pay=1";
    $book = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem danh sách mua hàng được thanh toán bằng thẻ trong một ngày 2021-12-01</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên người đặt hàng</th>
      <th scope="col">SỐ điện thoại</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Ngày thanh toán</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$book[$i]["fullname"].'</td>';
            echo '<td>'.$book[$i]["phone"].'</td>';
            echo '<td>'.number_format($book[$i]["total_money"]).'</td>';
            echo '<td>'.$book[$i]["date_pay"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>