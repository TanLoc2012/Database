<?php
    require_once "../headerStaff.php";
    //(i.15). Xem tổng số sách tính theo mỗi ISBN tại mỗi kho hàng trong một tháng
    $date_bought = '2021-11-06';
    $sql = "SELECT storageaddress.isbn,book.name,storageaddress.quantity,addressstore.address,storageaddress.ngaynhap
            FROM storageaddress,book,addressstore
            WHERE MONTH(storageaddress.ngaynhap)='12' AND book.isbn=storageaddress.isbn AND addressstore.id=storageaddress.address_id
            ORDER BY addressstore.address ASC";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem tổng số sách tính theo mỗi ISBN tại mỗi kho hàng trong một tháng 12</h3>
<h1></h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Địa chỉ kho</th>
      <th scope="col">Ngày nhập</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.$i.'</th>';
            echo '<td>'.$data[$i]["isbn"].'</td>';
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["quantity"].'</td>';
            echo '<td>'.$data[$i]["address"].'</td>';
            echo '<td>'.$data[$i]["ngaynhap"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>