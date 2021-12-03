<?php
require_once "../DB.php";
require_once "header.php";
// method_pay: 0-> mua , 1->thuê

// (i.1). Cập nhật thông tin về sách khi sách được nhập kho. Note: Số lương ->trigger
if(isset($_POST)){
    $quantityHCM = $quantityHN = 0;
    $link = $isbn = "";
    if(isset($_POST["isbn"]))
      $isbn = $_POST["isbn"];
    if(isset($_POST["name"]))
      $name = $_POST["name"];
    if(isset($_POST["price"]))
      $price = $_POST["price"];
    if(isset($_POST["link"]))
      $link = $_POST["link"];
    if(isset($_POST["nxbid"]))
      $nxbid = $_POST["nxbid"];
    if(isset($_POST["quantityHaNoi"]))
      $quantityHN = $_POST["quantityHaNoi"];
    if(isset($_POST["quantityHCM"]))
      $quantityHCM = $_POST["quantityHCM"];
    $quantity = $quantityHCM + $quantityHN;
    
    if(isset($_POST["isbn"])){
      $sql = "insert into book(isbn, name, nxb_id, price) values('$isbn','$name',$nxbid,$price)";
      execute($sql);
    }

    if($link) {
        $sql = "insert into ebook(isbn, link) values('$isbn','$link')";
        execute($sql);
    }

    if($quantity != 0){
        $sql = "insert into printed_book(isbn, state, quantity) values('$isbn',1, $quantity)";
        execute($sql);
        if($quantityHN != 0) {
            $sql = "insert into storageaddress(isbn, address, quantity) values('$isbn','Hà nội', $quantityHN)";
            execute($sql);
        }
        if($quantityHCM != 0){
            $sql = "insert into storageaddress(isbn, address, quantity) values('$isbn','Thành phố Hồ Chí Minh', $quantityHCM)";
            execute($sql);
        }
    }
}

?>



