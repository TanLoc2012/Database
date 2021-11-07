<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.14). Xem danh sách kho hàng có số sách tính theo mỗi ISBN dưới 10 quyển trong một ngày. // cần hỏi
    $sql = "SELECT storageaddress.address,count(storageaddress.isbn)
            FROM storageaddress
            GROUP BY storageaddress.address
            HAVING count(storageaddress.isbn) < 10";
    $book = executeResult($sql);
?>
<h1>Xem danh sách kho hàng có số sách tính theo mỗi ISBN dưới 10 quyển trong một ngày</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Địa chỉ kho</th>
      <th scope="col">Số quyền sách hiện có</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$book[$i]["address"].'</td>';
            echo '<td>'.$book[$i]["count(storageaddress.isbn)"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>