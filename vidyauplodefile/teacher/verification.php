<?php 
    session_start();
    include "send_mail.php";
    
    function send_otp()
    {
        $otp=rand(100000,999999);
        $_SESSION["otp"]=$otp;
        $email=$_SESSION["create_email"];
        $subject="OTP";
        $message="your vidya verification otp is ".$otp;
        send_email($email,$subject,$message);
    }
    // send_otp();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/veri2.css">
    
</head>
<body>
    <form action="" method="post" >
        <div class="cont">
            <div class="f_box">
                <h1>Verification</h1>
                <input type="number" name="otp"><br>
                <input type="submit" value="verify" name="veri">
                <input type="submit" value="Re-send otp" name="send">
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
        // echo $_SESSION["otp"];
        if($user_otp==$sent_otp)
        {
            header("location:teacher_create_profile.php");
        }
        else
        {   
            echo "<script>alert('please try again')</script>";
        }
    }

?>