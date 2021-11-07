<?php
    require_once "DB.php";
    require_once "header.php";
    //select book
    $sql = "select * from book";
    $book = executeResult($sql);
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.$i.'</th>';
            echo '<td>'.$book[$i]["isbn"].'</td>';
            echo '<td>'.$book[$i]["name"].'</td>';
            echo '<td>'.$book[$i]["price"].'</td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>