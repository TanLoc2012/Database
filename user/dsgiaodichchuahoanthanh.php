<?php
    require_once "../header.php";

    $id = $user["id"];
    $sql = "SELECT * 
            FROM invoice
            WHERE invoice.customer_id='$id' AND MONTH(invoice.date_pay)=12 AND state IN (0,4)";
    $allGiaodich = executeResult($sql);
?>
<h3 style="margin-top:70px">Danh sách các giao dịch mà mình đã thực hiện trong một tháng 12</h4>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Thời gian giao dich</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Phương thức giao dịch</th>
        </tr>
    </thead>
    <tbody>
<?php
    $countGiaodich = count($allGiaodich);
    for($i=0;$i<$countGiaodich;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td>'.$allGiaodich[$i]["fullname"].'</td>
                <td>'.$allGiaodich[$i]["date_pay"].'</td>
                <td>'.number_format($allGiaodich[$i]["total_money"]).'</td>';
                if($allGiaodich[$i]["state"] == 0)
                    echo '<td>Đang chờ duyệt</td>';
                else if($allGiaodich[$i]["state"] == 1)    
                    echo '<td>Đang giao hàng</td>';
                else if($allGiaodich[$i]["state"] == 2)    
                    echo '<td>Hủy. Giao dịch hoàn thành!</td>';
                else if($allGiaodich[$i]["state"] == 3)    
                    echo '<td>Thành công.Giao dịch hoàn thành!</td>';
                else if($allGiaodich[$i]["state"] == 4)    
                    echo '<td>Chờ duyệt. Đã thanh toán</td>';
                if($allGiaodich[$i]["method_pay"] == 0)
                    echo '<td>Thanh toán trực tiếp</td>';
                else    echo '<td>Thanh toán online</td>
            </tr>';
    }
?>
        
    </tbody>
</table>
<?php
    require_once "../footer.php";
?>