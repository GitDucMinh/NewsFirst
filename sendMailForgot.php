<?php
session_start();
require_once('admin/connect.php');
require_once('PHPMailer-master/SendMail.php');
require_once('function.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = '';
    $email = '';
    //Kiem tra email co ton tai va dung dinh dang
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        $errors = "email";
    }

    if(empty($_POST['email'])) {
        $_SESSION['errors'] = 'Hãy nhập email của bạn';
        header('Location: forgotPassword.php');
        exit();
    }

    if(!empty($errors)) {
        $_SESSION['errors'] = 'Email của bạn không tồn tại';
        header('Location: forgotPassword.php');
        exit();
    }

    if(empty($errors) && !empty($email)) {
        $sql = "SELECT * FROM users WHERE email = '".$email."'";
        $result = mysqli_query($conn, $sql);
        $account = mysqli_fetch_assoc($result);

        if(empty($account)) {
            $_SESSION['errors'] = 'mail của bạn không tồn tại';
            header('Location: forgotPassword.php');
            exit();
        }
    }

    $randPassword = rand_string(8);
    $title = 'Cập nhật mật khẩu';
    $content = "<h3>Chào: ".$account['hoten']."</h3>";
    $content .= "<p>Chúng tôi nhận được yêu cầu cấp lại mật khẩu của bạn.</p>";
    $content .= "<p>Chúng tôi đã cập nhật và gửi bạn mật khẩu mới.</p>";
    $content .= "<p>Mật khẩu mới của bạn là: <strong>".$randPassword."</strong></p>";

    $sendMail = SendMail::send($title, $content, $account['hoten'], $account['email']);

    if($sendMail) {
        $password = md5($randPassword);
        $id = $account['id'];
        $sqlUpdate = "UPDATE users SET matkhau = '$password' WHERE id = $id";
        if(mysqli_query($conn, $sqlUpdate)) {
            $_SESSION['success'] = 'Chúng tôi đã gửi cho bạn một email, hãy kiểm tra nó';
            header('Location: forgotPassword.php');
        } else {
            $_SESSION['errors'] = 'Lỗi update CSDL';
            header('Location: forgotPassword.php');
            exit();
        }
        
    } else {
        $_SESSION['errors'] = 'Đã có lỗi xảy ra khi bạn yêu cầu cấp mật khẩu';
        header('Location: forgotPassword.php');
        exit();
    }

}

?>