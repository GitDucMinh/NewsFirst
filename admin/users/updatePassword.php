<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php 
    $baseUrl = '../';
    $title = "Quản lý người dùng";
    require $baseUrl.'connect.php'; 

    $passwordErr = $repassErr ='';
    $password_old = $repass_old = '';
    $password = $repass = '';
    $id = $_GET['id'];
    if(isset($_POST['btn'])) {
        if(isset($_GET['id'])) {
            if(empty($_POST['password'])) {
                $passwordErr = "Mật khẩu không được để trống";
                $password_old = $_POST['password'];
            } else {
                if(!check_pass($_POST['password'])) {
                    $passwordErr = 'Mật khẩu phải > 8 kí tự, trong đó có ít nhất 1 kí tự hoa, 1 chữ số, 1 kí tự đặc biệt';
                    $password_old = $_POST['password'];
                } else {
                    $password = check_input($_POST['password']);
                    $password = md5($password);
                }  
            }
        
            if(empty($_POST['repass'])) {
                $repassErr = "Mật khẩu không trùng khớp";
                $repass_old = $_POST['repass'];
            } else {
                if($password != md5($_POST['repass'])) {
                    $repassErr = "Mật khẩu không trùng khớp";
                    $repass_old = $_POST['repass'];
                }
                $repass = check_input($_POST['repass']);
            }
            $id = $_GET['id'];
            if($passwordErr == '') {
                $sql = "UPDATE users SET matkhau = '$password' WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo "
                    <script>
                        setTimeout(function(){
                            location.href ='UserEdit.php?id=".$id."';
                        }, 1000);
                    </script>";
                } else {
                    echo "Error: " .$sql."<br>".mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
    } 
      
    function check_pass($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
    
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        }
        else {
            return true;
        }
     }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php
    require_once $baseUrl.'elements/header.php';
?>
<div style="width: 400px; margin-left: 200px;">
        <form action="updatePassword.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="pass">Nhập mật khẩu mới</label>
                <input  type="password" class="form-control" 
                        name="password" 
                        id="pass" 
                        value="<?php if($password_old == "") echo $password; else echo $password_old; ?>"
                        >
                        <p class="text-danger"><?php echo $passwordErr; ?></p>
            </div>
            <div class="form-group">
                <label for="repass">Nhập lại mật khẩu</label>
                <input  type="password" class="form-control" 
                        name="repass" 
                        id="repass" 
                        value="<?php if($password_old == "") echo $password; else echo $password_old; ?>"
                        >
                        <p class="text-danger"><?php echo $passwordErr; ?></p>
            </div>
            <button type="submit" name="btn" class="btn btn-primary">Submit</button>
        </form>
</div>
<?php
require_once $baseUrl.'elements/footer.php';
?>