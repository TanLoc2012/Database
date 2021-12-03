<?php
    require_once "../headerStaff.php";
    //get printed_book state = 0
    if($_GET["id"]){
        $id = getGet('id');
        //update state book = 1

        $sql = "UPDATE `invoice` 
                SET `state`='1'
                WHERE id='$id'";
        execute($sql);
    }

    $sql = "SELECT * 
            FROM `invoice` 
            WHERE state IN (0,4)";
    $invoices = executeResult($sql);
?>
<h3 style="margin:70px 620px 0">Cập nhật sách xuất kho hàng</h3>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên người đặt hàng</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Số tiền</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php
    $countinvoices = count($invoices);
    for($i=0;$i<$countinvoices;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td>'.$invoices[$i]["fullname"].'</td>
                <td>'.$invoices[$i]["phone"].'</td>
                <td>'.number_format($invoices[$i]["total_money"]).' đ</td>
                <td><a href="staff/updateStateInvoice.php?id='.$invoices[$i]["id"].'"><button type="button" class="btn btn-danger">Xuất kho</button></a></td>
            </tr>';
    }
?>
        
    </tbody>
</table>

<?php
  require_once "../footer.php";
?>