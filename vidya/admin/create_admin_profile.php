<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ad_create_pro.css">
    <title>Admin Create Profilr</title>
</head>
<body>
    <div class="cont">
        <div class="f_box">
            <form action="" method="post">
                <h1>Create Profile</h1>
                <!-- <label for="">Name: </label> -->
                <input type="text" name="name" id="" placeholder="Name"><br><br>
                
                <label></label>
                <input type="password" name="pass" id="" placeholder="reate a password"><br><br>
                
                <label></label>
                <input type="password" name="repass" id="" placeholder="Re-enter the password"><br>

                
                <input type="submit" value="submit" name="submit">
            </form>
        </div>
    </div>
</body>
</html>

<?php
    if(array_key_exists("submit",$_POST))
    {
        $pass=$_POST['pass'];
        $repass=$_POST['repass'];
        $name=$_POST["name"];

        if($pass!=$repass)
        {
            echo "<script>alert('password and re entered passwored are not same')</script>";
        }
        $email=$_COOKIE["adlogin"];
        $con=mysqli_connect("localhost","root","","vidya");
        $query="UPDATE admin SET password='$pass',name='$name' WHERE email='$email';";
        $fire=mysqli_query($con,$query);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('please login to access admin page')</script>";
            header("location:login.php");
        }
    }
?>