<?php
    require_once "../headerStaff.php";

    if(isset($_POST["btnUpdateBook"])){
        $isbn = getPost('isbn');
        $name = getPost('name');
        $nxbid = getPost('nxbid');
        $price = getPost('price');
        $year = getPost('year');
        $link = getPost('link');
        $thumbnail = getPost('thumbnail');

      // insert into book
        if($link){
            $sql = "UPDATE `ebook` 
                    SET `link`='$link' 
                    WHERE isbn='$isbn'";
            execute($sql);
        }

        $sql = "UPDATE `book` 
                SET `name`='$name',`nxb_id`='$nxbid',`price`='$price',`thumbnail`='$thumbnail',`year`='$year'
                WHERE isbn='$isbn'"; 
        execute($sql);
      
    }
    //get nxb
    $sql = "SELECT * FROM nxb";
    $nxb = executeResult($sql);

    $isbnUpdate = $_GET["isbnUpdate"];
    $sql = "SELECT * 
            FROM book
            WHERE isbn='$isbnUpdate'";
    $book = executeResult($sql,true);

    
    $sql = "SELECT link
            FROM ebook
            WHERE isbn='$isbnUpdate'";
    $link1 = executeResult($sql,true);

    if($link1 == NULL)
        $link1["link"] = "";

    
?>
<h3 style="margin:70px 620px 0">Cập nhật thông tin về sách</h3>
<form style="width:60%;margin: 0 auto" method="POST" action="staff/updateInfoBook.php?isbnUpdate=<?=$isbnUpdate?>">
    <div class="form-group" id="form1">
        <label for="isbn">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="<?=$book["isbn"]?>" placeholder="ISBN 6 chữ số">
    </div>

    <div class="form-group">
        <label for="name">Tên sách</label>
        <input type="text" class="form-control" id="name" value="<?=$book["name"]?>" name="name" placeholder="Tên sách">
    </div>

    <label for="name">Nhà xuất bản</label>
    <select class="form-select" name="nxbid">
        <?php
          $countNXB = count($nxb);
          for($i=0;$i<$countNXB;$i++){
            if($nxb[$i]["id"] == $book["nxb_id"])
                echo '<option selected value="'.$nxb[$i]["id"].'">'.$nxb[$i]["name"].'</option>';
            echo '<option value="'.$nxb[$i]["id"].'">'.$nxb[$i]["name"].'</option>';
          }
        ?>
    </select>

    <div class="form-group">
        <label for="price">Giá</label>
        <input type="number" class="form-control" id="price" value="<?=$book["price"]?>" name="price" placeholder="Giá">
    </div>

    <div class="form-group">
        <label for="price">Năm xuất bản</label>
        <input type="number" class="form-control" id="year" value="<?=$book["year"]?>" name="year" placeholder="Năm xuất bản">
    </div>

    <div class="form-group">
        <label for="price">Link ảnh của sách</label>
        <input type="text" class="form-control" id="thumbnail" value="<?=$book["thumbnail"]?>" name="thumbnail" placeholder="Link ảnh của sách">
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control" id="link" value="<?=$link1["link"]?>" name="link" placeholder="Link">
    </div>

    <button name="btnUpdateBook" type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<?php
  require_once "../footer.php";
?>