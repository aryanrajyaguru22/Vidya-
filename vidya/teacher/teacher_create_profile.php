<?php
    echo "<script>alert('verification done.')</script>";
    $data=file_get_contents("C:/wamp64/www/vidya/admin/sub.txt");
    $data_arr=explode(",",$data);

    // $con = mysqli_connect("localhost", "root", "", "vidya");
    // $query = "SELECT * FROM subjects;";
    // $fire = mysqli_query($con, $query);
    // if (!$fire) {
    //     echo mysqli_error($con);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/te_creat.css">

    <title>create profile</title>
</head>
<body>  
    <div class="cont">
        <div class="f_box">
            <form action="" method="post" enctype="multipart/form-data" ><br>
                <h1>Create profile</h1><br>
                <label for="">select subjects</label><br><br>
                <?php
                    $i=0;
                    while($i<count($data_arr))
                    {
                        if($i%2==0)
                        {
                            echo $data_arr[$i]."<input type='checkbox' name='sub[]' id='' value=".$data_arr[$i].">";
                        }
                        $i++;
                    }
                ?>
                <br>
                <label for="">enter price subject vice</label>
                <input type="text" name="price" id="" placeholder="sub1=>22,sub2=>55 ex. 22,55"><br><br>
    
    
                <label for="">BIO:</label>
                <br>
                <textarea name="BIO" id="" cols="60" rows="10" class="textarea">
                </textarea><br><br>
    
                <label for="">message for admin:</label>
                <br>
                <textarea name="message" id="" cols="60" rows="10" class="textarea">
                </textarea><br><br>
    
                <label>select your gender</label>
                <select name="tc_gender">
                    <option>---select---</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="pns">preafer not to say</option>
                </select><br><br>
    
                <!-- <label>please select a Profile picture</label>
                <input type="file" name="profile_pic" id=""><br><br> -->
    
                <!-- <label>enter your age</label> -->
                <input type="number" name="tc_age" id="" placeholder="enter your age"><br><br>
    
                <!-- <label></label> -->
                <input type="number" name="tc_location" placeholder="enter your location PIN code"><br><br>
    
                <label>please select a time slot: </label><br>
                <label>From: </label>
                <input type="time" name="s_time" id="">
                <label>To: </label>
                <input type="time" name="e_time" id=""><br><br>
    
                <label for="">Please attache a document that can identify you:  </label> 
                <input type="file" name="documents" id="">
    
                <input type="submit" name="create" value="create">
                <!-- <input type="submit" name="try" value="try"> -->
                <!-- <input type="submit" name="uplode" value="up"> -->
            </form>
        </div>
    </div>

</body>
</html>

<?php
    session_start();

    function uplode()
    {
        $file=$_FILES["documents"];
        $file_name=$_FILES["documents"]["name"];
        $file_tmp_name=$_FILES["documents"]["tmp_name"];
        $file_size=$_FILES["documents"]["size"];
        $file_error=$_FILES["documents"]["error"];
        $file_type=$_FILES["documents"]["type"];
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
                    $file_destination="C:/wamp64/www/vidya/student/reciepts" . $file_new_name;
    
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

    if(isset($_POST["try"]))
    {
        $data=uplode();
        echo $data;
    }
    


    // echo $_SESSION["create_email"];
    
    if(isset($_POST["create"]))
    {
        //database connection 
        $con=mysqli_connect("localhost","root","","vidya");

        if(!$con)
        {
            echo "<script>alert('theare is a problame in database connection')</script>";
        }

        // now $price_arr is an array and $subject is an string
        $price=$_POST["price"];
        $price_arr=explode(',',$_POST["price"]);
        $subject=implode('|',$_POST["sub"]);//subject of teacher
        $gender=$_POST['tc_gender'];
        $age=$_POST['tc_age'];
        $loc=$_POST['tc_location'];    //teacher location
        $stime=$_POST['s_time'];
        $etime=$_POST['e_time'];
        $email=$_SESSION["create_email"];
        $bio=$_POST["BIO"];
        $message=$_POST["message"];
        $filename=uplode();


        if($age<18)
        {
            echo "<script>alert('you are younger than 18')</script>";
        }

        if(strtotime($stime)>=strtotime($etime))
        {
            echo "<script>alert('starting time can not be same to less than ending time.')</script>";
        }


        if(sizeof($price_arr)>sizeof($_POST["sub"]))
        {
            echo "<script>alert('there are more price than selected subjects')</script>";
        }
        elseif(sizeof($price_arr)<sizeof($_POST["sub"]))
        {
            echo "<script>alert('there are less price than selected subjects')</script>";
        }
        else
        {
            $update="UPDATE teacher SET gender='$gender',location='$loc',age='$age', subjects ='$subject',s_time='$stime',e_time='$etime',price='$price',bio='$bio',message='$message',documents='$filename' WHERE email='$email';";
        
            $fire=mysqli_query($con,$update);
            
            if ($fire) 
            {
                // echo "<script>alert('account created successfully')</script>";
                unset($_SESSION["create_email"]);
                header("location:index.php");
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    }

?>