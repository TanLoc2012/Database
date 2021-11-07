<?php
    require_once "DB.php";
    require_once "header.php";
    //(i.3). Cập nhật thông tin giao dịch khi giao dịch trực tuyến gặp sự cố
    if($_POST){
      if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "update invoice set state=1 where id=$id";
        execute($sql);
      }
    }
    
?>
<h1>Cập nhật thông tin giao dịch khi giao dịch trực tuyến gặp sự cố</h1>
<form method="POST">
  <div class="form-group" id="form1">
    <label for="id">Id giao dịch</label>
    <input type="text" class="form-control" id="id" name="id"  placeholder="Id giao dịch">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>
      