<?php
    require_once "header.php"
?>

<form method="POST">
  <div class="form-group" id="form1">
    <label for="isbn">ISBN</label>
    <input type="text" class="form-control" id="isbn" name="isbn"  placeholder="ISBN 6 chữ số">
  </div>
  <div class="form-group">
    <label for="name">Tên sách</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên sách">
  </div>
  <label for="name">Nhà xuất bản</label>
  <select class="form-select" name="nxbid">
    <option value="1">Kim đồng</option>
    <option value="2">Ngọc nữ</option>
    <option value="3">Nguyễn Ái Quốc</option>
</select>
  <div class="form-group">
    <label for="price">Giá</label>
    <input type="number" class="form-control" id="price" name="price"  placeholder="Giá">
  </div>

  <div class="form-group">
    <label for="quantity">Địa chỉ: Hà Nội</label>
    <input type="number" class="form-control" id="price" name="quantityHaNoi"  placeholder="Vui lòng nhập số lương">
  </div>

  <div class="form-group">
    <label for="quantity">Địa chỉ: Thành phố Hồ Chí Minh</label>
    <input type="number" class="form-control" id="price" name="quantityHCM"  placeholder="Vui lòng nhập số lương">
  </div>

  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link" name="link" placeholder="Link">
  </div>

  
</div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>