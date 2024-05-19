<?php
    session_start();
    echo "<script>alert('verification done.')</script>";
    if (!isset($_SESSION["email"])) {
        echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/st_create.css">
    <title>create profile</title>
</head>
<body>
    <div class="cont">
        <div class="f_box">
        <form action="" method="post" enctype="multipart/form-data">
        <h1>before geting started lets create your profile first</h1><br>

        <label>select your gender</label>
        <select name="gender">
            <option>---select---</option>
            <option value="male">male</option>
            <option value="female">female</option>
            <option value="pns">preafer not to say</option>
        </select><br><br>

        <!-- <label></label>/ -->
        <input type="number" name="age" id="" placeholder="enter your age"><br><br>

        <!-- <label></label> -->
        <input type="number" name="location" placeholder="enter your location PIN code"><br><br>

        <label>select your class:</label>
        <select name="std" >
            <option>---select---</option>
            <option value="std1">STD 1</option>
            <option value="std2">STD 2</option>
            <option value="std3">STD 3</option>
            <option value="std4">STD 4</option>
            <option value="std5">STD 5</option>
            <option value="std6">STD 6</option>
            <option value="std7">STD 7</option>
            <option value="std8">STD 8</option>
            <option value="std9">STD 9</option>
            <option value="std10">STD 10</option>
            <option value="std11">STD 11</option>
            <option value="std12">STD 12</option>
            <option value="fy">FY</option>
            <option value="sy">SY</option>
            <option value="ty">TY</option>
            <option value="4y">4Y</option>
            <option value="other">other</option>
        </select><br><br>

        <label for="">Choose a profile picture:  </label> 
        <input type="file" name="profile" id=""><br><br>

        <input type="submit" name="create" id="">
    </form>
        </div>
    </div>
    
</body>
</html>

<?php
    function uplode()
    {
        $file=$_FILES["profile"];
        $file_name=$_FILES["profile"]["name"];
        $file_tmp_name=$_FILES["profile"]["tmp_name"];
        $file_size=$_FILES["profile"]["size"];
        $file_error=$_FILES["profile"]["error"];
        $file_type=$_FILES["profile"]["type"];
        $file_get_ex=explode('.',$file_name);
        $file_ex=strtolower(end($file_get_ex));
        $allowed_ex=array('png','jpg','jpeg');

        if(in_array($file_ex,$allowed_ex))//this will chack if the file formate is alloud or not
        {
            if($file_error==0)
            {
                if($file_size < 5242880)//5242880 byts = 5mb
                {
                    $file_new_name=uniqid('',true).".".$file_ex;
                    $file_destination="C:/wamp64/www/vidya/student/pro_pic/" . $file_new_name;

                    move_uploaded_file($file_tmp_name,$file_destination);
                    return $file_new_name;
                }
                else
                {
                    echo "<script>alert('this is too large file.')</script>";
                }
            }
            else
            {
                echo "<script>alert('there is a error in file uplode please try again.')</script>";
            }
        }
        else
        {
            echo "<script>alert('this file type is not allowed please enter a valid file type.')</script>";
        }

    }


    if(isset($_POST['create']))
    {
        // if(isset($_COOKIE["login"]))
        // {
        //     $exp=time()+60*60*24*30;
        //     setcookie("location",$loc,$exp);
        // }

        //database connection 
        $con=mysqli_connect("localhost","root","","vidya");

        if(!$con)
        {
            echo "<script>alert('theare is a problame in database connection')</script>";
            header("location: student_reg.php ");
        }

        $std=$_POST['std'];         //standerd of student
        $gender=$_POST['gender'];
        $age=$_POST['age'];
        $loc=$_POST['location'];    //location
        $email=$_SESSION["email"];
        $profile=Uplode();
        $update="UPDATE student SET std='$std', gender='$gender',location='$loc',age='$age',profile='$profile' WHERE email='$email';";

        $fire=mysqli_query($con,$update);
        
        // or die(mysqli_error($con))

        if ($fire) 
        {
            echo "<script>alert('account created successfully')</script>";
            header("location:index.php");
        }
        else
        {
            echo mysqli_error($con);
        }

        
    }
?>