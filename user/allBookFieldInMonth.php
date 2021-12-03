<?php
    require_once "../header.php";

    $id = $user["id"];
    $sql = "SELECT DISTINCT(title)
            FROM field";
    $fields = executeResult($sql);
?>
<h3 style="margin-top:70px">Tổng số sách theo từng thể loại mà mình đã mua trong một tháng</h4>
<hr>
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