<?php
if (!isset($_COOKIE["tlogin"])) {
        echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    }


    $temail=$_COOKIE["tlogin"];

    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM teacher WHERE email='$temail';";
    $fire=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($fire);//fetches raw in associtive array

    $sub=$row["subjects"];
    $sub_arr=explode("|",$sub);
    
    $data=file_get_contents("C:/wamp64/www/vidya/admin/sub.txt");
    $data_arr=explode(",",$data);

    // print_r($sub_arr);

    function selected($subb)
    {
        global $sub_arr;
        if(in_array($subb,$sub_arr))
        {
            return "checked";
            // echo "skdjh";
        }
    }

    function delete()
    {
        global $temail,$con,$row;

        $delete="DELETE FROM teacher WHERE email='$temail';";
        $fire_delete=mysqli_query($con,$delete);
        if(!$fire_delete)
        {
            echo mysqli_error($con);
        }
        $de_img=$row["profile"];
        $depath="C:/wamp64/www/vidya/teacher/pro_pic/". $de_img;
        unlink($depath);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/teacher_edit_profile.css">
    <title>edit profile</title>
</head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 2px;
    margin-left: -0.5%;
    margin-right: -0.45%;
    margin-top: -0.5%;
    /* margin-bottom: -20x`%; */
    overflow: hidden;
    background-color: #333;
    position: sticky;
    top: 0;
    font-family: Arial, Helvetica, sans-serif;
}

li {
  float: left;
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
    padding-top: 25px;
}
.cc
{
    padding-right: 5%;
}
</style>
<body>
    <div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="teacher_profile.php">Profile</a></li>
          <li  class="active"><a href="teacher_edit_profile.php">Edit profile</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="cont">
    <div class="f_box">

        <form action="" method="post" enctype="multipart/form-data">

            <label>Enter your name: <label>
            <input type="text" name="name" placeholder="Full name" value="<?php echo $row["name"];?>"><br><br>

            <label for="">Select subjects:</label><br><br>

            <?php 
                $i=0;
                while($i<count($data_arr))
                {
                    if($i%2==0)
                    {
                        echo $data_arr[$i]."<input type='checkbox' name='sub[]' id='' ".selected($data_arr[$i])." value=".$data_arr[$i]."><br>";
                    }
                    $i++;
                }
            ?>
            <br>
            <label for="">Enter price subject vice: </label>
            <input type="text" name="price" id="" placeholder="999,2000" value="<?php echo $row["price"];?>"><br><br>
            <br>
            <label for="">Bio: </label>
            <br>
            <textarea name="bio" id="" cols="60" rows="10" class="textarea"><?php echo $row["bio"];?></textarea><br><br>

            <label>Enter your age: </label>
            <input type="number" name="tc_age" id="" value="<?php echo $row["age"];?>"><br><br>
            
            <label>Enter contact number:</label>
            <input type="number" name="tc_con" id="" value="<?php echo $row["tc_con"];?>"><br><br>

            <label>Enter your location: </label>
            <input type="text" name="tc_location" value="<?php echo $row["location"];?>"><br><br><br>

            <label>Please select a time slot: </label><br><br>
            <label>From: </label>
            <input type="time" name="s_time" id="" value="<?php echo $row["s_time"];?>">
            <label>To: </label>
            <input type="time" name="e_time" id="" value="<?php echo $row["e_time"];?>"><br><br>
            
            <label for="">change DP:</label>
            <input type="file" name="profile" id="">
            <br><br>
            <label for="">Password:</label>
            <input type="password" name="password" id="" >
            <br><br>

            <!-- <input type="submit" value="uplode" name="add"><br> -->

            <input type="submit" name="update" value="edit" >
            <!-- <input type="submit" name="profilee" value="close"> -->
            <input type="submit" name="delete" value="delete" style="background-color: red;">

        </form>
    </div>  
    </div>

</body>
</html>

<?php

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

    function uplode()
    {

        $emailc=$_COOKIE["tlogin"];
        $con=mysqli_connect("localhost","root","","vidya");
        $query="SELECT * FROM teacher WHERE email='$emailc';";
        $fire=mysqli_query($con,$query);

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
                    $file_destination="C:/wamp64/www/vidya/teacher/pro_pic/". $file_new_name;

                    move_uploaded_file($file_tmp_name,$file_destination);

                    $de_img=$row["profile"];
                    $depath="C:/wamp64/www/vidya/teacher/pro_pic/". $de_img;

                    // echo $file_new_name;

                    if($row["profile"]==null)
                    {
                        $update="UPDATE teacher SET profile='$file_new_name' WHERE email='$emailc';";
                        $fire=mysqli_query($con,$update);
                        if(!$fire)
                        {
                            echo mysqli_error($con);
                        }
                    }
                    // else if(unlink($depath))
                    else
                    {
                        // echo "ok";
                        $update="UPDATE teacher SET profile='$file_new_name' WHERE email='$emailc';";
                        $fire=mysqli_query($con,$update);
                        if(!$fire)
                        {
                            echo mysqli_error($con);
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


    if(array_key_exists("profilee",$_POST))   
    {
        header("location:teacher_profile.php");
        // print_r($_POST["sub"]) ;
    }


    $temail=$_COOKIE["tlogin"];

    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM teacher WHERE email='$temail';";
    $fire=mysqli_query($con,$query);

    $row=mysqli_fetch_assoc($fire);//fetches raw in associtive array

    if(array_key_exists("edit",$_POST) && ($_POST["password"]==$row["password"]))
    {
        Uplode();
        $new_name=$_POST["name"];

        if(!isset($_POST["sub"]))
        {
            $new_sub=$sub;
        }
        else
        {
            $new_sub=implode("|",$_POST["sub"]);
        }
        $new_price=$_POST["price"];
        $new_bio=$_POST["bio"];
        $new_age=$_POST["tc_age"];
        $new_tc_con=$_POST["tc_con"];
        $new_location=$_POST["tc_location"];
        $new_s_time=$_POST["s_time"];
        $new_e_time=$_POST["e_time"];

        $update="UPDATE teacher SET name='$new_name',subjects='$new_sub',price='$new_price',bio='$new_bio',age='$new_age',tc_con='$new_tc_con',location='$new_location',s_time='$new_s_time',e_time='$new_e_time' WHERE email='$temail';";
        $update_fire=mysqli_query($con,$update);
        if(!$update_fire)
        {
            echo mysqli_error($con);
        }
    }
?>
<footer>
        
        <label for="" class="cc">&#169 Vidya||2023</label> 
        <label for="" class="make">Devloped in India❤️</label>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
            <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
        </a>
        <a href="">
            <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
        </a>
    </footer>