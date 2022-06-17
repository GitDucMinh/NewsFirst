<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php  ?>
<?php
    $title = 'Edit user';
    $baseUrl = '../';
    require $baseUrl.'connect.php';
    $alert = "";
    $query = "SELECT * FROM users WHERE id=".$_GET['id']."";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $emailOrigin = $row['email'];
    $usernameOrigin = $row['tendangnhap'];

    $name = $username = $email = $address = $phone = $gender = $date = "";
    $name_old = $username_old = $email_old = $address_old = $phone_old = $gender_old = $date_old = "";
    $nameErr = $usernameErr = $emailErr = $addressErr = $phoneErr = $genderErr = $dateErr = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $id = $_GET['id'];
        if(empty($_POST['name'])) {
            $nameErr = "Tên không được để trống";
            $name_old = $_POST['name'];
        } else {
            $name = $name_old = check_input($_POST['name']);
        }
        
        if(empty($_POST['email'])) {
            $emailErr = "Email không được để trống";
            $email_old = $_POST['email'];
        } else {
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            while($row = $result->fetch_array()) {
                if($_POST['email'] == $row['email'] && $id != $row['id']) {
                    $emailErr = "Email này đã tồn tại";
                    $email_old = $_POST['email'];
                }
            }
            $email = check_input($_POST['email']);
        }

        $address = check_input($_POST['address']);

        if(strlen($_POST['phone']) > 10) {
            $phoneErr = 'Bạn nhập sai số điện thoại hoặc quá kí tự cho phép';
            $phone_old = $_POST['phone'];
        } else {
            $phone = $phone_old = check_input($_POST['phone']);
        }

        if(check_input($_POST['date']) == "") {
            $date = "1900-01-01"; // Giá trị ngày tháng năm mặc định nếu người dùng không nhập ngày tháng năm!
        } else {
            $date = check_input($_POST['date']);
        }

        $gender = $_POST['gender'];
        $gender_old = $gender;
        
        if($nameErr == "" && $emailErr == "" && $addressErr == "" && $phoneErr == "" && $dateErr == "") {
            $qr = "UPDATE users SET hoten = '$name', email = '$email', diachi = '$address', dienthoai = '$phone', ngaysinh = '$date', gioitinh = '$gender' WHERE  id = $id";
            $edit = mysqli_query($conn, $qr);

            if(!$edit) {
                $alert = false;
            } else {
                $alert = true;
                echo "
                <script>
                    setTimeout(function(){
                        location.href ='index.php';
                    }, 1000);
                </script>";
            }
            mysqli_close($conn);
        }
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<?php require_once $baseUrl.'elements/header.php'; ?>

<!-- Begin Page Content -->        
<div style="width: 500px; margin-left: 200px;">
    <?php
        if(isset($_POST['submit'])) {
            if($alert == true) {
                echo ' <div class="alert alert-success" role="alert">
                            Cập nhật thành công!
                    </div>';
            } else {
                echo ' <div class="alert alert-danger" role="alert">
                            Cập nhật thất bại!
                    </div>';
            }
        }
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Họ tên</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Nhập họ tên"
                value="<?php if($name_old != "") echo $name_old; else echo $row['hoten']; ?>">
            <small id="emailHelp" class="form-text text-danger input-status">
            <?php 
                echo $nameErr; 
            ?>
        </small> 
        </div>
        <div class="form-group">
            <label class="text-dark" for="exampleInputUsername">Tên đăng nhập</label> <br>
            <input type="text" class="form-control" name="username" id="exampleInputUsername"
                aria-describedby="UsernameHelp" placeholder="Nhập tên đăng nhập"
                value="<?php echo $usernameOrigin; ?>" disabled>
            <small id="emailHelp" class="form-text text-danger input-status">
            <?php 
                echo $usernameErr; 
            ?></small>
        </div>
        <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Nhập địa chỉ email"
                value="<?php if($email != "") echo $email; else echo $row['email']; ?>">
            <small id="emailHelp" class="form-text text-danger input-status">
                <?php 
                    echo $emailErr; 
                ?>
            </small> 
        </div>

        <div class="form-group">
            <label class="text-dark" for="exampleInputAddress">Địa chỉ</label>
            <input type="text" class="form-control" name="address" id="exampleInputAddress"
                aria-describedby="AddressHelp" placeholder="Ví dụ: 160 Nguyễn Hoàng, Vĩnh Trung, Thanh Khê, Đà Nẵng"
                value="<?php if($address != "") echo $row['diachi']; else echo $address; ?>">
            <small id="emailHelp" class="form-text text-danger input-status">
            <?php 
                echo $addressErr; 
            ?>
        </small>
        </div>

        <div class="form-group">
            <label class="text-dark" for="exampleInputPhone">SĐT</label> 
            <input type="text" class="form-control" name="phone" id="exampleInputPhone"
                aria-describedby="PhoneHelp" placeholder="Nhập số điện thoại"
                value="<?php if($phone != "") echo $row['dienthoai']; else echo $phone; ?>">
            <small id="emailHelp" class="form-text text-danger input-status">
            <?php 
                echo $phoneErr; 
            ?>
        </small>
        </div> 
        <div class="form-group">
            <label class="text-dark" for="date">Ngày sinh</label>
            <input type="text" class="form-control" name="date" id="datepicker" aria-describedby="date"
            value="">
            <small id="emailHelp" class="form-text text-danger input-status">
                <?php echo $dateErr;?>  
            </small> 
        </div>
        <div class="form-group">
            <label class="text-dark" for="datepicker">Giới tính: </label>
            <input type="radio" name="gender" id="" value="0" <?php if(isset($row['gioitinh']) && $row['gioitinh'] == 0) echo 'checked'; else if($gender_old == 0) echo 'checked'; ?>> Nam
            <input type="radio" class="ml-2" name="gender" id="" value="1" <?php if(isset($row['gioitinh']) && $row['gioitinh'] == 1) echo 'checked'; else if($gender_old == 1) echo 'checked'; ?>> Nữ
            <input type="radio" class="ml-2" name="gender" id="" value="2" <?php if(isset($row['gioitinh']) && $row['gioitinh'] == 2) echo 'checked'; else if($gender_old == 2) echo 'checked'; ?>> Khác
            <small id="emailHelp" class="form-text text-danger input-status">
                <?php echo $genderErr;?>  
            </small> 
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>


<?php require_once $baseUrl.'elements/footer.php'; ?>