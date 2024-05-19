<?php
if (!isset($_COOKIE["login"])) {
    echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
    header("location:index.php");
}

// echo $_COOKIE["login"];
$data = file_get_contents("C:/wamp64/www/vidya/admin/sub.txt");
$data_arr = explode(",", $data);
// print_r($data_arr);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Find Teacher</title>
    <link href="css/st_home.css" rel="stylesheet" type="text/css">
</head>
<style>

</style>

<body>
    
    <div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li  class="active"><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
    </div>

    <!--Profile Image-->
    <!-- <div id="" name="">
        <a href="student_profile.php">
            <img src="download.png" alt="download" height="50" width="50">
        </a>
        <p><?php print_name(); ?></p>

    </div> -->


    <!--Silder-->

    <!--Silder Menu-->


    <!--Subject silder Menu-->
    <div class="cont">
        <div class="f_box">
            <form action="" method="post" class="cont">
                <div id="" name="" class="P_img">
                    <a href="student_profile.php">
                        <img src="pro_pic/<?php profile("student",$_COOKIE["login"]); ?>" alt="" height="50" width="50">
                    </a>
                    <p><?php print_name(); ?></p>

                </div>
                <hr>
                <label for="">Subject</label>
                <select name="subject" id="">Select Subject
                    <option value="">--Select--</option>
                    <?php
                    for ($i = 0; $i < count($data_arr)+1; $i++) {
                        if($i%2==0)
                        {
                            echo "<option value='$data_arr[$i]'>$data_arr[$i]</option>";
                        }
                    }
                    ?>
                </select>

                <br><br>

                <!-- timing -->

                <label>Your preafer timing :</label><br>
                <label>From:</label>
                <input type="time" name="s_time" id="">
                <br>
                <label>To:</label>
                <input type="time" name="e_time" id="">

                <br><br>

                <!--slider Button-->
                <div class="btn">
                    <input type="submit" name="show" value="Show">
                    <!-- <input type="submit" name="logout" value="log out"> -->
                </div>

            </form>
            
        </div>
    </div>
<!-- </body> -->

</html>

<?php

if(isset($_POST["request"]))
{
    // setcookie("dis",1);
    request($_POST["hemail"],$_POST["subject"],$_POST["price"],$_POST["s_time"],$_POST["e_time"]);
}

function print_name() //for printing name on line 14 
{

    $con = mysqli_connect("localhost", "root", "", "vidya");

    $email = $_COOKIE["login"];

    $query = "SELECT name FROM student WHERE email='$email';";

    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire);
    
    echo $row["name"];
}

$email = $_COOKIE["login"];

function profile($table,$email)
{   
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $query = "SELECT profile,gender FROM $table WHERE email='$email';";
    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire);
    if($row["profile"]==null)
    {
        echo $row["gender"].".png";
    }
    else
    {
        echo $row["profile"];
    }
}
// profile();


function get_loc() //for get location from db
{
    $con = mysqli_connect("localhost", "root", "", "vidya");

    $email = $_COOKIE["login"];

    $query = "SELECT location FROM student WHERE email='$email';";

    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire);

    return $row["location"];
}

function request($temail, $sub, $price, $s_time, $e_time) // email of teacher must be passed as an argument
{
    $con = mysqli_connect("localhost", "root", "", "vidya");

    // $select="SELECT name FROM teacher WHERE email='$temail'";
    // $sfire=mysqli_query($con,$select);
    // $row = mysqli_fetch_assoc($sfire);
    // $name=$row["name"];

    $semail = $_COOKIE["login"];
    // $temail=$_COOKIE["tlogin"];

    $query = "INSERT INTO requests (semail,temail,subject,price,stime,etime) VALUES ('$semail','$temail','$sub','$price','$s_time','$e_time');";

    $fire = mysqli_query($con, $query);

    if ($fire) {
        echo "<script>alert('Request sent seccessfully for')</script>";
    } else {
        echo mysqli_error($con);
    }
}

$con = mysqli_connect("localhost", "root", "", "vidya");

if (isset($_POST["show"]) && isset($_POST["s_time"]) && isset($_POST["e_time"])) {

    $stime = $_POST["s_time"];
    $etime = $_POST["e_time"];
    $subject = $_POST["subject"];
    $loc = get_loc();
    $con = mysqli_connect("localhost", "root", "", "vidya");

    $query = "SELECT * FROM teacher WHERE subjects LIKE '%$subject%' AND s_time BETWEEN '$stime' AND '$etime' AND location = '$loc' AND verification=1;";
    // $query = "SELECT * FROM teacher WHERE subjects LIKE '%$subject%' AND s_time >= '$stime' AND e_time <='$etime' AND location = '$loc' AND verification=1;";
    $fire = mysqli_query($con, $query);
    if (!$fire) {
        echo mysqli_error($con);
    }

    // $rowin=mysqli_fetch_array($fire);

    // if(!$row)
    // {
    //     echo mysqli_error($con);
    // }
    $sum=0;
    $x = 0;

    while ($row = mysqli_fetch_assoc($fire)) {
        $sub = explode('|', $row["subjects"]);
        $index_sub = array_search($subject, $sub);
        $price = explode(',', $row["price"]);
        $price_cut_index=array_search($data_arr,$sub);
        $price_cut=($data_arr[$price_cut_index+1]*$price[$index_sub])/100;
        // echo $index_sub."<br>";
        // print_r($price);
        // echo $no_row;
        // echo "af";
        // $i = 0;
        // $j = 1;
        $ptp=floor($price[$index_sub]+$price_cut);
        
        $temail=$row["email"];
        
        $select_from_requests="SELECT rating from requests where temail='$temail';";
        $fire_select_requests=mysqli_query($con,$select_from_requests);
        
        $no_of_row=mysqli_num_rows($fire_select_requests);
        $flag=0;

        if($no_of_row>0)
        {
            while($row_select=mysqli_fetch_assoc($fire_select_requests))
            {
                $no_row=mysqli_num_rows($fire_select_requests);
                $sum+=$row_select["rating"];
                $avg=$sum/$no_row;
            }
            $count=mysqli_num_rows($fire_select_requests);
            $flag=1;
        }

        if($x==0)
        {
            $jj=1;
        }
        else
        {
            $jj=2;
        }
        echo "<br>";
        echo "<p class='show".$jj."' >Name: " . $row["name"];
        echo "<br><br>";
        echo "price for " . $subject . " : " . ($ptp) . "<br>";
        echo "my bio:" . $row["bio"];
        if($flag==1)
        {
            echo "<br>total rating: " . round($avg,2) ." number of rating ".$count;
        }
        else
        {
            echo "<br>this teacher is new at this site";
        }
        
        $email = $row['email'];
        ?>
        <!-- for request button -->
        <html>

        <!-- <body> -->
            <img src="pro_pic/<?php profile("teacher",$row["email"]) ?>" alt="" height="100" width="100" class="pp">
            <form action="" method="post">
                <br>
                <input type="submit" name="request" value="request">
                <input type="hidden" value="<?php echo $email ?>" name="hemail">
                <input type="hidden" value="<?php echo $subject ?>" name="subject">
                <input type="hidden" value="<?php echo $ptp ?>" name="price">
                <input type="hidden" value="<?php echo $stime ?>" name="s_time">
                <input type="hidden" value="<?php echo $etime ?>" name="e_time">


                <!-- it will pass email from current row to request function which than make a entry to request table. -->
            </form>
            
            <?php
        echo "<br></p>";
        $x++;
        // echo $x;
    }
}
?>
    <footer>
        <label for="" class="make">Devloped in India❤️</label>
        <label for="" class="cc">Copyright &#169 2023 Vidya. All rights reserved</label> 
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
            <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
        </a>
        <a href="">
            <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
        </a>
    </footer>
</body>

</html>