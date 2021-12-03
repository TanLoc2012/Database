<?php
    require_once "../headerStaff.php";
    //(i.14). Xem danh sách kho hàng có số sách tính theo mỗi ISBN dưới 10 quyển trong một ngày. // cần hỏi
    $sql = "SELECT count(storageaddress.address_id),addressstore.address
            FROM storageaddress JOIN addressstore ON storageaddress.address_id=addressstore.id
            GROUP BY storageaddress.address_id
            HAVING count(storageaddress.address_id) < 10";
    $book = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem danh sách kho hàng có số sách tính theo mỗi ISBN dưới 10 quyển trong một ngày 2021-12-01</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Địa chỉ kho</th>
      <th scope="col">Số quyển sách hiện có</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$book[$i]["address"].'</td>';
            echo '<td>'.$book[$i]["count(storageaddress.address_id)"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>