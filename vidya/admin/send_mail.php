<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'C:/wamp64/www/vidya/admin/PHPMailer-master/src/Exception.php';
    require 'C:/wamp64/www/vidya/admin/PHPMailer-master/src/PHPMailer.php';
    require 'C:/wamp64/www/vidya/admin/PHPMailer-master/src/SMTP.php';

    $flag=0;

    function send_email($email,$subject,$message,$alert)
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
        if($alert!=0)
        {
            echo "<script>alert('".$alert."')</script>";
        }
        return 1;
    }


?>