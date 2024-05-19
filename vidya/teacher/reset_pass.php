<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New password</title>
        <link rel="stylesheet" href="css/reset_pass.css">
    </head>
    <body>
        <div class="cont">
            <div class="f_box">
                <form action="" method="post">
                    <!-- <label for="">:</label> -->
                    <input type="password" name="p1" id="" placeholder="Create a new password"><br><br>
                    <!-- <label for="">:</label> -->
                    <input type="password" name="p2" id="" placeholder="Re-enter a new password">
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
            $query = "UPDATE teacher SET password ='$p1' WHERE email='$email';";
            $fire = mysqli_query($con, $query);
            if($fire)
            {
                header("location:T_Login.php");
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    }

?>