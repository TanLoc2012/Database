<?php
    require_once "../headerStaff.php";
    $sql = "SELECT COUNT(bought.id),bought.id_store,addressstore.address
            FROM bought,invoice,addressstore
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.id_store=addressstore.id
            GROUP BY bought.id_store";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 350px 0">Xem danh sách kho hàng được xuất kho nhiều nhất trong một tháng 12</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Địa chỉ kho</th>
      <th scope="col">Số lượng xuất kho</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$data[$i]["address"].'</td>';
            echo '<td>'.$data[$i]["COUNT(bought.id)"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>