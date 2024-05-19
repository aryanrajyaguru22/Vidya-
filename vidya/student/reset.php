<?php 
    session_start();
    include "send_mail.php";

    // if (!isset($_SESSION["email"])) {
    //     echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
    //     header("location:student_reg.php");
    // }
    
    function send_otp()
    {
        $otp=rand(100000,999999);
        $_SESSION["otp"]=$otp;
        $email=$_POST["email"];
        $subject="OTP";
        $message="Your vidya verification otp is ".$otp;
        $alert="Otp has sent to you";
        send_email($email,$subject,$message,0);
    }

    function check_email($email)
    {
        $con = mysqli_connect("localhost", "root", "", "vidya");
        $query = "SELECT email FROM student;";
        $fire = mysqli_query($con, $query);
        while($row=mysqli_fetch_assoc($fire))
        {
            if($row["email"]==$email)
            {
                return 1;
            }
        }
    }
    function signup()
    {?>

        <form action="" method="post">
            <label for="">There is no account found with this email please create one </label><a href="student_reg.php">create</a>
            <!-- <input type="submit" value="signup" name="signup"> -->
        </form>

    <?php } 
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="post">
        <div class="cont">
            <div class="f_box">
                <h1>Password Reset</h1>
                <!-- <input type="submit" value="back" name="back"><br><br> -->
                <!-- <label for="">enter your email:</label> -->
                <input type="email" name="email" id="" placeholder="Enter your email"><br><br>
                <input type="number" name="otp" placeholder="Enter OTP">
                <input type="submit" value="Verify" name="veri">
                <input type="submit" value="Send OTP" name="send">
                Remember your password <a href="S_Login.php">back</a><br><br>
            
        <!-- <input type="submit" value="try" name="try"> -->
    </form>
</body>
</html>

<?php

    if(isset($_POST["send"]))
    {
        $_SESSION["email"]=$_POST["email"];
        $flag=check_email($_POST["email"]);
        if($flag==1)
        {
            send_otp();
            $_SESSION["email"]=$_POST["email"];
        }
        else
        {
            signup();
        }

    }
    if(isset($_POST["try"]))
    {
        // check_email($_POST["email"]);
        signup();
    }

    if(isset($_POST["back"]))
    {
        // send_otp();
        header("location:S_Login.php");
        
    }

    if(isset($_POST["veri"]))
    {
        // echo "as";
            $user_otp=$_POST["otp"];
            $sent_otp=$_SESSION["otp"];
            // echo $_SESSION["otp"];f
            if($user_otp==$sent_otp)
            {
                header("location:reset_pass.php");
                // echo "ok";
                // echo $_SESSION["email"];
            }
            else
            {
                echo "<script>alert('wrong otp')</script>";
            }
    }

?>
</div>
</div>