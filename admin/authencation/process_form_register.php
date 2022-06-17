<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php
    $name = $username = $email = $password = $repass = "";
    $name_old = $username_old = $email_old = $password_old = $repass_old = "";
    $nameErr = $usernameErr = $emailErr = $passwordErr = $repassErr = "";


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
                echo "<script>alert('Đăng ký thành công!'); location.href = '".$baseUrl."';</script>";
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