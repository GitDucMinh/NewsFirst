<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<?php
$email = $password = "";
$emailErr = $passwordErr = "";
$email_old = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = check_input($_POST['email']);
    $password = md5($_POST['password']);
    

    if(empty($_POST['email'])) {
        $emailErr = "Bạn chưa nhập Email";
    } else {
        $query = "SELECT * FROM users WHERE email='$email'";
       
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        
        if(mysqli_num_rows($result) == 0) {
            $emailErr = "Email không tồn tại";
        } else {
            if(empty($_POST['password'])) {
                $passwordErr = "Bạn chưa nhập mật khẩu";
            } else if($password == $row['matkhau']){
                $_SESSION['email'] = $email;
                $_SESSION['hoten'] = $row['hoten'];
                $_SESSION['idUser'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                
                $userId = $row['id'];
                $created_at = date('Y-m-d H:i:s');
                $token = md5($email.time());
                $_SESSION['user'] = $row;
                setcookie('token', $token,time() + 7 * 24 * 60 * 60 ,'/');
                $sql = "insert into tokens (user_id, token, created_at) values ('$userId','$token','$created_at')";
                mysqli_query($conn, $sql);
                
                if(!empty($_POST['remember'])) {
                    setcookie("email",$email,time()+(10*365*24*60*60));
                    setcookie("pass",$_POST['password'],time()+(10*365*24*60*60));
                } else {
                    if(isset($_COOKIE["email"])) {
                        setcookie("email","");
                    }
                    if(isset($_COOKIE["pass"])) {
                        setcookie("pass","");
                    }
                }

                // echo "<script>alert('Đăng nhập thành công!'); location.href = '".$baseUrl."';</script>";
                mysqli_close($conn);
            } else {
                $email_old = $_POST['email'];
                $passwordErr = "Sai mật khẩu";
            }
        
        }
        $email_old = $_POST['email'];
    }
    
}

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>