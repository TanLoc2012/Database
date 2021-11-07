<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.10). Xem danh sách tác giả có số sách được mua nhiều nhất trong một tháng
    $date_bought = '2021-11-06';
    $sql = "SELECT author.name,author.phone,SUM(bought.num)
            FROM author, bought,written
            WHERE YEAR(bought.purchase_date)='2021' AND MONTH(bought.purchase_date)='11' AND bought.isbn=written.isbn AND written.author_phone=author.phone
            GROUP BY author.name
            ORDER BY SUM(bought.num) DESC
            LIMIT 1;";
    $data = executeResult($sql);
?>
<h1>Xem danh sách tác giả có số sách được mua nhiều nhất trong một tháng</h1>
<table class="table">
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