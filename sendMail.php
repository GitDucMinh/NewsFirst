<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

if(isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // $name = 'Minh';
    // $email = 'congminhsp2k@gmail.com';
    // $subject = 'tieu de';
    // $content = '<p>Test cho toi</p>';

    require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions

    $mail->SMTPDebug = 0; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
    $mail->isSMTP();  
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = '21ducminh@gmail.com'; // SMTP username
    $mail->Password = 'ffrtpdjgyeugjeys';   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom($email, 'Contact' ); 
    $mail->addAddress('21ducminh@gmail.com', 'Contact'); //mail và tên người nhận  
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $content;

    if($mail->send()) {
        $status = "success";
        $response = "Gửi thành công!";
    } else {
        $status = 'failed';
        $response = 'Đã xảy ra lỗi: <br>' .$mail->ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>

