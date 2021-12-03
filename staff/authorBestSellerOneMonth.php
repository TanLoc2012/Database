<?php
    require_once "../headerStaff.php";
    //(i.10). Xem danh sách tác giả có số sách được mua nhiều nhất trong một tháng
    $date_bought = '2021-11-06';
    $sql = "SELECT author.name,author.phone,SUM(bought.num)
            FROM author,bought,written,invoice
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.isbn=written.isbn AND written.phone_author=author.phone
            GROUP BY author.name
            ORDER BY SUM(bought.num) DESC";
    $data = executeResult($sql);
?>
<h3 style="margin:70px 200px 0">Xem danh sách tác giả có số sách được mua nhiều nhất trong một tháng 12</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên tác giả</th>
      <th scope="col">Số điện thoại</th>
      <th scope="col">Số lượng</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["phone"].'</td>';
            echo '<td>'.$data[$i]["SUM(bought.num)"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>

<?php
  require_once "../footer.php";
?>