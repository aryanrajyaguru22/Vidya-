<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // require '/teacher/PHPMailer-master/src/Exception.php';
    // require '/teacher/PHPMailer-master/src/PHPMailer.php';
    // require '/teacher/PHPMailer-master/src/SMTP.php';
    require 'teacher/PHPMailer-master/src/Exception.php';
    require 'teacher/PHPMailer-master/src/PHPMailer.php';
    require 'teacher/PHPMailer-master/src/SMTP.php';

    function send_email($email,$subject,$message)
    {
        $mail= new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='vidya.gmit@gmail.com';// mail
        $mail->Password='uwrxrdoyqcrbgecb';//gmail app password
        $mail->SMTPSecure='ssl';
        $mail->Port=465;
    
        $mail->setFrom('vidya.gmit@gmail.com');
    
        $mail->addAddress($email);//$email stores the mail where otp should send  
        $mail->isHTML(true);
        $mail->Subject=$subject;//$subject is subject of email
        $mail->Body=$message;//$message is the message of subject
    
        $mail->send();
        echo "<script>alert('mail sent seccessfully')</script>";
        
    }


?>