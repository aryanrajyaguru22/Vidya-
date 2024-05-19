<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher registration</title>
    <link rel="stylesheet" href="css/t_reg.css">
</head>

<body>
    <div class="cont">
        <div class="f_box">
            <form action="" method="POST">
                <h1>Teacher registration</h1>
                <!-- <label>enter your full name:</label> -->
                <input type="text" name="tc_name" placeholder="Full Name"><br><br>

                <!-- <label>enter your contect number:</label> -->
                <input type="number" name="tc_con" placeholder="Contact Number" onKeyPress="if(this.value.length==10) return false;" ><br><br>

                <!-- <label>enter email: </label> -->
                <input type="email" name="tc_email" placeholder="abc@mail.com"><br><br>

                <!-- <label>create a password</label> -->
                <input type="password" name="tc_pass" id="" placeholder="Password"><br><br>

                <!-- <label>Re-enter the password</label> -->
                <input type="password" name="tc_repass" id="" placeholder="Re-enter Password"><br><br>
                <div class="btn">
                    <input type="submit" name="signup" value="Sign up">
                    <!-- <input type="submit" name="login" value="Login" /> -->
                    <!-- <input type="submit" name="try" value="try" /> -->
                </div>
                <label for="">allrady has a account </label><a href="T_Login">Login</a>
            </form>
        </div>
    </div>
</body>

</html>

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
        return 1;
    }


// if (isset($_POST["login"])) {
//     header("location:T_Login.php");
// }

// if (isset($_POST["try"])) {
//     header("location:teacher_create_profile.php");
// }

if (isset($_POST["signup"])) {

    $con = mysqli_connect("localhost", "root", "", "vidya");


    //for chaking password and re entered password are same or not
    $pass = $_POST['tc_pass'];
    $repass = $_POST['tc_repass'];

    if ($pass != $repass) {
        echo "<script>alert('password and re entered passwored are not same')</script>";
    }
    $name = $_POST['tc_name'];    //teacher name
    $contact = $_POST['tc_con'];      //teacher contect number
    $email = $_POST['tc_email'];

    $select_teacher="SELECT email,tc_con FROM teacher;";
    $fire=mysqli_query($con,$select_teacher);

    $flag=1;

    while($row=mysqli_fetch_assoc($fire))
    {
        if($row["email"]==$email)
        {
            echo "<script>alert('this email id is allrady exists plesae try again with another email id')</script>";
            $flag=0;
        }
        if($row["tc_con"]==$contact)
        {
            echo "<script>alert('this contact number is allrady exists plesae try again with another contact nimber')</script>";
            $flag=0;
        }
    }

    if($flag==1)
    {
        $_SESSION["create_email"]=$email;

        //database connection 
    
        if (!$con) {
            echo "<script>alert('theare is a problame in database connection')</script>";
            // header("location: student_reg.php ");
        }
    
        $insert = "INSERT INTO teacher (name,tc_con,email,password) VALUES ('$name','$contact','$email','$pass')";
    
        $result = mysqli_query($con, $insert);
    
        echo "<script>console.log($result);</script>";
    
        // echo $fire;
        // console.log($result);
        if ($result) {
            echo "<script>alert('account created successfully please enter otp')</script>";
            $flag=send_otp();
            if($flag==1)
            {
                header("location:verification.php");
            }
        } else {
            echo mysqli_error($con);
        }
    }

}
?>