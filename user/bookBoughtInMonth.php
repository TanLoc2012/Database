<?php
    require_once "../header.php";

    $id = $user["id"];
    $sql = "SELECT *
            FROM book
            WHERE isbn IN (SELECT DISTINCT(bought.isbn)
            FROM invoice JOIN bought ON invoice.id=bought.invoice_id
            WHERE MONTH(invoice.date_pay)=12 AND invoice.customer_id='$id')";
    $allBooks = executeResult($sql);
?>
<h3 style="margin-top:70px">Danh sách sách mà mình đã mua trong một tháng 12</h4>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sách</th>
            <th scope="col">Giá</th>
        </tr>
    </thead>
    <tbody>
<?php
    $countAuthor = count($allBooks);
    for($i=0;$i<$countAuthor;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td><img style="width: 200px;height: 200px" src="'.$allBooks[$i]["thumbnail"].'"></img></td>
                <td>'.$allBooks[$i]["name"].'</td>
                <td>'.number_format($allBooks[$i]["price"]).'</td>
            </tr>';
    }
?>
        
    </tbody>
</table>
<?php
    require_once "../footer.php";
?>