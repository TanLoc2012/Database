<?php
    require_once "../headerStaff.php";
    //get printed_book state = 0
    if($_GET["isbn"]){
        $isbn = getGet('isbn');
        //update state book = 1

        $sql = "UPDATE printed_book
                SET state=1
                WHERE isbn='$isbn'";
        execute($sql);
    }

    $sql = "SELECT book.isbn, book.name, book.price, book.thumbnail
            FROM printed_book JOIN book ON printed_book.isbn=book.isbn
            WHERE printed_book.state=0";
    $books = executeResult($sql);
?>
<h3 style="margin:70px 620px 0">Cập nhật sách về kho hàng</h3>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sách</th>
            <th scope="col">Giá</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php
    $countBooks = count($books);
    for($i=0;$i<$countBooks;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td><img style="width:200px;height:200px" src="'.$books[$i]["thumbnail"].'"></img></td>
                <td>'.$books[$i]["name"].'</td>
                <td>'.number_format($books[$i]["price"]).' đ</td>
                <td><a href="staff/updateStateBook.php?isbn='.$books[$i]["isbn"].'"><button type="button" class="btn btn-danger">Cập nhật</button></a></td>
            </tr>';
    }
?>
        
    </tbody>
</table>

<?php
  require_once "../footer.php";
?>