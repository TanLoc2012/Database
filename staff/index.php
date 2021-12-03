<?php
    require_once "../headerStaff.php";
    //select book
    if(isset($_GET["deleted"])){
      $isbn = $_GET["deleted"];
      $sql = "UPDATE book
              SET deleted='0' 
              WHERE isbn='$isbn'";
      execute($sql);
    }

    $sql = "select * from book WHERE deleted=1";
    $book = executeResult($sql);
?>
<h3 style="margin:70px 600px 0">Danh sách sản phẩm</h3>
<a href="staff/addBook.php"><button type="button" class="btn btn-success">Thêm sách</button></a>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">ISBN</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Tên sách</th>
      <th scope="col">Giá</th>
      <th scope="col">Loại sách</th>
      <th scope="col">Sửa</th>
      <th scope="col">Xóa</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0;$i<count($book);$i++){
            echo '<tr>';
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$book[$i]["isbn"].'</td>';
            echo '<td><img style="width:200px;height:200px" src="'.$book[$i]["thumbnail"].'"></img></td>';
            echo '<td>'.$book[$i]["name"].'</td>';
            echo '<td>'.number_format($book[$i]["price"]).'</td>';
            if($book[$i]["typebook"]==0)
              echo '<td>Sách truyền thống</td>';
            else if($book[$i]["typebook"]==1)
              echo '<td>Ebook</td>';
            else if($book[$i]["typebook"]==2)
              echo '<td>Sách truyền thống và EBook</td>';
            echo '<td><a href="staff/updateInfoBook.php?isbnUpdate='.$book[$i]["isbn"].'"><button type="button" class="btn btn-warning">Sửa</button></a></td>';
            echo '<td><a href="staff/index.php?deleted='.$book[$i]["isbn"].'"><button type="button" class="btn btn-danger">Xóa</button></a></td>';
            echo '</tr>';
        }
    ?>
      
  </tbody>
</table>
<?php
  var_dump($user);
  require_once "../footer.php";
?>