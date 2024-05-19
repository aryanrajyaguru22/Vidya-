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
        $message="your vidya password reset otp is otp is ".$otp;
        send_email($email,$subject,$message);
    }

    function check_email($email)
    {
        $con = mysqli_connect("localhost", "root", "", "vidya");
        $query = "SELECT email FROM teacher;";
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
            <br><label for="">there is no account found with this email please create one </label><a href="student_reg.php">create</a>
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
    <title>Reset password</title>
</head>
<body>
    <div class="cont">
        <div class="f_box">
            <form action="" method="post">
                <h1>Resate Password</h1>
                <!-- <input type="submit" value="back" name="back"><br><br> -->
                <!-- <label for="">:</label> -->
                <input type="email" name="email" id="" placeholder="Enter your email"><br><br>
                <input type="number" name="otp">
                <input type="submit" value="verify" name="veri">
                <input type="submit" value="send otp" name="send">
                Rembered your password <a href="T_Login.php">back</a>
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
                // $_SESSION["email"]=$_POST["email"];
            }
            else
            {
                echo "<script>alert('wrong otp')</script>";
            }
    }
?>
    </div>
</div>