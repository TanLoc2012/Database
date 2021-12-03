<?php
    require_once "../headerStaff.php";
    //get nxb
    $sql = "SELECT * FROM nxb";
    $nxb = executeResult($sql);

    if(isset($_POST["btnAddBook"])){
      $isbn = getPost('isbn');
      $name = getPost('name');
      $nxbid = getPost('nxbid');
      $price = getPost('price');
      $year = getPost('year');
      $quantityHaNoi = getPost('quantityHaNoi');
      $quantityHCM = getPost('quantityHCM');
      $link = getPost('link');
      $thumbnail = getPost('thumbnail');

      $quantity = $quantityHaNoi + $quantityHCM;

      // insert into book
      if($link && $quantity)
        $typebook=2;
      else if($link && !$quantity)
        $typebook=1;
      else if(!$link && $quantity)
        $typebook=0;
      $sql = "INSERT INTO `book`(`isbn`, `name`, `nxb_id`, `price`, `typebook`, `thumbnail`, `year`) 
              VALUES ('$isbn','$name','$nxbid','$price','$typebook','$thumbnail','$year')";
      execute($sql);

      if($link){
        $sql = "INSERT INTO `ebook`(`isbn`, `link`) 
                VALUES ('$isbn','$link')";
        execute($sql);
      }

      if($quantity){
        $sql = "INSERT INTO `printed_book`(`isbn`, `state`, `quantity`) 
                VALUES ('$isbn',0,'$quantity')";
        execute($sql);
      }

      if($quantityHaNoi){
        $date = date("Y-m-d");
        $sql = "INSERT INTO `storageaddress`(`isbn`, `address`, `quantity`, `ngaynhap`) 
                VALUES ('$isbn','1','$quantityHaNoi','$date')";
        execute($sql);
      }

      if($quantityHCM){
        $date = date("Y-m-d");
        $sql = "INSERT INTO `storageaddress`(`isbn`, `address`, `quantity`, `ngaynhap`) 
                VALUES ('$isbn','0','$quantityHCM','$date')";
        execute($sql);
      }
    }
?>
<h3 style="margin:70px 620px 0">Nhập sách về kho hàng</h3>
<form style="width:60%;margin: 0 auto" method="POST" action="staff/addBook.php">
    <div class="form-group" id="form1">
        <label for="isbn">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN 6 chữ số">
    </div>

    <div class="form-group">
        <label for="name">Tên sách</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Tên sách">
    </div>

    <label for="name">Nhà xuất bản</label>
    <select class="form-select" name="nxbid">
        <?php
          $countNXB = count($nxb);
          for($i=0;$i<$countNXB;$i++){
            echo '<option value="'.$nxb[$i]["id"].'">'.$nxb[$i]["name"].'</option>';
          }
        ?>
    </select>

    <div class="form-group">
        <label for="price">Giá</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Giá">
    </div>

    <div class="form-group">
        <label for="price">Năm xuất bản</label>
        <input type="number" class="form-control" id="year" name="year" placeholder="Năm xuất bản">
    </div>

    <div class="form-group">
        <label for="price">Link ảnh của sách</label>
        <input type="text" class="form-control" id="thumbnail" name="thumbnail" placeholder="Link ảnh của sách">
    </div>

    <div class="form-group">
        <label for="quantity">Địa chỉ: Hà Nội</label>
        <input type="number" class="form-control" id="price" name="quantityHaNoi" placeholder="Vui lòng nhập số lượng">
    </div>

    <div class="form-group">
        <label for="quantity">Địa chỉ: Thành phố Hồ Chí Minh</label>
        <input type="number" class="form-control" id="price" name="quantityHCM" placeholder="Vui lòng nhập số lượng">
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="Link">
    </div>

    <button name="btnAddBook" type="submit" class="btn btn-primary">Thêm</button>
</form>

<?php
  require_once "../footer.php";
?>