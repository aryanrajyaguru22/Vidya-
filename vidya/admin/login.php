<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/ad_login.css">
</head>

<body>
    <div id="" name="" class="cont">
        <div class="f_box">
            <form action="" method="POST">
                <h1>Admin Login</h1>
                <br>
                <input type="email" name="ad_email" value="" placeholder="Enter admin Email">
                <br><br>
                <input type="Password" name="ad_pass" value="" placeholder="Enter admin Password">
                <br><br>
                <input type="submit" value="login" name="login">
            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST["login"])) {
    $email = $_POST["ad_email"];
    $pass = $_POST['ad_pass'];

    $con = mysqli_connect("localhost", "root", "", "vidya");

    $query = "SELECT email,password,name FROM admin WHERE email='$email';";

    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire); //fetches raw in associtive array
    if ($fire) {
        mysqli_error($con);
    }

    if (mysqli_num_rows($fire) != 0) // chakes if there any row is selected is now throws an error
    {
        $email = $row["email"];
        setcookie("adlogin", $email);
        if ($row["name"] == null) {
            if($pass == $row["password"])
            {
                header("location:create_admin_profile.php");
            }
            else
            {
                echo "<script>alert('Please enter one time password which is send via a email from offical vidya email hendal.')</script>";
            }
        } 
        else {
            if ($pass == $row["password"]) {
                echo "<script>alert('login successfull')</script>";
                header("location:index.php");
            } else {
                echo "<script>alert('Please try again');</script>";
            }
        }
    }
    else {
        echo "<script>alert('no such account exist please sign up')</script>";
    }
}



?>