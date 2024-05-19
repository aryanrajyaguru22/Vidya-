<html>
    <head>
        <title>Your Teacher</title>
        <link rel="stylesheet" href="css/your_teacher.css">
    </head>
    <style>
        ul {
        list-style-type: none;
        margin: 0;
        margin-bottom: 2%;
        padding: 0;
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
    /* padding-left: -10px; */
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
    padding-top: 8px;
}
.cc
{
    padding-right: 5%;
}
.txt{
    font-size: large;
}
</style>
    <body>
        <div class="cont"> 
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li class="active"><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>

        </ul>
    </body>
    </html>
<?php

use function PHPSTORM_META\elementType;

    session_start();

    if(!isset($_COOKIE["login"]))
    {
        echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    } 

    function unroll($id)
    {
        $con=mysqli_connect("localhost","root","","vidya");
        $update="UPDATE requests SET student_reject=1,refund=1 where id='$id';";
        $fire_update=mysqli_query($con,$update);
        if($fire_update)
        {
            echo "<script>alert('Unroll secssesfull')</script>";
        }
        else {
            echo mysqli_error($con);
        }
    }
    
    function check_profile($id)
    {
        $con=mysqli_connect("localhost","root","","vidya");
        $get_profile="SELECT * FROM requets WHERE id='$id';";
        $fire_get_profile=mysqli_query($con,$get_profile);
        if(!$fire_get_profile)
        {
            echo mysqli_error($con);
        }

        $row=mysqli_fetch_assoc($fire_get_profile);
        
    }


    if(array_key_exists("profile",$_POST))
    {
        header("location:student_profile.php");
    } 

    if(array_key_exists("feedback",$_POST))
    {
        header("location:feedback.php");
        $_SESSION["id"]=$_POST["id"];
    } 

    $email=$_COOKIE["login"];
    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM requests WHERE semail='$email' AND pay=1 AND student_reject = 0 AND teacher_reject = 0 AND orders = 0;";
    $fire=mysqli_query($con,$query);
    if(!$fire)
    {
        echo mysqli_error($con);
    }
    $no=mysqli_num_rows($fire);
    if($no!=0)
    {
        while($row=mysqli_fetch_assoc($fire))
        {
            echo "<div class='f_box'><hr>";
            $teacher_arr=$row["temail"];
            // echo $teacher_arr;
            // $i=0;
            // while($i<sizeof($teacher_arr))
            // {
                $select_teacher="SELECT * FROM teacher WHERE email='$teacher_arr';";
                $fire_select_teacher=mysqli_query($con,$select_teacher);
                if(!$fire_select_teacher)
                {
                    echo mysqli_error($con);
                }
                
                $data=mysqli_fetch_assoc($fire_select_teacher);
                        $profile=$row["rating"];
                        // $_SESSION["id"]=$row["id"];
                        
                        // echo "<hr>";
                        echo "<p class='txt'>name of teacher is:    ".$data["name"]."<br><br>";
                        echo "teacher contect number:   ".$data["tc_con"]."<br><br>";
                        echo "teacher email:    ".$data["email"]."<br><br>";
                        echo "subject:  ".$row["subject"]."<br><br>";
                        echo "Your given rating:    ".$row["rating"]."<br><br>";
                        echo "preafer timing of teacher is <br> from: ".$data["s_time"]." to: ".$data["e_time"]."<br><br></p>";
                        ?>
                        <html>
                            <body>
                                <form action="" method="post">
                                    <input type="submit" name="unroll" value="Unroll" class="btn" style="background-color: #cc0000;">
                                    <input type="submit" name="feedback" value="Feedback" class="btn" style="margin-left: 19%;" <?php if($profile!=0){echo "disabled";} ?>>
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                </form>
                            </body>
                        </html>
                        <?php
                        // echo "<br>----------------------------<br>";
        }
    }
    else
            {
                // echo "there is no teachers";
                echo "<script>alert('There is no teachers')</script>";
            }
    
    
        // $i++;
        if(array_key_exists("unroll",$_POST))
        {
            // echo $_POST["id"];
                unroll($_POST["id"]);
            }  
            
            
        echo "</div>";
        echo "</div>";

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
