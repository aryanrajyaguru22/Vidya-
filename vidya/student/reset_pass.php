<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/pass_reset.css">
        <title>Reset Password</title>
    </head>
    <body>
        <div class="cont">
            <div class="f_box">
                <form action="" method="post">
                    <h1>Create a new password</h1>
                    <input type="password" name="p1" id="" placeholder="Create a new password"><br><br>
                    <input type="password" name="p2" id="" placeholder="re enter a new password">
                    <br><br>
                    <input type="submit" value="reset" name="reset">
                </form>
            </div>
        </div>
    </body>
</html>
<?php
session_start();
    // echo $_SESSION["email"];
    if(isset($_POST["reset"]))
    {
        $p1=$_POST["p1"];
        $p2=$_POST["p2"];

        if($p1==$p2)
        {
            $email=$_SESSION["email"];
            $con = mysqli_connect("localhost", "root", "", "vidya");
            $query = "UPDATE student SET password ='$p1' WHERE email='$email';";
            $fire = mysqli_query($con, $query);
            if($fire)
            {
                header("location:S_Login.php");
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    }

?>