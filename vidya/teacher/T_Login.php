<!DOCTYPE html>
<html>

<head>
    <title>Teacher Login</title>
    <link rel="stylesheet" href="css/t_login2.css">
</head>

<body>
    <div id="" name="" class="cont">
        <div class="f_box">
            <form action="" method="POST">
                <h1>Teacher Login</h1>
                <br>
                <input type="email" name="tc_email" value="" placeholder="Enter Teacher Email">
                <br><br>
                <input type="Password" name="tc_pass" value="" placeholder="Enter Teacher Password">
                <br><br>
                <div class="btn">
                    <input type="submit" value="Login" name="login">
                    <input type="submit" value="Sign up" name="sign_up">
                </div>
                <input type="submit" value="student" name="student" class="btn">
                Ferget password <a href="reset.php">reset</a>

            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST["sign_up"])) //code for sign up button
{
    header("location:teacher_reg.php");
}

if (isset($_POST["student"])) //code for sign up button
{
    header("location:http://localhost/vidya/student/S_Login.php");
}

if (isset($_POST["login"])) {
    $email = $_POST["tc_email"];
    $pass = $_POST['tc_pass'];

    $con = mysqli_connect("localhost", "root", "", "vidya");

    $query = "SELECT email,password,verification FROM teacher WHERE email='$email';";

    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire); //fetches raw in associtive array

    if (mysqli_num_rows($fire) != 0) // chakes if there any row is selected is now throws an error
    {
        if ($pass == $row["password"]) {
            if($row["verification"]==1)
            {
                $exp = time() + 60 * 60 * 24 * 30;
                setcookie("tlogin", $email, $exp);
                echo "<script>alert('login successfull')</script>";
                header("location:index.php");
            }
            else
            {
                echo "<script>alert('Your account is under verification please try again after some time')</script>";
            }
            
        } else {
            echo "<script>alert('bad credentionals please try again')</script>";
        }
    } else {
        echo "<script>alert('no such account exist please sign up')</script>";
    }
}



?>