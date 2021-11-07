<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.15). Xem tổng số sách tính theo mỗi ISBN tại mỗi kho hàng trong một tháng
    $date_bought = '2021-11-06';
    $sql = "SELECT storageaddress.isbn,book.name,storageaddress.quantity,storageaddress.address,storageaddress.ngaynhap
            FROM storageaddress,book
            WHERE YEAR(storageaddress.ngaynhap)='2021' AND MONTH(storageaddress.ngaynhap)='11' AND book.isbn=storageaddress.isbn
            ORDER BY storageaddress.address ASC";
    $data = executeResult($sql);
?>
<h1>Xem tổng số sách tính theo mỗi ISBN tại mỗi kho hàng trong một tháng</h1>
<table class="table">
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