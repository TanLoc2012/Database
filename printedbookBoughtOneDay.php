<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.6). Xem tổng số sách truyền thống tính theo mỗi ISBN được mua trong một ngày.
    $date_bought = '2021-11-06';
    $sql = "select bought.isbn,book.name,SUM(bought.num),bought.purchase_date
            from bought,book,printed_book
            where purchase_date='2021-11-06' AND bought.isbn=book.isbn AND book.isbn=printed_book.isbn
            GROUP BY isbn";
    $data = executeResult($sql);
?>
<h1>Xem tổng số sách truyền thống tính theo mỗi ISBN được mua trong một ngày</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Name</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Ngày mua</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            echo '<th scope="row">'.$i.'</th>';
            echo '<td>'.$data[$i]["isbn"].'</td>';
            echo '<td>'.$data[$i]["name"].'</td>';
            echo '<td>'.$data[$i]["SUM(bought.num)"].'</td>';
            echo '<td>'.$data[$i]["purchase_date"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>