<?php

    require_once('src/Exception.php');
    require_once('src/OAuth.php');
    require_once('src/PHPMailer.php');
    require_once('src/POP3.php');
    require_once('src/SMTP.php');

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    class SendMail {
        function send($title, $content, $nTo, $mTo) {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try{
                $mail->SMTPDebug = 2; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
                $mail->isSMTP();  
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $mail->Username = '21ducminh@gmail.com'; // SMTP username
                $mail->Password = 'ffrtpdjgyeugjeys';   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to     

                $mail->setFrom('21ducminh@gmail.com', 'Forgot Password' ); 
                $mail->addAddress($mTo, $nTo); //mail và tên người nhận

                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = $title;
                $mail->Body    = $content;
                $mail->AltBody = '';

                $mail->send();
                return true;
            } catch (Exception $e) {
                echo 'Không thể gửi. Lỗi: ', $mail->ErrorInfo;
            }
        }
    }
    
?>