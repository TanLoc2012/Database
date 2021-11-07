<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.7). Xem tổng số sách điện tử được thuê trong một ngày.
    $date_bought = '2021-11-06';
    $sql = "select book.isbn,book.name,SUM(lend.quantity),lend.date_start,lend.date_end,lend.date_lend
            from lend,book
            WHERE lend.date_lend='2021-11-06' AND lend.isbn=book.isbn
            GROUP BY isbn";
    $data = executeResult($sql);
?>
<h1>Xem tổng số sách điện tử được thuê trong một ngày</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Ngày bắt đầu thuê</th>
      <th scope="col">Ngày hết hạn thuê</th>
      <th scope="col">Ngày thuê</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.$i.'</th>';
            echo '<td>'.$data[$i]["isbn"].'</td>';
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["SUM(lend.quantity)"].'</td>';
            echo '<td>'.$data[$i]["date_start"].'</td>';
            echo '<td>'.$data[$i]["date_end"].'</td>';
            echo '<td>'.$data[$i]["date_lend"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>