<?php
    require_once "../header.php";

    if(isset($_POST["btnUpdateCustomer"])){
        $name = getPost('name');
        $email = getPost('email');
        $address = getPost('address');
        $phone = getPost('phone');
        $password = getPost('password');
        $id = getPost('id');
        echo $name;
        if($password){
          $password = getSecurityMD5($password);
          $sql = "UPDATE `customer` 
                    SET `email`='$email',`address`='$address',`name`='$name',`password`='$password',`phone`='$phone'
                    WHERE id='$id'";
        }
        else $sql = "UPDATE `customer` 
                    SET `email`='$email',`address`='$address',`name`='$name',`phone`='$phone'
                    WHERE id='$id'";
        execute($sql);

        //get userInfo
        $sql = "select * from customer where id='$id'";
        $user = executeResult($sql,true);
    }
?>

<div class="row" style="margin: 90px auto 0;width:50%">
    <div class="col-md-12 table-responsive">
        <h3> Quản lý tài khoản</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 style="color: red;"></h5>
            </div>
            <div class="panel-body">
                <form method="post" action="user/updateInfoUser.php">
                    <div class="form-group">
                        <label for="usr">Họ & Tên:</label>
                        <input required="true" type="text" class="form-control" id="usr" name="name" value="<?=$user["name"]?>">
                        <input type="text" name="id" value="<?=$user["id"]?>" hidden="true">
                        <input type="text" name="role_id" value="<?=$user["role_id"]?>" hidden="true">
                        <input type="text" name="updateInfoUser" value="1" hidden="true">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input required="true" type="email" class="form-control" id="email" name="email"
                            value="<?=$user["email"]?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">SĐT:</label>
                        <input required="true" type="tel" class="form-control" id="phone_number" name="phone"
                            value="<?=$user["phone"]?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ:</label>
                        <input required="true" type="text" class="form-control" id="address" name="address"
                            value="<?=$user["address"]?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật Khẩu:</label>
                        <input type="password" class="form-control" id="pwd" name="password" minlength="6">
                    </div>
                    <button name="btnUpdateCustomer" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
  require_once "../footer.php";
?>