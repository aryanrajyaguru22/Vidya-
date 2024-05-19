<?php
    if (!isset($_COOKIE["login"])) {
        echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    }

    $emailc=$_COOKIE["login"];
    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM student WHERE email='$emailc';";
    $fire=mysqli_query($con,$query);

    $row=mysqli_fetch_assoc($fire);//fetches raw in associtive array

    function checkstd($std)//checks standerd
    {
        global $row;
        if($std==$row["std"])
        {
            echo "selected";
        }
    }

    function delete()//deletes profile
    {
        global $emailc,$con,$row;

        $delete="DELETE FROM student WHERE email='$emailc';";
        $fire_delete=mysqli_query($con,$delete);
        if(!$fire_delete)
        {
            echo mysqli_error($con);
        }

        $de_img=$row["profile"];
        $depath="C:/wamp64/www/vidya/student/pro_pic/". $de_img;
        unlink($depath);

    }
?>

<html>
    <head>
        <link rel="stylesheet" href="css/student_edit_profile.css">
        <title>Edit Profile</title>
    </head>

    <style>
    ul {
  list-style-type: none;
  margin: 0;
  padding: 2px;
  margin-left: -0.5%;
  margin-right: -0.45%;
  margin-top: -0.5%;
  overflow: hidden;
  background-color: #333;
  position: sticky;
  top: 0;
  font-family: Arial, Helvetica, sans-serif;
}

li {
  float: left;
  /* border-right: 1px solid #bbb; */
  text-transform: uppercase;
  font-size: 0.88rem;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li:last-child {
  border-right: none;
}


/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}
.logout
{
    background-color: red;
    float:right;
}
footer {
    text-align: center;
    padding-top: 10px;
    background-color: #333333;
    color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 40px;
    margin-left: -8px;
    /* padding-left: -10px; */
    text-align: center;  
    padding-bottom: 10px;
    /* Height of the footer */
}
.img
{
    /* align: right */
    margin-right: 50px;
    margin-bottom: 10px;
}
.make{
    float: left;
    padding-left: 10px;
    padding-top: 8px;
    font-size: 1.0rem;
}
.cc
{
    font-size: 1.0rem;
    padding-right: 5%;
}
</style>

    <body>
        <div class="cont">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li class="active"><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>

        </ul>
        <div class="f_box">

        <form action="" method="post" enctype="multipart/form-data">
    <!-- NOTE:  do not add required in this form  -->
            <label for="">Name:</label><br>  
            <input type="text" name="name" id="" value="<?php echo $row["name"]; ?>">
            <br><br>

            <!-- <label for="">email:</label>
            <input type="text" name="email" id="">
            <br><br> -->

            <label>Select your class:</label><br>
        <select name="std" >
            <option>---select---</option>
            <?php $i=1; while($i<13){ ?>
            <option value="std<?php echo $i;?>"  <?php checkstd("std".$i);?>>STD <?php echo $i;?></option>
            <?php $i++;} ?>
            <option value="fy" <?php checkstd("fy");?>>FY</option>
            <option value="sy" <?php checkstd("sy");?>>SY</option>
            <option value="ty" <?php checkstd("ty");?>>TY</option>
            <option value="4y" <?php checkstd("4y");?>>4Y</option> 
                
        </select><br><br>

            <label for="">Your number:</label><br>
            <input type="number" name="st_con" value="<?php echo $row["st_con"]; ?>">
            <br><br>

            <label for="">Perent's number:</label><br>
            <input type="number" name="p_number" value="<?php echo $row["p_st_con"]; ?>">
            <br><br>

            <label for="">location pin code:</label><br>
            <input type="text" name="location" value="<?php echo $row["location"];?>">
            <br><br>

            <label for="">Change DP:</label><br>
            <input type="file" name="profile" id="">
            <!-- <input type="submit" value="uplode" name="add"><br> -->
            <br><br>
            <label for="">Password:</label>
            <br>
            <input type="text" name="password" id="" >
            <br><br>
            <input type="submit" value="Update" name="update">
            <!-- <input type="submit" value="profile" name="profile"> -->
            <input type="submit" name="delete" value="Delete" style="background-color: red;">

        </form>
        </div>  
        </div>
    </body>
</html>

<?php     

    

    function uplode()//uplodes profilepicture
    {

        $emailc=$_COOKIE["login"];
        $con1=mysqli_connect("localhost","root","","vidya");
        $query="SELECT * FROM student WHERE email='$emailc';";
        $fire=mysqli_query($con1,$query);

        $row=mysqli_fetch_assoc($fire);

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
                if($file_size < 2097152)//5242880 byts = 2mb
                {
                    $file_new_name=uniqid('',true).".".$file_ex;
                    $file_destination="C:/wamp64/www/vidya/student/pro_pic/". $file_new_name;

                    move_uploaded_file($file_tmp_name,$file_destination);

                    $de_img=$row["profile"];
                    $depath="C:/wamp64/www/vidya/student/pro_pic/". $de_img;

                    // echo $file_new_name;

                    if(unlink($depath))
                    {
                        // echo "ok";
                        $update1="UPDATE student SET profile='$file_new_name' WHERE email='$emailc';";
                        $fire=mysqli_query($con1,$update1);
                        if(!$fire)
                        {
                            echo mysqli_error($con1);
                        }
                    }
                }
                else
                {
                    echo "<script>alert('This is too large file.')</script>";
                }
            }
            else
            {
                echo "<script>alert('There is a error in file uplode please try again.')</script>";
            }
        }
        else
        {
            echo "<script>alert('This file type is not allowed please enter a valid file type.')</script>";
        }

    }

    if(array_key_exists("delete",$_POST))
    {
        // echo "adsf";
        // header("location:index.php");
        if($row["password"]==$_POST["password"])
        {
            delete();
            include "logout.php";
        }
        else
        {
            echo "<script>alert('Please try again with the write password.')</script>";
        }
    }

    

    if(isset($_POST["add"]))
    {
        if($row["password"]==$_POST["password"])
        {
            uplode();
        }
        else
        {
            echo "<script>alert('Please try again with the write password.')</script>";
        }
    }

    if(array_key_exists("update",$_POST) && ($_POST["password"]==$row["password"]))
    {
        uplode();

        // data from form
        $fname=$_POST["name"];
        $fstd=$_POST["std"];
        $fst_con=$_POST["st_con"];
        $f_p_con=$_POST["p_number"];
        $floacation=$_POST["location"];
        $update="UPDATE student SET name='$fname',st_con='$fst_con',p_st_con='$f_p_con',std='$fstd',location='$floacation' WHERE email='$emailc';";
        $update_fire=mysqli_query($con,$update);
        if(!$update_fire)
        {
            echo mysqli_error($con);
        }
    }
    elseif(array_key_exists("update",$_POST) && ($_POST["password"]!=$row["password"]))
    {
        echo "<script>alert('wrong password')</script>";
    }

    if(array_key_exists("profile",$_POST))
    {
        header("location:student_profile.php"); 
    }
?>
<footer>
        
        <label for="" class="cc">Copyright &#169 2023 Vidya. All rights reserved</label> 
        <label for="" class="make">Devloped in India❤️</label>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
            <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
        </a>
        <a href="">
            <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
        </a>
    </footer>