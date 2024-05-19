<?php 
    session_start();
    include "send_mail.php";

    if (!isset($_SESSION["email"])) {
        echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
        header("location:student_reg.php");
    }
    
    function send_otp()
    {
        $otp=rand(100000,999999);
        $_SESSION["otp"]=$otp;
        $email=$_SESSION["email"];
        $subject="OTP";
        $message="your vidya verification otp is ".$otp;
        $alert="verification ot has been send ";
        send_email($email,$subject,$message,$alert);
    }
    // send_otp();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/veri.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div class="cont">
            <div class="f_box">
                <h1>Verification</h1>
                <input type="number" name="otp">
                <input type="submit" value="verify" name="veri">
                <input type="submit" value="send otp" name="send">
                want to chang email <a href="student_reg.php">back</a>
            </div>
        </div>
    </form>
</body>
</html>

<?php

    if(isset($_POST["send"]))
    {
        send_otp();
    }

    if(isset($_POST["veri"]))
    {
        // echo "as";
        $user_otp=$_POST["otp"];
        $sent_otp=$_SESSION["otp"];
        // echo $_SESSION["otp"];f
        if($user_otp==$sent_otp)
        {
            header("location:student_create_profile.php");
        }
        else
        {
            echo "<script>alert('wrong otp')</script>";
        }
    }

?>