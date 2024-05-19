<!DOCTYPE html>
<html>

<head>
    <title>Student Login</title>
    <link href="css/S_Login_style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="" name="" class="Cont">
        <div class="f_box">
            <form action="" method="POST">
                <h1>Student Login</h1>
                <br>
                <input type="email" name="student_email" value="" placeholder="Enter Student Email">
                <br><br>
                <input type="Password" name="student_password" value="" placeholder="Enter Student Password">
                <br><br>
                <div class="btn">
                    <input type="submit" value="Login" name="login">
                    <input type="submit" value="Sign up" name="sign_up">
                </div>
                <input type="submit" value="Teacher" name="teacher" class="btn2">
            </form>
            <span style="color: black;">Forget password <a href="reset.php">reset</a></span>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST["sign_up"])) //code for sign up button
{
    header("location:student_reg.php");
}


if (isset($_POST["teacher"])) //code for sign up button
{
    header("location:http://localhost/vidya/teacher/T_Login.php");
    
}

if (isset($_POST["login"])) {
    $email = $_POST["student_email"];
    $pass = $_POST['student_password'];

    $con = mysqli_connect("localhost", "root", "", "vidya");
    $query = "SELECT email,password,age,std FROM student WHERE email='$email';";
    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire); //fetches raw in associtive array

    if (mysqli_num_rows($fire) != 0) // chakes if there any row is selected is now throws an error
    {
        // print_r($row);
        echo ($row["age"] == null);
        if ($pass == $row["password"]) {
            $exp = time() + 60 * 60 * 24 * 30;
            setcookie("login", $email, $exp);
            if ($row["age"] == NULL) {
                header("location:student_create_profile.php");
            } else {
                echo "<script>alert('login successfull')</script>";
                header("location:index.php");
            }
        } else {
            echo "<script>alert('bad credentionals please try again')</script>";
        }
    } else {
        echo "<script>alert('no such account exist please sign up')</script>";
    }
}



?>