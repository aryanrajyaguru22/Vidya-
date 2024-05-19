<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment.css">

    <title>Payment</title>
</head>
<style>
ul {
  list-style-type: none;
  /* width: 100%; */
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
  border-right: 1px solid #bbb;
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
    padding-right: 20px;
    padding-bottom: 10px;
    margin-left: -8px;
    background-color: #333333;
    color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 40px;
    text-align: center;  
    position: fixed;
    /* position: sticky; */
  bottom: 0;
  width: 100%;
  height: 2.5rem;  
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
    padding-top: 20px;
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
          <li><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li class="active"><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>

        </ul>
    </div>
        <div class="cont">
            <div class="f_fox">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h1>Payment</h1>
                    <img src="qrcode2.jpg" alt="" height="200" width="200" class="qr">
                    <!-- <input type="submit" value="home" name="home"><br> -->
                    <label for="">Please attach receipts</label>
                    <input type="file" name="documents" id=""><br><br>
                    <input type="submit" value="send for verification" name="submit">
                    <!-- <input type="submit" value="try" name="try"> -->
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
                $file_destination="C:/wamp64/www/vidya/admin/reciepts/" . $file_new_name;

                move_uploaded_file($file_tmp_name,$file_destination);
                return $file_new_name;
                // return $file_destination;
                
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

if(isset($_POST["home"]))
{
    header("location:student_profile.php");
}

if(isset($_POST["submit"]))
{
        $data=uplode();
        // echo $data;
        // $email=$_POST["temail"];
        // $subject="";
        // $message=".";
        // $alert="verification sent.";
        // $flag=send_email($email,$subject,$message,$alert);
        // if($flag==1)
        // {
            // echo "gdf";
        $id=$_SESSION["id"];
        // update($id);
        $con=mysqli_connect("localhost","root","","vidya");
        $update="UPDATE requests SET orders = '$data',pay_veri=1 WHERE id ='$id';";
        // echo $update."<br>";
        $fire=mysqli_query($con,$update);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('verification send.')</script>";
        }
        // }
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