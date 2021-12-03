<?php
    require_once "../headerStaff.php";
    //(i.6). Xem tổng số sách truyền thống tính theo mỗi ISBN được mua trong một ngày.
    $date_bought = '2021-11-06';
    $sql = "SELECT DISTINCT(bought.isbn),SUM(bought.num),book.name,book.price,book.thumbnail,invoice.date_pay
            FROM bought,invoice,book
            WHERE invoice.date_pay='2021-12-01' AND bought.invoice_id=invoice.id AND book.isbn=bought.isbn AND bought.typebook=0
            GROUP BY bought.isbn";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem tổng số sách truyền thống tính theo mỗi ISBN được mua trong một ngày 2021-12-01</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Ngày mua</th>
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
            echo '<td>'.$data[$i]["SUM(bought.num)"].'</td>';
            echo '<td>'.$data[$i]["date_pay"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>