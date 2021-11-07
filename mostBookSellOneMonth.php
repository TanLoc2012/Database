<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.11). Xem danh sách sách được mua nhiều nhất trong một tháng.
    $date_bought = '2021-11-06';
    $sql = "SELECT book.isbn,book.name,SUM(bought.num)
            FROM bought,book
            WHERE YEAR(bought.purchase_date)='2021' AND MONTH(bought.purchase_date)='11' AND bought.isbn=book.isbn
            GROUP BY book.isbn
            ORDER BY SUM(bought.num) DESC
            LIMIT 1";
    $data = executeResult($sql);
?>
<h1>Xem danh sách sách được mua nhiều nhất trong một tháng 11</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
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
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["SUM(bought.num)"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>