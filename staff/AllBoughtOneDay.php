<?php
    require_once "../headerStaff.php";
    //select book
    //(i.4). Xem tất cả các sách tính theo ISBN được mua trong một ngày
    $date_bought = '2021-11-06';
    $sql = "SELECT * 
            FROM book
            WHERE book.isbn IN (SELECT DISTINCT(bought.isbn)
            FROM bought JOIN invoice ON bought.invoice_id=invoice.id
            WHERE invoice.date_pay='2021-12-01')";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 350px 0">Xem tất cả các sách tính theo ISBN được mua trong một ngày 2021-12-01</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Giá</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$data[$i]["isbn"].'</td>';
            echo '<td><img style="width:200px;height:200px" src="'.$data[$i]["thumbnail"].'"></img></td>';
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["price"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>

<?php
  require_once "../footer.php";
?>