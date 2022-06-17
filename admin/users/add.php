<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php  ?>
<?php
    $baseUrl = '../';
    $title = "Edit Admin";
    require $baseUrl.'connect.php';
    $name = $username = $email = $password = $repass = "";
    $name_old = $username_old = $email_old = $password_old = $repass_old = "";
    $nameErr = $usernameErr = $emailErr = $passwordErr = $repassErr = "";
    $alert = "";

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        if(empty($_POST['name'])) {
            $nameErr = "Tên không được để trống";
            $name_old = $_POST['name'];
        } else {
            $name = check_input($_POST['name']);
        }
        
        if(empty($_POST['email'])) {
            $emailErr = "Email không được để trống";
            $email_old = $_POST['email'];
        } else {
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            while($row = $result->fetch_array()) {
                if($_POST['email'] == $row['email']) {
                    $emailErr = "Email này đã tồn tại";
                    $email_old = $_POST['email'];
                }
            }
            $email = check_input($_POST['email']);
        }
        
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
        if(empty($_POST['username'])) {
            $usernameErr = "Tên đăng nhập không được để trống";
            $username_old = $_POST['username'];
        } else {
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            while($row = $result->fetch_array()) {
                if($_POST['username'] == $row['tendangnhap']) {
                    $usernameErr = "Username này đã tồn tại";
                    $username_old = $_POST['username'];
                }
            }
            $username = check_input($_POST['username']);
        }
        
        if($nameErr == "" && $usernameErr == "" && $emailErr == "" && $passwordErr == "" && $repassErr == "") {
            $sql = "INSERT INTO users(hoten,tendangnhap,email,matkhau) VALUES ('".$name."','".$username."','".$email."','".$password."')";
            if(mysqli_query($conn, $sql)) {
                $alert = "Thêm thành công!";
                echo "
                <script>
                    setTimeout(function(){
                        location.href ='index.php';
                    }, 1000);
                </script>";
            } else {
                echo "Error: " .$sql."<br>".mysqli_error($conn);
            }
        
            mysqli_close($conn);
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

<?php require_once $baseUrl.'elements/header.php'; ?>
    <!-- Begin Page Content -->               
    <div style="width: 400px; margin-left: 200px;">
        <?php
                if($alert != "") {
                    echo ' <div class="alert alert-success" role="alert">
                                '.$alert.'
                        </div>';
                }
            ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Họ tên</label>
                <input type="text" class="form-control" 
                                    name="name" 
                                    id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" 
                                    placeholder="Nhập họ tên"
                                    value="<?php if($name_old == "") echo $name; else echo $name_old; ?>"
                                    >
                <small id="emailHelp" class="form-text text-muted input-status"><?php echo $nameErr; ?></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên đăng nhập</label>
                <input type="text" class="form-control" 
                                    name="username" 
                                    id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" 
                                    placeholder="Nhập tên đăng nhập"
                                    value="<?php if($username_old == "") echo $username; else echo $username_old; ?>"
                                    >
                <small id="emailHelp" class="form-text text-muted input-status"><?php echo $usernameErr; ?></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" 
                                    name="email" id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" 
                                    placeholder="Nhập địa chỉ email"
                                    value="<?php if($email_old == "") echo $email; else echo $email_old; ?>"
                                    >
                <small id="emailHelp" class="form-text text-muted input-status"><?php echo $emailErr; ?></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu</label>
                <input type="password" class="form-control" 
                                        name="password" 
                                        id="exampleInputPassword1" 
                                        placeholder="Nhập mật khẩu"
                                        value="<?php if($password_old == "") echo $password; else echo $password_old; ?>"
                                        >
                <small id="emailHelp" class="form-text text-muted input-status"><?php echo $passwordErr; ?></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="repass" id="exampleInputPassword1" placeholder="Nhập lại mật khẩu">
                <small id="emailHelp" class="form-text text-muted input-status"><?php echo $repassErr; ?></small>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php require_once $baseUrl.'elements/footer.php'; ?>
