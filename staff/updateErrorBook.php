<?php
    require_once "../headerStaff.php";
    //get printed_book state = 0
    if($_GET["id"]){
        $id = getGet('id');
        //update state book = 1

        $sql = "UPDATE invoice 
                SET state='5'
                WHERE id='$id'";
        execute($sql);
    }

    $sql = "SELECT * 
            FROM `invoice` 
            WHERE state IN (0,1,4)";
    $lends = executeResult($sql);
?>
<h3 style="margin:70px 430px 0">Cập nhật thông tin giao dịch khi giao dịch trực tuyến gặp sự cố</h3>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên người giao dịch</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Ngày giao dịch</th>
            <th scope="col">Số tiền</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php
    $countLends = count($lends);
    for($i=0;$i<$countLends;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td>'.$lends[$i]["fullname"].'</td>
                <td>'.$lends[$i]["phone"].'</td>
                <td>'.$lends[$i]["date_pay"].'</td>
                <td>'.number_format($lends[$i]["total_money"]).' đ</td>
                <td><a href="staff/updateErrorBook.php?id='.$lends[$i]["id"].'"><button type="button" class="btn btn-danger">Lỗi</button></a></td>
            </tr>';
    }
?>
        
    </tbody>
</table>

<?php
  require_once "../footer.php";
?>