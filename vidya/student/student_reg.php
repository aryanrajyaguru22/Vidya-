
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student registration</title>
    <link rel="stylesheet" href="css/stu_reg.css">
</head>

<body>
    <div class="cont">
        <div class="f_box">
            <form action="" method="post">
                <h1>Student registration</h1>
                <!-- <label>Enter your full name</label> -->
                <input type="text" name="st_name" placeholder="Full Name"><br><br>

                <!-- <label>Contect number</label> -->
                <input type="number" name="st_con" placeholder="Contact Number" onKeyPress="if(this.value.length==10) return false;"><br><br>

                <!-- <label>Parent's contect info</label> -->
                <input type="number" name="st_pt_con" placeholder="Parent's Contact info" onKeyPress="if(this.value.length==10) return false;" ><br><br>

                <!-- <label>Email</label> -->
                <input type="email" name="st_email" placeholder="abc@mail.com"><br><br>



                <!-- <label>please select a Profile picture</label>
        <input type="file" name="profile_pic" id=""><br><br> -->

                <!-- <label>Create a password</label> -->
                <input type="password" name="pass" id="" placeholder="Password"><br><br>

                <!-- <label>Re-enter the password</label> -->
                <input type="password" name="repass" id="" placeholder="Re-enter password"><br><br>
                <div class="btn">
                    <input type="submit" name="signup" value="Sign up" />
                    <!-- <input type="submit" name="login" value="Login" /> -->
                </div>
                <label for="">Already have an account </label><a href="S_Login.php">Login</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php
session_start();

if (isset($_POST["login"])) {
    header("location:S_Login.php");
    // echo $_FILES["profile_pic"]["name"];
}

if (isset($_POST['signup'])) {
    //for chaking password and re entered password are same or not
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if ($pass != $repass) {
        echo "<script>alert('Password and Re-entered passwored are not same😢')</script>";
    }

    //database connection 
    $con = mysqli_connect("localhost", "root", "", "vidya");

    if (!$con) {
        echo "<script>alert('Theare is a problame in database connection😢')</script>";
        header("location: student_reg.php ");
    }

    $name = $_POST['st_name'];    //student name
    $contact = $_POST['st_con'];      //student contect number
    $p_con = $_POST['st_pt_con'];  //student's parent contect number
    $email = $_POST['st_email'];


    $select_teacher="SELECT email,st_con FROM student;";
    $fire=mysqli_query($con,$select_teacher);

    $flag=1;

    while($row=mysqli_fetch_assoc($fire))
    {
        if($row["email"]==$email)
        {
            echo "<script>alert('this email id is allrady exists plesae try again with another email id')</script>";
            $flag=0;
        }
        if($row["st_con"]==$contact)
        {
            echo "<script>alert('this contact number is allrady exists plesae try again with another contact nimber')</script>";
            $flag=0;
        }
    }

    if($flag==1)
    {
        $insert = "INSERT INTO student (name,st_con,p_st_con,email,password) VALUES ('$name','$contact','$p_con','$email','$pass');";
    
        $fire = mysqli_query($con, $insert);
    
        if ($fire) {
            $_SESSION["email"]=$email;
            // echo "<script>alert('Account created successfully🎉')</script>";
            header("location:verification.php");
        } else {
            echo mysqli_error($con);
        }
    }

}
?>