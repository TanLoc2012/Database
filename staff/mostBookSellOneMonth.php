<?php
    require_once "../headerStaff.php";
    //(i.11). Xem danh sách sách được mua nhiều nhất trong một tháng.
    $date_bought = '2021-11-06';
    $sql = "SELECT book.isbn,book.name,SUM(bought.num),book.thumbnail
            FROM bought,book,invoice
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.isbn=book.isbn
            GROUP BY book.isbn
            ORDER BY SUM(bought.num) DESC";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem danh sách sách được mua nhiều nhất trong một tháng 12</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Số lượng</th>
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
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  require_once "../footer.php";
?>