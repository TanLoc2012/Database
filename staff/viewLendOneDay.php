<?php
    require_once "../DB.php";
    require_once "header.php";
    //select book
    //(i.4). Xem tất cả các sách tính theo ISBN được mua trong một ngày
    $date_bought = '2021-11-06';
    $sql = "select DISTINCT bought.isbn,book.name ,book.price,bought.purchase_date
            from bought,book 
            where purchase_date='2021-11-06' AND bought.isbn=book.isbn";
    $data = executeResult($sql);
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Giá</th>
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
            echo '<td>'.$data[$i]["price"].'</td>';
            echo '<td>'.$data[$i]["purchase_date"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>