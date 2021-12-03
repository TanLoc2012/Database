<?php
    require_once "../header.php";
    //(ii.2). Cập nhật thông tin thanh toán
    if(isset($_POST["btnUpdateCustomer"])){
      $fullname = getPost('fullname');
      $phone = getPost('phone');
      $address = getPost('address');

      $sql = "UPDATE `invoice` 
              SET `fullname`='$fullname',`phone`='$phone',`address`='$address' WHERE 1";
      execute($sql);
    }

    $userId = $user["id"];
    $sql = "SELECT *
            FROM `invoice` 
            WHERE customer_id='$userId'
            LIMIT 1";
    $orderDetail = executeResult($sql);
    if($orderDetail[0]["method_pay"] == 1 ){
      $sql = "SELECT * 
              FROM creditcard
              WHERE creditcard.customer_id='$userId'";
      $creditCard = executeResult($sql,true);
    }
    
?>
<div class="row" style="margin: 90px auto 0;width:50%">
    <div class="col-md-12 table-responsive">
        <h3> Quản lý thông tin thanh toán</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 style="color: red;"></h5>
            </div>
            <div class="panel-body">
                <form method="post" action="user/updateInfoUser.php">
                    
                    <div class="form-group">
                        <label for="email">Họ và Tên</label>
                        <input required="true" type="text" class="form-control" id="fullname" name="fullname"
                            value="<?=$orderDetail[0]["fullname"]?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Số điện thoại</label>
                        <input required="true" type="phone" class="form-control" id="phone" name="phone"
                            value="<?=$orderDetail[0]["phone"]?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ</label>
                        <input required="true" type="text" class="form-control" id="address" name="address"
                            value="<?=$orderDetail[0]["address"]?>">
                        <input type="text" name="id" value="<?=$user["id"]?>" hidden="true">
                    </div>
                <?php
                  if(isset($creditCard)){
                    echo '<div class="form-group">
                          <label for="usr">Tên ngân hàng</label>
                          <input required="true" type="text" class="form-control" id="bank_name" name="bank_name" value="'.$creditCard[0]["bank_name"].'">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Tên chi nhánh</label>
                            <input required="true" type="text" class="form-control" id="branch_bank" name="branch_bank"
                                value="'.$creditCard[0]["branch_bank"].'">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Mã số thẻ</label>
                            <input required="true" type="text" class="form-control" id="seri" name="seri"
                                value="'.$creditCard[0]["seri"].'">
                        </div>';
                    }
                ?>
                    
                    <button name="btnUpdateCustomer" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>
